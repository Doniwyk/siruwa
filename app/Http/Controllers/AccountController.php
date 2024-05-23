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

    public function updateAccount(Request $request)
    {
        
        try {
            $role = Auth::user()->role;
            $account = Auth::user();
            
            // Validasi input
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'noHp' => 'required|string|max:15',
            ]);
            $this->akunContract->updateAccount($validated, $account);
            return response()->json(['message' => 'Account updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        try {
            $this->akunContract->changePassword($user, $request->input('current_password'), $request->input('new_password'));
            return response()->json(['message' => 'Password updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }
    }
}
