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
            $table->date('tgl_lahir');
            $table->string('nik')->unique();
            $table->string('nomor_kk')->index();
            $table->string('nama', 250);
            $table->string('tempat_lahir', 100);
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('rt') ;
            $table->enum('status_kawin',['Belum Menikah','Menikah', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('status_keluarga',['Kepala Keluarga','Istri','Anak']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu','Kepercayaan Lain']);
            $table->text('alamat');
            $table->enum('pendidikan',['Tidak tamat SD','SD','SMP','SMA','Diploma','Sarjana']);
            $table->enum('pekerjaan',['PNS', 'TNI/POLRI','Wirausaha','Wiraswasta','Pelajar/Mahasiswa']);
            $table->double('gaji');
            $table->double('pajak_bumi');
            $table->double('biaya_listrik');
            $table->double('biaya_air');
            $table->integer('jumlah_kendaraan_bermotor');
            $table->boolean('akseptor_kb');
            $table->string('jenis_akseptor', 100)->nullable();
            $table->boolean('aktif_posyandu');
            $table->boolean('has_BKB');
            $table->boolean('has_tabungan');
            $table->boolean('ikut_kel_belajar');
            $table->string('jenis_kel_belajar', 100)->nullable();
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
