<?php

namespace App\Services;

use App\Contracts\AccountContract;
use App\Models\AccountModel;

class AccountService implements AccountContract
{

    public function storeAccount(array $validatedData): void
    {
        AccountModel::create($validatedData);
    }

    public function updateAccount(array $validatedData, AccountModel $akun): void
    {
        $akun->save($validatedData);
    }

    public function deleteAccount(AccountModel $akun): void
    {
        $akun->delete();
    }
}
