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
                p.nomor_kk,
                COALESCE(
                    MAX(CASE WHEN p.status_keluarga = "Kepala Keluarga" THEN p.nama END),
                    MAX(CASE WHEN p.status_keluarga = "Istri" THEN p.nama END),
                    MAX(CASE WHEN p.status_keluarga = "Anak" THEN p.nama END)
                ) AS nama_kepala_keluarga,
                COALESCE(
                    MAX(CASE WHEN p.status_keluarga = "Kepala Keluarga" THEN u.noHp END),
                    MAX(CASE WHEN p.status_keluarga = "Istri" THEN u.noHp END),
                    MAX(CASE WHEN p.status_keluarga = "Anak" THEN u.noHp END)
                ) AS nomor_hp_kepala_keluarga,
                SUM(p.gaji) AS total_gaji,
                SUM(p.pajak_bumi) AS total_pajak_bumi,
                SUM(p.biaya_listrik) AS total_biaya_listrik,
                SUM(p.biaya_air) AS total_biaya_air,
                SUM(p.total_pajak_kendaraan) AS total_pajak_kendaraan,
                SUM(p.jumlah_tanggungan) AS jumlah_tanggungan
            FROM
                (SELECT *,
                    ROW_NUMBER() OVER (PARTITION BY nomor_kk ORDER BY 
                        CASE status_keluarga
                            WHEN "Kepala Keluarga" THEN 1
                            WHEN "Istri" THEN 2
                            WHEN "Anak" THEN 3
                            ELSE 4
                        END) AS rn
                FROM penduduk
                ) p
            LEFT JOIN
                users u ON p.id_penduduk = u.id_penduduk AND p.rn = 1
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
