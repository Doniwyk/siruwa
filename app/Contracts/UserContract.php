<?php

namespace App\Contracts;

use App\Models\UserModel;
use Illuminate\Http\Request;

interface UserContract
{
    public function storeUser(array $validatedData): UserModel;

    public function updateUser(array $validatedData, UserModel $penduduk);

    public function deleteUser(UserModel $penduduk);

    public function validateEditRequest(string $action, $id);

    public function editRequest(Request $request, UserModel $resident);

    public function getFilteredResidentData($search, $order);

    public function getFilteredRequestResidentData($search, $order);

    public function getFilteredHistoryResidentData($search, $order);
}
