<?php

namespace Database\Seeders;

use App\Models\DeathFundModel;
use App\Models\PaymentModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeathFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DeathFundModel::factory(1)->create();
        //DeathFundModel::factory(1)->forEachKK();
        $id_pembayaran = 2;
        foreach (range(1, 125) as $id) {
            $nomor_kk = DB::table('pembayaran')->where('id_pembayaran', $id_pembayaran)->value('nomor_kk');
            $deathFundFactory = DeathFundModel::factory();
            $deathFundFactory->forEachKK(12, ($id_pembayaran), $nomor_kk);
            $id_pembayaran += 2;
        }
    }
}
