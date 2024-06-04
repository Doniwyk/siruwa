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

        // Loop through 1 to 50
        foreach (range(1, 250) as $i) {
            // Get nomor_kk for current id_penduduk
            $nomor_kk = DB::table('penduduk')->where('id_penduduk', $id_penduduk)->value('nomor_kk');

            // Determine the type of payment and amount based on whether the number is odd or even
            if ($i % 2 == 0) {
                // Even: 'Iuran Kematian'
                $jenis = 'Iuran Kematian';
                $jumlah = 70000;
            } else {
                // Odd: 'Iuran Sampah'
                $jenis = 'Iuran Sampah';
                $jumlah = 50000;
            }

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
