<?php

namespace Database\Seeders;

use App\Models\GarbageFundModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GarbageFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DeathFundModel::factory(1)->create();
        //DeathFundModel::factory(1)->forEachKK();
        $id_pembayaran = 1;
        foreach (range(1,25) as $id) {
            $nomor_kk = DB::table('pembayaran')->where('id_pembayaran', $id_pembayaran)->value('nomor_kk');
            $total = (DB::table('pembayaran')->where('id_pembayaran', $id_pembayaran)->value('jumlah')) / 10000;
            $deathFundFactory = GarbageFundModel::factory();
            $deathFundFactory->forEachKK(12, ($id_pembayaran), $nomor_kk, $total);
            $id_pembayaran+=2;
        }
    }
}
