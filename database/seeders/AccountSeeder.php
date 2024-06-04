<?php

namespace Database\Seeders;

use App\Models\AccountModel;
use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'image_public_id' => '1'
        ]);

        $resident1 = UserModel::factory()->create();
        AccountModel::create([
            'id_penduduk' => $resident1->id_penduduk,
            'urlProfile' => fake()->imageUrl(),
            'noHp' => fake()->phoneNumber(),
            'username' => '22222222',
            'email' => fake()->unique()->email(),
            'email_verified_at' => now(),
            'password' => bcrypt('asdfasdf'),
            'role' => 'resident',
            'image_public_id' => '2'

        ]);



        //AccountModel::factory(50)->create();
        $totalResident = DB::table('penduduk')->count();
        foreach (range(1, $totalResident-2) as $id) {
            $resident = DB::table('penduduk')->where('id_penduduk', $id)->first();
            AccountModel::create([
                'id_penduduk' => $resident->id_penduduk,
                'urlProfile' => fake()->imageUrl(),
                'noHp' => fake()->phoneNumber(),
                'username' => $resident->nik,
                'email' => fake()->unique()->email(),
                'email_verified_at' => now(),
                'password' => bcrypt(' $resident->nik'),
                'role' => 'resident',
                'image_public_id' => '1'
            ]);

        }

    }
}
