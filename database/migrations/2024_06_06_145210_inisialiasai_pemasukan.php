<?php

use App\Models\DeathFundModel;
use App\Models\GarbageFundModel;
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

        DB::table('pemasukan')->insert(
            [
                'jumlah_pemasukan' => 0,
                'jenis_pemasukan' => 'Iuran Kematian',
            ]
        );

        DB::table('pemasukan')->insert(
            [
                'jumlah_pemasukan' => 0,
                'jenis_pemasukan' => 'Iuran Sampah',
            ]
        );
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
