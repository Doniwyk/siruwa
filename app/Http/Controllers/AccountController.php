<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Contracts\AccountContract;
use App\Http\Requests\AccountRequest;
use App\Models\AccountModel;
use App\Models\UserModel;
use Exception;
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

        try {
            $userId = Auth::id();
            $account = AccountModel::findOrFail($userId);
            $detailAccount = UserModel::findOrFail($userId);
            $page = 'profil';
            $title = 'Profil';
            $role = Auth::user()->role;
            // return view($role.'._profile.index', ['title' => $title, 'page' => $page, 'account' =>$account]);
            return view($role . '._profile.index', compact('account','detailAccount', 'page', 'title', 'userId'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }


    public function editAccount(): View
    {
        try {
            $userId = Auth::id();
            $account = AccountModel::findOrFail($userId);
            $resident = UserModel::findOrFail($userId); //To retrieve name and nik data 
            $title = 'Edit Profil';
            $role = Auth::user()->role;
            return view($role . '._profile.edit', ['title' => $title, 'account' => $account, 'resident' => $resident]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function updateAccount(AccountRequest $request, AccountModel $account): RedirectResponse
    {
        try {
            $role = Auth::user()->role;
            $validated = $request->validated();
            $this->akunContract->updateAccount($validated, $account);
            return redirect()->route($role . '._profile.index')->with('success', 'Data akun berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route($role . '._profile.index')->with('error', 'Data akun gagal diubah ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
