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
    public function indexAdmin(){
        try{
            $resident = UserModel::all();
            return view('admin._dasawismaData.index', ['title' => 'Data Penduduk', 'residents' => $resident]);
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Data penduduk tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }

    public function add(){
        return view('admin._dasawismaData.add');
    }

    public function storeResident(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        try{
            $resident  = $this->residentContract->storeUser($validated);
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
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data penduduk: ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }

    public function deleteResident(UserModel $resident): RedirectResponse
    {
        try{
            $this->residentContract->deleteUser($resident);
            return redirect()->route('admin.data-dasawisma.index')->with('success', 'Data penduduk berhasil dihapus.');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Gagal menghapus data penduduk: ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }

    //EDIT BY ADMIN
    public function editResident(UserModel $resident): View
    {
        return view('admin._dasawismaData.edit', compact('resident'));
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

    public function indexRequest(){
        try{
            $requestEdit = TempResidentModel::all();
            return view('admin._dasawismaData.index', ['title' => 'Data Penduduk', 'requestEdit' => $requestEdit]);
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Pengajuan perubahan data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

        
    }

    public function validateEditRequest(Request $request, UserModel $resident){
        $request->validate([
            'action' => 'required|in:accept,reject',
        ]);
        try{
            $this->residentContract->validateEditRequest($request,$resident);
            if ($request->action === 'accept') {
                return redirect()->route('admin.data-dasawisma.request')->with('success', 'Data berhasil disetujui.');
            } elseif ($request->action === 'reject') {
                return redirect()->route('admin.data-dasawisma.request')->with('error', 'Data berhasil ditolak.');
            }
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Gagal memvalidasi pengajuan perubahan data ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

        
    }


    //========================FOR RESIDENT========================

    public function indexResident()
    {
        $userId = Auth::id();
        $resident = UserModel::findOrFail($userId);
        return view('resident._dasawismaData.index', ['title' => 'Data Diri', 'resident' => $resident]);
    }

    public function editForm(){
        $userId = Auth::id();
        $resident = UserModel::findOrFail($userId);
        return view('resident.data-dasawisma.edit', compact('resident'));
    }

    public function storeEditRequest(Request $request, UserModel $resident){

        try{
            if($this->residentContract->editRequest($request,$resident)){
                return redirect()->back()->with('success', 'Formulir pengajuan edit berhasil disimpan.');        
            } else {
                return redirect()->back()->with('error', 'Anda sudah mengajukan perubahan data. Harap tunggu proses verifikasi sebelum mengajukan perubahan lagi.');
            }
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Gagal mengajukan perubahan data ' . $e->getMessage())->withErrors([$e->getMessage()]);

        }
    }

    public function historyEditRequest(UserModel $penduduk)
    {
        $history = TempResidentModel::where('id_penduduk', $penduduk->id_penduduk);
        return view('resident._dasawismaData.history', ['title' => 'Data Penduduk', 'history' => $history]);
    }



}
