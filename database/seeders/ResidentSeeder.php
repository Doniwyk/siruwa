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
    private static $nomor_kk = 3507010201082551;
    public function run()
    {

        foreach (range(1, 25) as $familyNumber) {
            $nmr_kk = self::$nomor_kk++;
            $nomorKk = str_pad($nmr_kk, 16, '0', STR_PAD_LEFT);
            $religion = fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Kepercayaan Lain']);
            $rt = fake()->numberBetween(1, 10);
            $address = 'Desa Sumberejo, Kecamatan Batu, Kota Batu, Jawa Timur';



            // Create kepala keluarga
            UserModel::factory()->kepalaKeluarga($religion)->create([
                'nomor_kk' => $nomorKk,
                'agama' => $religion,
                'alamat'=> $address,
                'rt' => $rt
            ]);

            // Create istri
            UserModel::factory()->wife($nomorKk, $religion, $rt, $address)->create();

            // Create 2 anak
            UserModel::factory()->count(2)->child($nomorKk, $religion,$rt, $address)->create();
        }


    }
}
