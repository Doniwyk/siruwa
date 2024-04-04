<?php

namespace App\Contracts;

use App\Models\UserModel;

interface UserContract
{
    public function storeUser(array $validatedData):void;

    public function editUser(array $validatedData, UserModel $penduduk);

    public function deleteUser(UserModel $penduduk);
}
