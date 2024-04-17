<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\UserPostRequest;
use App\Services\AuthenticationContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthenticationController extends Controller
{

    /**
     * @param AuthenticationContract $authenticationContract
     */
    public function __construct(
        private AuthenticationContract $authenticationContract
    ) {
    }

    public function login(): Response
    {
        return response()
            ->view("login");
    }

    public function doLogin(AuthenticationRequest $request): Response|RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->authenticationContract->authenticate($request);
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin._statistics.index'); //Nanti disesuaikan
            } else {
                return redirect()->route('user.index');
            }
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Email or password is wrong',
            ])->onlyInput('email');
        }
    }

    public function doLogout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
