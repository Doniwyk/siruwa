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
        Schema::create('iuran_sampah', function (Blueprint $table) {
            $table->id('id_iuran_sampah');
            $table->unsignedBigInteger('id_pembayaran')->index()->nullable();
            $table->date('bulan');
            $table->enum('status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->timestamps();

            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuran_sampah');
    }
};
