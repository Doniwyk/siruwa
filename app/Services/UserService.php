<?php

namespace App\Services;

use App\Contracts\PendudukContract;
use App\Contracts\UserContract;
use App\Models\PendudukModel;
use App\Models\UserModel;

class UserService implements UserContract
{

    public function storeUser(array $validatedData):UserModel
    {
        return UserModel::create($validatedData);
    }

    public function updateUser(array $validatedData, UserModel $penduduk):void
    {
        $penduduk->update($validatedData);
    }

    public function deleteUser(UserModel $penduduk):void
    {
        $penduduk->delete();
    }
}
