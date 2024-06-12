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

        //AccountModel::factory(50)->create();
        $totalResident = DB::table('penduduk')->count();
        $idResident = 1;
        foreach (range(1, 5) as $id) {
            $resident = DB::table('penduduk')->where('id_penduduk', $idResident)->first();
            AccountModel::create([
                'id_penduduk' => $resident->id_penduduk,
                'urlProfile' => fake()->imageUrl(),
                'noHp' => fake()->regexify('\+628[0-9]{8,12}'),
                'username' => 'admin00'.$id,
                'email' => fake()->unique()->email(),
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]);
            $idResident+=4;
        }

        foreach (range(1, $totalResident) as $id) {
            $resident = DB::table('penduduk')->where('id_penduduk', $id)->first();
            AccountModel::create([
                'id_penduduk' => $resident->id_penduduk,
                'urlProfile' => fake()->imageUrl(),
                'noHp' => fake()->regexify('\+628[0-9]{8,12}'),
                'username' => $resident->nik,
                'email' => fake()->unique()->email(),
                'email_verified_at' => now(),
                'password' => bcrypt($resident->nik),
                'role' => 'resident',
            ]);
        }
    }
}
