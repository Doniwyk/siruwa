<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ValidCurrentPassword implements Rule
{
    public function passes($attribute, $value)
    {
        return Hash::check($value, Auth::user()->password);
    }

    public function message()
    {
        return 'Password Lama Salah';
    }
}