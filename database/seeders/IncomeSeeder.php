<?php

namespace Database\Seeders;

use App\Models\DeathFundModel;
use App\Models\GarbageFundModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $getDeathFundAmount = DeathFundModel::where('status', 'Lunas')->count() * 10000;
        $getGarbageFundAmount = GarbageFundModel::where('status', 'Lunas')->count() * 10000;

        DB::table('pemasukan')->insert(
            [
                'jumlah_pemasukan' => $getDeathFundAmount,
                'jenis_pemasukan' => 'Pemasukan Iuran Kematian',
            ]
        );

        DB::table('pemasukan')->insert(
            [
                'jumlah_pemasukan' => $getGarbageFundAmount,
                'jenis_pemasukan' => 'Pemasukan Iuran Sampah',
            ]
        );
    }
}
