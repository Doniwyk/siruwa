<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\UserRequest;
use App\Models\PendudukModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    //
    protected UserContract $pendudukContract;

    public function __construct(UserContract $pendudukContract)
    {
        $this->pendudukContract = $pendudukContract;
    }

    public function index(){
        $resident = UserModel::all();
        return view('admin._dasawismaData.index', ['pages' => 'Data Penduduk','resident' => $resident]);
    }

    public function add(){
        return view('admin._dasawismaData.add');
    }

    public function storeUser(UserRequest $request):RedirectResponse{
        $validated=$request->validated();
        $this->pendudukContract->storeUser($validated);
        return redirect()->route('data-dasawisma')->with('success', 'Data penduduk berhasil ditambahkan.');    
    }

    public function editUser(UserModel $penduduk):View{
        return view('admin._dasawismaData.edit', compact('penduduk'));
    }

    public function updateUser(UserRequest $request, UserModel $penduduk):RedirectResponse{
        $validated = $request->validated();
        $this->pendudukContract->updateUser($validated, $penduduk);

        return redirect()->route('data-dasawisma')->with('success', 'Data penduduk berhasil di ubah');
    }

    public function deleteUser(UserModel $penduduk): RedirectResponse{
        $this->pendudukContract->deleteUser($penduduk);
        
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil di hapus.');


    }
}
