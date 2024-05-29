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
        DB::table('data_dashboard')->insert(
            [
            'total_penduduk'=> 0,
            'fasilitas_kesehatan'=> 0,
            'fasilitas_administrasi'=> 0,
            'fasilitas_pendidikan'=> 0
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //

    }
};
