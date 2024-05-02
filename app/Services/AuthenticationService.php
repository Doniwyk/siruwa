<?php

namespace App\Services;

use App\Contracts\AuthenticationContract as ContractsAuthenticationContract;
use App\Http\Requests\AuthenticationRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticationService implements ContractsAuthenticationContract
{
    function authenticate(AuthenticationRequest $request)
    {
        $credentials = [
            'name' => $request->nama,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, true)) {
            return;
        }
    }
}
