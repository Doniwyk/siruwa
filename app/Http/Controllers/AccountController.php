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
        $akun = AccountModel::all();
        $page = 'edit-profil';
        return view('admin._profile.index', ['pages' => 'statistik', 'page' => $page]);
        // return view('akun.index', compact('akun'));
        //nanti sesuaikan nama view nya
    }

    public function add()
    {
        return view('akun.tambah');
        //nanti sesuaikan nama view nya
    }

    public function storeACcount(AccountRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->akunContract->storeAccount($validated);

        return redirect()->route('akun.index')->with('success', 'Data akun berhasil ditambahkan.');
    }

    public function editAccount(AccountModel $akun): View
    {
        return view('akun.edit', compact('akun'));
    }

    public function updateAccount(AccountRequest $request, AccountModel $akun): RedirectResponse
    {
        $validated = $request->validated();
        $this->akunContract->updateAccount($validated, $akun);

        return redirect()->route('akun.index')->with('success', 'Data akun berhasil di ubah');
    }

    public function deleteAccount(AccountModel $akun): RedirectResponse
    {
        $this->akunContract->deleteAccount($akun);

        return redirect()->route('akun.index')->with('success', 'Data akun berhasil di hapus.');
    }
}
