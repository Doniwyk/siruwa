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
            // $table->unsignedBigInteger('id_penduduk')->index();
            $table->unsignedBigInteger('id_admin')->index()->nullable();
            $table->unsignedBigInteger('id_penduduk')->index();
            $table->string('nomor_kk')->index();
            $table->enum('jenis', ['Iuran Kematian', 'Iuran Sampah']);
            $table->enum('metode', ['Tunai', 'Transfer']);
            $table->string('urlBuktiPembayaran', 250);
            $table->string('image_public_id', 255)->nullable();
            $table->float('jumlah')->nullable();
            $table->enum('status', ['Terverifikasi', 'Belum Terverifikasi', 'Ditolak'])->default('Belum Terverifikasi');
            $table->string('keterangan_status', 250)->nullable();

            $table->timestamps();

            $table->foreign('id_admin')->references('id')->on('users');
            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduk');
            $table->foreign('nomor_kk')->references('nomor_kk')->on('penduduk');
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
