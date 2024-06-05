<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class spkviews extends Migration
{
    public function up(): void
    {
        DB::statement('
            create view spk as 
            SELECT
            p.nomor_kk,
            MAX(CASE WHEN p.status_keluarga = "Kepala Keluarga" THEN p.nama ELSE NULL END) AS nama_kepala_keluarga,
            MAX(CASE WHEN p.status_keluarga = "Kepala Keluarga" THEN u.noHp ELSE NULL END) AS nomor_hp_kepala_keluarga,
            SUM(p.gaji) AS total_gaji,
            SUM(p.pajak_bumi) AS total_pajak_bumi,
            SUM(p.biaya_listrik) AS total_biaya_listrik,
            SUM(p.biaya_air) AS total_biaya_air,
            SUM(p.total_pajak_kendaraan) AS total_pajak_kendaraan
            FROM
                penduduk p
            LEFT JOIN
                users u ON p.id_penduduk = u.id_penduduk
            GROUP BY
                p.nomor_kk;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS spk');
    }
}
