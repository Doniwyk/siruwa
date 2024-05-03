<?php

namespace App\Http\Controllers;

use App\Contracts\AuthenticationContract as ContractsAuthenticationContract;
use App\Http\Requests\AuthenticationRequest;
use App\Services\AuthenticationContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * @param AuthenticationContract $authenticationContract
     */
    public function __construct(
        private ContractsAuthenticationContract $authenticationContract
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
                // return redirect()->route('admin._statistics.index'); //Nanti disesuaikan
                // return view('welcome');
                return redirect()->route('autistic');
            } else {
                return redirect()->route('landingPage');
            }
        } catch (\Exception $e) {
            dd($e);
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
