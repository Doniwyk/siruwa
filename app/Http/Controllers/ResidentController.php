<?php

namespace App\Http\Controllers;

use App\Contracts\AccountContract;
use App\Contracts\UserContract;
use App\Http\Requests\UserRequest;
use App\Models\AccountModel;
use App\Models\TempResidentModel;
use App\Models\UserModel;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    protected UserContract $residentContract;
    protected AccountContract $accountContract;


    public function __construct(UserContract $residentContract)
    {
        $this->residentContract = $residentContract;
    }

    //========================FOR ADMIN========================
    public function indexAdmin(Request $request)
    {
        // menangkap req yang dikirim dan juga menset nilai default agar berjaga-jaga user tidak mengisinya
        $typeDocument = $request->query('typeDocument', 'daftar-penduduk');
        $search = $request->query('search', '');
        $order = $request->query('order', 'asc');

        // mengambil residents (penduduk)
        $residents = $this->getDataRequest($typeDocument, $search, $order);

        // mengambil fungsi paginasi dari laravel sehingga dapat digunakan JS dan blade
        $paginationHtml = $residents->appends([
            'typeDocument' => $typeDocument,
            'search' => $search,
            'order' => $order
        ])->links()->toHtml();

        $page = 'data-penduduk';
        $title = 'Data Penduduk';

        // menangani jika request JSON
        if ($request->wantsJson()) {
            return response()->json([
                'page' => $page,
                'title' => $title,
                'typeDocument' => $typeDocument,
                'residents' => $residents->items(),
                'paginationHtml' => $paginationHtml
            ]);
        }

        return view('admin._dasawismaData.index', compact('page', 'title', 'typeDocument', 'residents', 'paginationHtml', 'search', 'order'));

    }

    public function add()
    {
        return view('admin._dasawismaData.add');
    }

    public function storeResident(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        try {
            $resident = $this->residentContract->storeUser($validated);
            $account = [
                'id_penduduk' => $resident->id,
                'urlProfile' => $request->has('urlProfile') ? $request->urlProfile : null,
                'noHp' => $request->has('noHp') ? $request->noHp : null,
                'username' => $resident->nomor_kk,
                'email' => $request->has('email') ? $request->email : null,
                'email_verified_at' => now(),
                'password' => bcrypt($resident->nomor_kk),
                'role' => 'resident'
            ];
            AccountModel::insert($account);
            return redirect()->route('admin.data-dasawisma.index')->with('success', 'Data penduduk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data penduduk: ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function deleteResident(UserModel $resident): RedirectResponse
    {
        try {
            $this->residentContract->deleteUser($resident);
            return redirect()->route('admin.data-dasawisma.index')->with('success', 'Data penduduk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data penduduk: ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }

    //EDIT BY ADMIN
    public function editResident(UserModel $resident): View
    {
        $page = 'edit-data-penduduk';
        $title = 'Edit Data Penduduk';
        $resident = UserModel::findOrFail($resident->id_penduduk);
        return view('admin._dasawismaData.edit', compact('resident', 'page', 'title'));
    }

    public function updateResident(UserRequest $request, UserModel $resident): RedirectResponse
    {
        try{
            $validated = $request->validated();
            $this->residentContract->updateUser($validated, $resident);
            return redirect()->route('admin.data-dasawisma.index')->with('success', 'Data penduduk berhasil di ubah');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Gagal memperbarui data penduduk: ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }

    //FOR PROCESS EDIT BY RESIDENT

    public function indexRequest()
    {
        try {
            $reqResident = TempResidentModel::all();
            return view('admin._dasawismaData.index', ['title' => 'Data Penduduk', 'requestEdit' => $reqResident]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pengajuan perubahan data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }


    }

    public function validateEditRequest(Request $request, UserModel $resident)
    {
        $request->validate([
            'action' => 'required|in:accept,reject',
        ]);
        try {
            $this->residentContract->validateEditRequest($request, $resident);
            if ($request->action === 'accept') {
                return redirect()->route('admin.data-penduduk.index')->with('success', 'Data berhasil disetujui.');
            } elseif ($request->action === 'reject') {
                return redirect()->route('admin.data-penduduk.index')->with('error', 'Data berhasil ditolak.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memvalidasi pengajuan perubahan data ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function getFilterDataPenduduk($search, $order)
    {
        $residents = UserModel::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', $search . '%');
        })->orderBy('nama', $order)
            ->paginate(15);
        return $residents;
    }
    public function getFilterPengajuanDataPenduduk($search, $order)
    {
        $residents = TempResidentModel::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', $search . '%');
        })
            ->where('status', 'Menunggu Verifikasi')
            ->orderBy('nama', $order)
            ->paginate(15);
        return $residents;
    }
    public function getFilterRiwayatDataPenduduk($search, $order)
    {
        $residents = TempResidentModel::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', $search . '%');
        })
            ->where('status', '!=', 'Menunggu Verifikasi')
            ->orderBy('nama', $order)
            ->paginate(15);

        return $residents;
    }

    public function getDataRequest($typeDocument, $search, $order)
    {
        switch ($typeDocument) {
            case 'daftar-penduduk':
                $residents = $this->getFilterDataPenduduk($search, $order);
                break;
            case 'pengajuan':
                $residents = $this->getFilterPengajuanDataPenduduk($search, $order);
                break;
            case 'riwayat':
                $residents = $this->getFilterRiwayatDataPenduduk($search, $order);
                break;
        }
        return $residents;
    }

    public function show(UserModel $resident)
    {
        $page = 'edit-data-penduduk';
        $title = 'Edit Data Penduduk';
        $resident = UserModel::find($resident->id_penduduk);
        return view('admin._dasawismaData.show', compact('resident', 'page', 'title'));
    }


    //========================FOR RESIDENT========================

    public function indexResident()
    {
        $userId = Auth::id();
        $resident = UserModel::findOrFail($userId);
        return view('resident._dasawismaData.index', ['title' => 'Data Diri', 'resident' => $resident]);
    }

    public function editForm()
    {
        $userId = Auth::id();
        $resident = UserModel::findOrFail($userId);
        return view('resident.data-dasawisma.edit', compact('resident'));
    }


    public function requestEditForm()
    {
    }

    public function storeEditRequest(Request $request, UserModel $resident)
    {

        try {
            if ($this->residentContract->editRequest($request, $resident)) {
                return redirect()->back()->with('success', 'Formulir pengajuan edit berhasil disimpan.');
            } else {
                return redirect()->back()->with('error', 'Anda sudah mengajukan perubahan data. Harap tunggu proses verifikasi sebelum mengajukan perubahan lagi.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengajukan perubahan data ' . $e->getMessage())->withErrors([$e->getMessage()]);

        }
    }

    public function historyEditRequest(UserModel $penduduk)
    {
        $history = TempResidentModel::where('id_penduduk', $penduduk->id_penduduk);
        return view('resident._dasawismaData.history', ['title' => 'Data Penduduk', 'history' => $history]);
    }

}
