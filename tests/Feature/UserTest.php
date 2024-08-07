<?php

namespace Tests\Feature;

use App\Models\AccountModel;
use App\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function can_create_user()
    {
        $accountData = [
            'id_user' => 89,
            'nama' => $this->faker->name,
            'password' => '12345678',
            'isAdmin' => 1
        ];
        $response = $this->post(route('account.store'), $accountData);
        $userData = [
            'id_user' => 89,
            'nama' => $this->faker->name,
            'urlProfile' => 'https://example.com/profile-image.jpg',
            'no_reg' => $this->faker->randomNumber(),
            'tgl_lahir' => $this->faker->date(),
            'nik' => '1234567891234599',
            'tempat_lahir' => $this->faker->city(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'rt' => $this->faker->numerify('##'),
            'umur' => $this->faker->numberBetween(18, 80),
            'status_kawin' => $this->faker->randomElement(['Kawin', 'Belum Kawin']),
            'status_keluarga' => $this->faker->randomElement(['Keluarga Inti', 'Keluarga Pendamping']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
            'alamat' => $this->faker->address(),
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']),
            'pekerjaan' => $this->faker->jobTitle(),
            'akseptor_kb' => $this->faker->boolean(),
            'jenis_akseptor' => $this->faker->randomElement(['Pil KB', 'Suntik KB', 'IUD', 'Kondom', 'Implan KB']),
            'aktif_posyandu' => $this->faker->boolean(),
            'has_BKB' => $this->faker->boolean(),
            'has_tabungan' => $this->faker->boolean(),
            'ikut_kel_belajar' => $this->faker->boolean(),
            'jenis_kel_belajar' => $this->faker->randomElement(['Tunas Harapan', 'Paud', 'TPQ', 'Sekolah Al-Quran']),
            'ikut_paud' => $this->faker->boolean(),
            'ikut_koperasi' => $this->faker->boolean(),
            'updated_at' => now(),
            'created_at' => now()
            // Tambahkan data lainnya sesuai kebutuhan
        ];
        $response = $this->post(route('user.store'), $userData);
        $this->assertDatabaseHas('penduduk', $userData);
    }

    /** @test */
    // public function can_update_user()
    // {
    //     $user = UserModel::factory()->create();

    //     $updatedData = [
    //         'name' => $this->faker->name,
    //         // Tambahkan data lainnya sesuai kebutuhan
    //     ];

    //     $response = $this->put(route('user.update', $user->id), $updatedData);

    //     $response->assertRedirect(route('user.index'));

    //     $this->assertDatabaseHas('users', $updatedData);
    // }

    // /** @test */
    // public function can_delete_user()
    // {
    //     $user = UserModel::factory()->create();

    //     $response = $this->delete(route('user.delete', $user->id));

    //     $response->assertRedirect(route('user.index'));

    //     $this->assertDatabaseMissing('users', ['id' => $user->id]);
    // }
}
