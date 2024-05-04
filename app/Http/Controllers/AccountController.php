<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Contracts\AccountContract;
use App\Http\Requests\AccountRequest;
use App\Models\AccountModel;

class AccountController extends Controller
{
    protected AccountContract $akunContract;

    public function __construct(AccountContract $akunContract)
    {
        $this->akunContract = $akunContract;
    }

    public function index()
    {
        $account = AccountModel::all();
        $page = 'edit-profil';
        return view('admin._profile.index', ['pages' => 'profil', 'page' => $page, 'account' =>$account]);
    }

    public function add()
    {
        return view('admin._profile.add');
    }

    public function storeAccount(AccountRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->akunContract->storeAccount($validated);

        return redirect()->route('admin.profil.edit')->with('success', 'Data akun berhasil ditambahkan.');
    }

    public function editAccount(AccountModel $akun): View
    {
        return view('admin._profile.edit', compact('akun'));
    }

    public function updateAccount(AccountRequest $request, AccountModel $akun): RedirectResponse
    {
        $validated = $request->validated();
        $this->akunContract->updateAccount($validated, $akun);
        return redirect()->route('admin.profil.index')->with('success', 'Data akun berhasil di ubah');
    }

    public function deleteAccount(AccountModel $akun): RedirectResponse
    {
        $this->akunContract->deleteAccount($akun);

        return redirect()->route('admin.profil.index')->with('success', 'Data akun berhasil di hapus.');
    }
}
