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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_penduduk')->index();
            $table->unsignedBigInteger('id_admin')->index();
            $table->enum('jenis', ['Iuran Kematian', 'Iuran Sampah']);
            $table->enum('metode', ['Tunai', 'Transfer']);
            $table->float('jumlah');
            $table->enum('status', ['Terverifikasi', 'Belum Terverifikasi'])->default('Belum Terverifikasi');
            $table->timestamps();

            $table->foreign('id_admin')->references('id_admin')->on('admin');
            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
