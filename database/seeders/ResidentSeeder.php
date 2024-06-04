<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;



class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (range(1, 125) as $familyNumber) {
            $nomorKk = Str::random(16);
            $religion = fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Kepercayaan Lain']);
            $rt = fake()->numberBetween(1,10);
            $address = fake()->address();


            // Create kepala keluarga
            UserModel::factory()->kepalaKeluarga($religion)->create([
                'nomor_kk' => $nomorKk,
            ]);

            // Create istri
            UserModel::factory()->istri($nomorKk, $religion,$rt)->create();

            // Create 2 anak
            UserModel::factory()->count(2)->anak($nomorKk, $religion)->create();
        }
    }
}
