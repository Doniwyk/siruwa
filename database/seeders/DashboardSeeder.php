<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_dashboard')->insert(
            [
                'total_penduduk' => 0,
                'fasilitas_kesehatan' => 0,
                'fasilitas_administrasi' => 0,
                'fasilitas_pendidikan' => 0
            ]
        );
    }
}
