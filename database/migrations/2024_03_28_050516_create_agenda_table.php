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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id('id_agenda');
            $table->unsignedBigInteger('id_admin')->index();
            $table->string('url_gambar', 255);
            $table->string('image_public_id', 255)->nullable();
            $table->string('judul', 100);
            $table->text('isi');
            $table->enum('status', ['Uploaded', 'Draft'])->default('Uploaded');
            $table->dateTime('tanggal');
            $table->timestamps();

            $table->foreign('id_admin')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
