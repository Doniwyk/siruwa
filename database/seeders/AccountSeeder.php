<?php

namespace Database\Seeders;

use App\Models\AccountModel;
use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resident = UserModel::factory()->create();
        AccountModel::create([
            'id_penduduk' => $resident->id_penduduk,
            'urlProfile' => fake()->imageUrl(),
            'noHp' => fake()->phoneNumber(),
            'username' => '11111111',
            'email' => fake()->unique()->email(),
            'email_verified_at' => now(),
            'password' => bcrypt('asdfasdf'),
            'role' => 'admin',
        ]);

        AccountModel::create([
            'id_penduduk' => $resident->id_penduduk,
            'urlProfile' => fake()->imageUrl(),
            'noHp' => fake()->phoneNumber(),
            'username' => '22222222',
            'email' => fake()->unique()->email(),
            'email_verified_at' => now(),
            'password' => bcrypt('asdfasdf'),
            'role' => 'resident',
        ]);

        AccountModel::factory(5)->create();

    }
}
