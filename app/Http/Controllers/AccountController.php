<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Contracts\AccountContract;
use App\Http\Requests\AccountRequest;
use App\Models\AccountModel;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected AccountContract $akunContract;

    public function __construct(AccountContract $akunContract)
    {
        $this->akunContract = $akunContract;
    }

    public function index()
    {
        $userId = Auth::id();
        $account = AccountModel::findOrFail($userId);
        $page = 'profil';
        $pageHeader = 'Profil';
        $role= Auth::user()->role;
        // return view($role.'._profile.index', ['pageHeader' => $pageHeader, 'page' => $page, 'account' =>$account]);
        return view($role.'._profile.index', compact('account', 'page', 'pageHeader', 'userId'));
    }


    public function editAccount(AccountModel $akun): View
    {
        $role = Auth::user()->role;
        return view($role.'._profile.edit', compact('akun'));
    }

    public function updateAccount(AccountRequest $request, AccountModel $akun): RedirectResponse
    {
        $role = Auth::user()->role;
        $validated = $request->validated();
        $this->akunContract->updateAccount($validated, $akun);
        return redirect()->route($role . '._profile.edit')->with('success', 'Data akun berhasil di ubah');
    }

}
