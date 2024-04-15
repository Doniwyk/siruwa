<?php

namespace Tests\Feature;

use App\Models\AccountModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    /**
     * A basic feature test example.
     */ 
    use WithFaker;

    /** @test */
    // public function canCreateAccount()
    // {
    //     $accountData = [
    //         'id_user'=>1,
    //         'nama' => $this->faker->name,
    //         'password' => '12345678',
    //         'isAdmin' => 1
    //     ];
    //     $response = $this->post(route('account.store'), $accountData);
    //     $response->assertRedirect(route('account.index'));
    //     $this->assertDatabaseHas('user', $accountData);
    // }

    /** @test */
    public function canEditAccount()
    {
        // Membuat instance AccountModel untuk pengujian
        $account = AccountModel::factory()->create();

        // Menyiapkan data untuk pembaruan akun
        $updatedData = [
            'id_user' => $account->id_user,
            'nama' => 'Nadila Amalia',
            'password' => '12345678',
            'isAdmin' => 1
        ];
        $response = $this->put(route('account.update', $account), $updatedData);
        // Memastikan bahwa data akun telah diperbarui di database
        $this->assertDatabaseHas('user', $updatedData);
    }

    public function canDeleteAccount()
    {
        // Membuat instance AccountModel untuk pengujian
        $account = AccountModel::factory()->create();

        // Menghapus akun
        $response = $this->delete(route('account.delete', $account));

        // Memastikan bahwa akun telah dihapus dari database
        $this->assertDatabaseMissing('user', ['id_user' => $account->id_user]);
    }

}