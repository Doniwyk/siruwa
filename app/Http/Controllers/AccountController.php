<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Contracts\AccountContract;
use App\Http\Requests\AccountRequest;
use App\Models\AccountModel;
use App\Models\UserModel;
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
        $title = 'Profil';
        $role= Auth::user()->role;
        // return view($role.'._profile.index', ['title' => $title, 'page' => $page, 'account' =>$account]);
        return view($role.'._profile.index', compact('account', 'page', 'title', 'userId'));

    }


    public function editAccount(): View
    {
        $userId = Auth::id();
        $account = AccountModel::findOrFail($userId);
        $resident = UserModel::findOrFail($userId); //To retrieve name and nik data 
        $title = 'Edit Profil';
        $role = Auth::user()->role;
        return view($role . '._profile.edit', ['title' => $title, 'account' => $account,'resident' =>$resident]);
    }

    public function updateAccount(AccountRequest $request, AccountModel $account): RedirectResponse
    {
        $role = Auth::user()->role;
        $validated = $request->validated();
        $this->akunContract->updateAccount($validated, $account);
        return redirect()->route($role . '._profile.index')->with('success', 'Data akun berhasil di ubah');
    }

}
