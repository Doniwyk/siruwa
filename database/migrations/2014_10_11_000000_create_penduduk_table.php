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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id('id_penduduk');
            $table->string('no_reg', 25);
            $table->date('tgl_lahir');
            $table->string('nik')->unique();
            $table->string('nomor_kk')->index();
            $table->string('nama', 250);
            $table->string('tempat_lahir', 100);
            $table->char('jenis_kelamin', 2);
            $table->integer('rt');
            $table->integer('umur');
            $table->string('status_kawin', 50);
            $table->string('status_keluarga', 100);
            $table->string('agama', 100);
            $table->text('alamat');
            $table->string('pendidikan', 100);
            $table->string('pekerjaan', 100);
            $table->double('gaji');
            $table->double('pajak_bumi');
            $table->double('biaya_listrik');
            $table->double('biaya_air');
            $table->integer('jumlah_kendaraan_bermotor');
            $table->boolean('akseptor_kb');
            $table->string('jenis_akseptor', 100);
            $table->boolean('aktif_posyandu');
            $table->boolean('has_BKB');
            $table->boolean('has_tabungan');
            $table->boolean('ikut_kel_belajar');
            $table->string('jenis_kel_belajar', 100);
            $table->boolean('ikut_paud');
            $table->boolean('ikut_koperasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};