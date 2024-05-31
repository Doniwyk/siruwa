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
            //BM -> Belum menikah
            //M -> Menikah
            //CH -> Cerai hidup
            //CM -> Cerai mati
            $table->enum('status_kawin',['BM','M', 'CH', 'CM']);
            $table->enum('status_keluarga',['kepala_keluarga','istri','anak']);
            //KL -> Kepercayaan lain
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu','KL']);
            $table->text('alamat');
            //TTS -> Tidak tamat SD
            $table->enum('pendidikan',['TTS','SD','SMP','SMA','Diploma','Sarjana']);
            //PM -> Pelajar/Mahasiswa
            //TB -> Tidak bekerja
            $table->enum('pekerjaan',['PNS', 'TNI/POLRI','Wirausaha','Wiraswasta','PM','TB']);
            $table->boolean('akseptor_kb');
            $table->string('jenis_akseptor', 100)->nullable();
            $table->boolean('aktif_posyandu');
            $table->boolean('has_BKB');
            $table->boolean('has_tabungan');
            $table->boolean('ikut_kel_belajar');
            $table->string('jenis_kel_belajar', 100)->nullable();
            $table->boolean('ikut_paud');
            $table->boolean('ikut_koperasi');
            $table->double('gaji');
            $table->double('pajak_bumi');
            $table->double('biaya_listrik');
            $table->double('biaya_air');
            $table->integer('total_pajak_kendaraan');
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
