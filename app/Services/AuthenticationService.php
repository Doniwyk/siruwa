<?php

namespace App\Services\Impl;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\UserPostRequest;
use App\Services\AuthenticationContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class AuthenticationService implements AuthenticationContract
{
    function authenticate(AuthenticationRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            return;
        }
    }
}
