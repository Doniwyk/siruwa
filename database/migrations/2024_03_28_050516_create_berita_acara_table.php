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
        Schema::create('berita_acara', function (Blueprint $table) {
            $table->id('id_berita_acara');
            $table->unsignedBigInteger('id_admin')->index();
            $table->string('url_gambar', 255);
            $table->string('judul', 100);
            $table->text('isi');
            $table->dateTime('tanggal');
            $table->timestamps();

            $table->foreign('id_admin')->references('id_admin')->on('admin');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acara');
    }
};
