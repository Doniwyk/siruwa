<?php

namespace App\Services;

use App\Contracts\AccountContract;
use App\Models\AccountModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AccountService implements AccountContract
{

    public function storeAccount(array $validatedData): void
    {
        AccountModel::create($validatedData);
    }

    public function updateAccount(array $validatedData, AccountModel $akun): void
    {
        $akun->update($validatedData);
    }

    public function deleteAccount(AccountModel $akun): void
    {
        $akun->delete();
    }

    public function changePassword(AccountModel $akun, string $currentPassword, string $newPassword): void
    {
        if (!Hash::check($currentPassword, $akun->password)) {
            throw ValidationException::withMessages(['current_password' => 'Current password is incorrect.']);
        }

        $akun->password = Hash::make($newPassword);
        $akun->save();
    }
}
