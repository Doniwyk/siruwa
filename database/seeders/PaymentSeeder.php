<?php

namespace Database\Seeders;

use App\Models\PaymentModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Initialize the id_penduduk counter
        $id_penduduk = 1;
        $amounts = [10000, 20000, 30000,40000,50000,60000,70000,80000,90000,100000,110000,120000];
        // Loop through 1 to 50
        foreach (range(1, 50) as $i) {
            // Get nomor_kk for current id_penduduk
            $nomor_kk = DB::table('penduduk')->where('id_penduduk', $id_penduduk)->value('nomor_kk');
            // Determine the type of payment and amount based on whether the number is odd or even
            if ($i % 2 == 0) {
                // Even: 'Iuran Kematian'
                $jenis = 'Iuran Kematian';
            } else {
                // Odd: 'Iuran Sampah'
                $jenis = 'Iuran Sampah';
            }
            $jumlah = $amounts[array_rand($amounts)];
            // Create a new payment record with the determined values
            PaymentModel::factory()->create([
                'id_penduduk' => $id_penduduk,
                'nomor_kk' => $nomor_kk,
                'jenis' => $jenis,
                'jumlah' => $jumlah,
            ]);

            // Increment id_penduduk every two iterations
            if ($i % 2 == 0) {
                $id_penduduk = $id_penduduk  + 4;
            }
        }
    }
}
