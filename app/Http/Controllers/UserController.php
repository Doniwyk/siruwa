<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\UserRequest;
use App\Models\PendudukModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendudukController extends Controller
{
    //
    protected UserContract $pendudukContract;

    public function __construct(UserContract $pendudukContract)
    {
        $this->pendudukContract = $pendudukContract;
    }

    public function index(){
        $penduduk = UserModel::all();
        return view('penduduk.index', ['data' => $penduduk]);
        //nanti sesuaikan nama view nya
    }

    public function add(){
        return view('penduduk.tambah');
        //nanti sesuaikan nama view nya
    }

    public function storePenduduk(UserRequest $request):RedirectResponse{
        $validated=$request->validated();
        $this->pendudukContract->storeUser($validated);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');    
    }

    public function updatePenduduk(UserModel $penduduk):View{
        return view('penduduk.edit', compact('penduduk'));
    }

    public function editUser(UserRequest $request, UserModel $penduduk):RedirectResponse{
        $validated = $request->validated();
        $this->pendudukContract->editUser($validated, $penduduk);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil di ubah');
    }

    public function deletePenduduk(UserModel $penduduk): RedirectResponse{
        $this->pendudukContract->deleteUser($penduduk);
        
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil di hapus.');


    }
}
