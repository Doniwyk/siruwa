<?php

namespace App\Contracts;

use App\Models\AccountModel;

interface AccountContract
{
    public function storeAccount(array $validatedData): void;

    public function updateAccount(array $validatedData, AccountModel $akun) :void;

    public function deleteAccount(AccountModel $akun);
}
