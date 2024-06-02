<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class spkviews extends Migration
{
    public function up(): void
    {
        DB::statement('
            CREATE VIEW spk AS
            SELECT
                nomor_kk,
                MAX(CASE WHEN status_keluarga = "kepala_keluarga" THEN nama ELSE NULL END) AS nama,
                SUM(gaji) AS total_gaji,
                SUM(pajak_bumi) AS total_pajak_bumi,
                SUM(biaya_listrik) AS total_biaya_listrik,
                SUM(biaya_air) AS total_biaya_air,
                SUM(total_pajak_kendaraan) AS total_pajak_kendaraan
            FROM
                penduduk
            GROUP BY
                nomor_kk
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS penduduk_summary');
    }
}
