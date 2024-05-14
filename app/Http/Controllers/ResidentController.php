<?php

namespace App\Http\Controllers;

use App\Contracts\AccountContract;
use App\Contracts\UserContract;
use App\Http\Requests\UserRequest;
use App\Models\AccountModel;
use App\Models\UserModel;
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
        $pageHeader = 'Data Penduduk';

        // menangani jika request JSON
        if ($request->wantsJson()) {
            return response()->json([
                'page' => $page,
                'pageHeader' => $pageHeader,
                'typeDocument' => $typeDocument,
                'residents' => $residents->items(),
                'paginationHtml' => $paginationHtml 
            ]);
        }

        return view('admin._dasawismaData.index', compact('page', 'pageHeader', 'typeDocument', 'residents', 'paginationHtml', 'search', 'order'));
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
        $this->residentContract->deleteUser($resident);
        return redirect()->route('admin.data-dasawisma.index')->with('success', 'Data penduduk berhasil dihapus.');
    }

    //EDIT BY ADMIN
    public function editResident(UserModel $resident): View
    {
        return view('admin._dasawismaData.edit', compact('resident'));
    }

    public function updateResident(UserRequest $request, UserModel $resident): RedirectResponse
    {
        $validated = $request->validated();
        $this->residentContract->updateUser($validated, $resident);
        return redirect()->route('admin.data-dasawisma.index')->with('success', 'Data penduduk berhasil di ubah');
    }

    //FOR PROCESS EDIT BY RESIDENT
    public function validateEditRequest(Request $request, UserRequest $residentRequest, UserModel $resident)
    {
        $request->validate([
            'action' => 'required|in:accept,reject',
        ]);
        if ($request->action === 'accept') {
            $validated = $residentRequest->validated();
            $this->residentContract->updateUser($validated, $resident);
            return redirect()->route('admin.data-dasawisma.requestData')->with('success', 'Pengajuan edit data diterima.');
            // will update the data change request status table to accept
        } else {
            // will update the data change request status table to reject
        }
    }

    // kyak gk make sense klo query fdi controlller, tolong dirapihkan yaa ;)
    public function getFilterData($model, $search, $order)
    {
        $residents = $model::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', $search . '%');
        })->orderBy('nama', $order)
            ->paginate(15);

        return $residents;
    }

    public function getDataRequest($typeDocument, $search, $order){
        switch ($typeDocument) {
            case 'daftar-penduduk':
                $residents = $this->getFilterData(UserModel::class, $search, $order);
                break;
            case 'pengajuan':
                $residents = $this->getFilterData(UserModel::class, $search, $order);
                break;
            case 'riwayat':
                $residents = $this->getFilterData(UserModel::class, $search, $order);
                break;
        }
        return $residents;
    }


    //========================FOR RESIDENT========================

    public function indexResident()
    {
        $userId = Auth::id();
        $resident = UserModel::findOrFail($userId);
        return view('resident._dasawismaData.index', ['pages' => 'Data Anda', 'resident' => $resident]);
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
}
