<?php

namespace App\Http\Controllers;

use App\Contracts\AccountContract;
use App\Contracts\UserContract;
use App\Http\Requests\UserRequest;
use App\Models\AccountModel;
use App\Models\DeathFundModel;
use App\Models\GarbageFundModel;
use App\Models\TempResidentModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    protected UserContract $residentContract;
    protected AccountContract $accountContract;
    private $page;


    public function __construct(UserContract $residentContract)
    {
        $this->residentContract = $residentContract;
        $this->page = 'data-penduduk';
    }

    //========================FOR ADMIN========================

    public function indexAdmin(Request $request)
    {
        try {
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

            $page = $this->page;

            // menangani jika request JSON
            if ($request->wantsJson()) {
                return response()->json([
                    'page' => $page,
                    'typeDocument' => $typeDocument,
                    'residents' => $residents->items(),
                    'paginationHtml' => $paginationHtml
                ]);
            }

            return view('admin._dasawismaData.index', compact('page', 'typeDocument', 'residents', 'paginationHtml', 'search', 'order'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function add()
    {
        try {
            $page = $this->page;
            return view('admin._dasawismaData.add', compact('page'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak dapat memuat formulir tambah penduduk' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    //To store resident data in database
    public function storeResident(UserRequest $request)
    {

        try {                                                                                                                                                                                                                                                                          
            $validated = $request->validated();
            $resident = $this->residentContract->storeUser($validated);

            $account = [
                'id_penduduk' => $resident->id_penduduk,
                'urlProfile' => $request->has('urlProfile') ? $request->urlProfile : null,
                'noHp' => $request->has('noHp') ? $request->noHp : null,
                'username' => $resident->nik,
                'email' => $request->has('email') ? $request->email : null,
                'email_verified_at' => now(),
                'password' => bcrypt($resident->nik),
                'role' => 'resident'
            ];
            AccountModel::create($account);
            $existingDeathFund = DeathFundModel::where('nomor_kk', $request->nomor_kk)->exists();
            if (!$existingDeathFund) {
                $currentMonth = now()->month;
                $currentYear = now()->year;

                for ($month = $currentMonth; $month <= 12; $month++) {
                    $death_fund = [
                        'nomor_kk' => $resident->nomor_kk,
                        'bulan' => Carbon::create($currentYear, $month, 1)->format('Y-m-d'),
                        'status' => 'Belum Lunas'
                    ];

                    DeathFundModel::create($death_fund);
                }
            }
            $existingGarbageFund = GarbageFundModel::where('nomor_kk', $request->nomor_kk)->exists();
            // dd($existingDeathFund);
            if (!$existingGarbageFund) {
                $currentMonth = now()->month;
                $currentYear = now()->year;

                for ($month = $currentMonth; $month <= 12; $month++) {
                    $garbage_fund = [
                        'nomor_kk' => $resident->nomor_kk,
                        'bulan' => Carbon::create($currentYear, $month, 1)->format('Y-m-d'),
                        'status' => 'Belum Lunas'
                    ];

                    GarbageFundModel::create($garbage_fund);
                }
            }
            return response()->json(['success' => 'Data stored successfully', 'redirect' => route('admin.data-penduduk.index')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to process data: ' . $e->getMessage()], 500);
        }
    }


    //To delete resident data
    public function deleteResident(UserModel $resident): RedirectResponse
    {
        try {
            $this->residentContract->deleteUser($resident);
            return redirect()->route('admin.data-penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.data-penduduk.index')->with('error', 'Gagal menghapus data penduduk: ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    //EDIT BY ADMIN
    //For display  resident data selected for editing
    public function editResident(UserModel $resident): View
    {
        try {
            $page = $this->page;
            //Data on residents who submitted data changes
            $resident = UserModel::findOrFail($resident->id_penduduk);
            // Data that  want to change
            $reqResident = TempResidentModel::where('id_penduduk', $resident->id_penduduk)->orderBy('created_at', 'desc')->first();
            return view('admin._dasawismaData.edit', compact('resident', 'page','reqResident'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak dapat memuat data' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    //To update resident data which has been edited by admin
    public function updateResident(UserRequest $request, UserModel $resident): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->residentContract->updateUser($validated, $resident);
            return redirect()->route('admin.data-dasawisma.index')->with('success', 'Data penduduk berhasil di ubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data penduduk: ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    //FOR PROCESS EDIT BY RESIDENT


    //For display resident data on the page "Admin->Data Penduduk-> Pengajuan"
    public function indexRequest()
    {
        try {
            $requestEdit = TempResidentModel::where('status', 'Menunggu Verifikasi')
                ->with('penduduk')
                ->get();
            return view('admin._dasawismaData.index', ['title' => 'Data Penduduk', 'requestEdit' => $requestEdit]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pengajuan perubahan data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    //To validate edit request data from resident 

    public function validateEditRequest(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'action' => 'required|in:accept,reject',
            'keterangan_status' => 'nullable'
        ]);
        try {
            $this->residentContract->validateEditRequest($request->action, $request->id, $request->keterangan_status);
            if ($request->action === 'accept') {
                return redirect()->route('admin.data-penduduk.index',['typeDocument' => 'pengajuan'])->with('success', 'Data berhasil disetujui.');
            } elseif ($request->action === 'reject') {
                return redirect()->route('admin.data-penduduk.index' , ['typeDocument' => 'pengajuan'])->with('error', 'Data berhasil ditolak.');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.data-penduduk.index')->with('error', 'Gagal memvalidasi pengajuan perubahan data ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }


    public function getDataRequest($typeDocument, $search, $order)
    {
        try {
            switch ($typeDocument) {
                case 'daftar-penduduk':
                    $residents = $this->residentContract->getFilteredResidentData($search, $order);
                    break;
                case 'pengajuan':
                    $residents = $this->residentContract->getFilteredRequestResidentData($search, $order);
                    break;
                case 'riwayat':
                    $residents = $this->residentContract->getFilteredHistoryResidentData($search, $order);
                    break;
            }
            return $residents;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data penduduk tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function showDetailResident(UserModel $resident)
    {
        try {
            $page = $this->page;
            $resident = UserModel::find($resident->id_penduduk);
            return view('admin._dasawismaData.show', compact('resident', 'page'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data penduduk tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }




    //========================FOR RESIDENT========================


    //For display resident data on the page "Resident->Data Penduduk"
    public function indexResident(Request $request)
    {
        try {
            $typeDocument = $request->query('typeDocument', 'pengajuan');
            $userId = Auth::id();
            $account = AccountModel::findOrFail($userId);
            $resident = UserModel::findOrFail($account->id_penduduk);
            $history = TempResidentModel::where('id_penduduk', $resident->id_penduduk)->get();
    
            return view('resident._residentData.index', [
                'title' => 'Data Diri', 
                'resident' => $resident, 
                'history' => $history,
                'typeDocument' => $typeDocument
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
    


    //For display edit form data that will be submitted

    public function editForm()
    {
        try {
            $userId = Auth::id();
            $account = AccountModel::findOrFail($userId);
            $resident = UserModel::findOrFail($account->id_penduduk);
            $title = 'Pengajuan Perubahan Data Penduduk';
            return view('resident._residentData.edit', compact('resident', 'title'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak dapat memuat formulir edit penduduk' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    //To store change data in database(temp penduduk)
    public function storeEditRequest(Request $request, UserModel $resident)
    {

        try {
            if ($this->residentContract->editRequest($request, $resident)) {
                return redirect()->route('resident.data-dasawisma.index', ['typeDocument' => 'riwayat']);
            } else {
                return redirect()->back()->with('error', 'Anda sudah mengajukan perubahan data. Harap tunggu proses verifikasi sebelum mengajukan perubahan lagi.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengajukan perubahan data ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
