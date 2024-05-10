<?php

namespace Tests\Feature;

use App\Models\AccountModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationTest extends TestCase
{

    public function testLoginPage()
    {
        $this->get('/login')
            ->assertViewIs("user.login");
    }
    // public function testLoginPageForMember()
    // {
    // $response = $this->get(route('login'));
    // $response->assertStatus(200); 
    // $response->assertViewIs('user.login'); 
    //     $this->withSession([
    //         "userData.role" => "admin"
    //     ])->get(route('login'))
    //         ->assertRedirect('/admin/dashboard');
    // }

    public function testLoginSuccess()
    {
        $user = AccountModel::factory()->create(['role' => 'admin']);
        $this->post('/login', [
            "email" => $user->email,
            "password" => "asdfasdf"
        ])->assertRedirect("/admin/dashboard");
    }


    // public function testLoginForUserAlreadyLogin()
    // {
    //     $user = AccountModel::factory()->create(['role' => 'admin']);
    //     $this->withSession([
    //         "email" => $user->email
    //     ])->post('/login', [
    //         "email" => $user->email,
    //         "password" => "asdfasdf"
    //     ])->assertRedirect("/admin/dashboard");
    // }

    public function testLoginValidationError()
    {
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function testLoginFailed()
    {
        $response = $this->post(route('login'), [
            'email' => 'invalid@example.com',
            'password' => 'invalid-password',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    public function testLogout()
    {
        $user = AccountModel::factory()->create(['role' => 'admin']);

        $this->withSession([
            "email" => $user->email
        ])->get('/logout')
            ->assertRedirect("/login");
    }

    public function testLogoutGuest()
    {
        $this->get('/logout')
            ->assertRedirect("/login");
    }
}
