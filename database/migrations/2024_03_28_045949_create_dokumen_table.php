<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->unsignedBigInteger('id_penduduk')->index();
            $table->string('jenis', 100);
            //MV = Menunggu verivikasi
            //P = Proses
            //BA = bisa diambil
            //DT = Ditolak
            //DB = Dibatalkan            
            //S = Selesai            
            $table->enum('status',['MV','P','BA','DT','DB', 'S']);
            $table->text('keterangan_status')->nullable();
            $table->text('keperluan');
            $table->timestamps();

            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
