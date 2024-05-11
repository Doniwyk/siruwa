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

    // public function __construct(AccountContract $accountContract)
    // {
    //     $this->accountContract = $accountContract;
    // }
    
    //========================FOR ADMIN========================
    public function indexAdmin(){
        $resident = UserModel::all();
        return view('admin._dasawismaData.index', ['pages' => 'Data Penduduk', 'resident' => $resident]);
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
                'nama' => $resident->nickname,
                'email' => $resident->email,
                'password' => bcrypt('$resident->nomor_kk'),
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
    public function validateEditRequest(Request $request,UserRequest $residentRequest, UserModel $resident){
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

    //========================FOR RESIDENT========================

    public function indexResident()
    {
        $userId = Auth::id();
        $resident = UserModel::findOrFail($userId);
        return view('resident._dasawismaData.index', ['pages' => 'Data Anda', 'resident' => $resident]);
    }

    public function editForm(){
        $userId = Auth::id();
        $resident = UserModel::findOrFail($userId);
        return view('resident.data-dasawisma.edit', compact('resident'));
    }

    public function requestEditForm(){

    }


}
