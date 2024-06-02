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
        $response = cloudinary()->upload($validatedData['urlProfile']->getRealPath())->getSecurePath();
        $validatedData['urlProfile'] = $response;
        AccountModel::create($validatedData);
    }

    public function updateAccount(array $validatedData, AccountModel $akun): void
    {
        $image = $validatedData['urlProfile'];

        $cloudinaryImage = $image->storeOnCloudinary('profil');
        $url = $cloudinaryImage->getSecurePath();
        $publicId = $cloudinaryImage->getPublicId();
        
        $validatedData['image_public_id'] = $publicId;
        $validatedData['urlProfile'] = $url;
        
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
