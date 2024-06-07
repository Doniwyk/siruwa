<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::table('pengeluaran')->insert(
            [
                'jumlah_pengeluaran' => 0,
                'jenis_pengeluaran' => 'Iuran Kematian',
            ]
        );

        DB::table('pengeluaran')->insert(
            [
                'jumlah_pengeluaran' => 0,
                'jenis_pengeluaran' => 'Iuran Sampah',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
