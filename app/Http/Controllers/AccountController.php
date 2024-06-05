<?php

namespace App\Http\Controllers;

use App\Rules\ValidCurrentPassword;
use Illuminate\Http\Request;
use App\Contracts\AccountContract;
use App\Models\AccountModel;
use App\Models\UserModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
            $detailAccount = UserModel::findOrFail($account->id_penduduk);
            $page = 'profil';
            $title = 'Profil';
            $role = Auth::user()->role;
            // return view($role.'._profile.index', ['title' => $title, 'page' => $page, 'account' =>$account]);
            return view($role . '._profile.index', compact('account', 'detailAccount', 'page', 'title', 'userId'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }


    public function editAccount()
    {
        try {
            $userId = Auth::id();
            $account = AccountModel::findOrFail($userId);
            $resident = UserModel::findOrFail($userId); //To retrieve name and nik data 
            $title = 'Edit Profil';
            $page = 'profil';
            $role = Auth::user()->role;
            return view($role . '._profile.edit', compact('title', 'account', 'resident', 'page'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function updateAccount(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'noHp' => 'required|string|max:15',
                'urlProfile' => 'nullable'
            ]);

            $account = Auth::user();

            $this->akunContract->updateAccount($validated, $account);
            return response()->json(['message' => 'Account updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new ValidCurrentPassword],
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ], [
            'current_password.required' => 'Form Tidak Boleh Kosong',
            'new_password.required' => 'Form Tidak Boleh Kosong',
            'new_password.string' => 'Password Harus Alphanumerik',
            'new_password.min' => 'Password Minimal 8 Karakter',
            'new_password.confirmed' => 'Password Lama dan Baru Tidak Sesuai',
            'new_password_confirmation.required' => 'Form Tidak Boleh Kosong',
            'new_password_confirmation.string' => 'Password Harus Alphanumerik',
            'new_password_confirmation.min' => 'Password Minimal 8 Karakter',
        ]);

        $user = Auth::user();

        try {
            $this->akunContract->changePassword($user, $request->input('current_password'), $request->input('new_password'));
            return response()->json(['message' => 'Password updated successfully.'], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 403);
        }
    }

    public function getUserProfile()
    {
        try {
            $userId = Auth::id();
            $account = AccountModel::findOrFail($userId);
            $username = $account->username;
            $urlProfile = $account->urlProfile;
            return response()->json([
                'username' => $username,
                'urlProfile' => $urlProfile
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data not found.'], 404);
        }
    }
}
