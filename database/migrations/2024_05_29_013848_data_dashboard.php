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
        //
        Schema::create('data_dashboard', function (Blueprint $table) {
            $table->id('id_dataDashboard');
            $table->integer('total_penduduk')->default(0)->nullable();
            $table->integer('fasilitas_kesehatan')->default(0)->nullable();
            $table->integer('fasilitas_administrasi')->default(0)->nullable();
            $table->integer('fasilitas_pendidikan')->default(0)->nullable();
            $table->string('image')->nullable();
            $table->string('image_public_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('data_dashboard');
    }
};
