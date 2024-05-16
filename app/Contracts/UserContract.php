<?php

namespace App\Contracts;

use App\Models\UserModel;
use Illuminate\Http\Request;

interface UserContract
{
    public function storeUser(array $validatedData):UserModel;

    public function updateUser(array $validatedData, UserModel $penduduk);

    public function deleteUser(UserModel $penduduk);

    public function validateEditRequest(Request $request, UserModel $resident);

    public function editRequest(Request $request, UserModel $resident);
}
