<?php

namespace Database\Seeders;

use App\Models\NewsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsModel::create([
            'id_admin' => 5,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => 'Gotong Royong Membersihkan Lingkungan RW 02',
            'isi' => 'Pada hari Minggu, 01 Mei 2024, warga RW 02 Desa Sumberejo, Kecamatan Batu, 
                        Kota Batu melaksanakan kegiatan gotong royong membersihkan lingkungan sekitar. 
                        Kegiatan ini dimulai pukul 07.00 WIB dengan membersihkan selokan, memotong rumput liar, 
                        dan mengumpulkan sampah. Ketua RW 05,Bapak Agus, mengapresiasi partisipasi 
                        aktif warga dan mengajak semua untuk terus menjaga kebersihan lingkungan demi kesehatan bersama.',
        ]);
        NewsModel::create([
            'id_admin' => 1,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => 'Pemadaman Listrik',
            'isi' => ' PLN mengumumkan bahwa akan ada pemadaman listrik sementara di wilayah RW 05 pada hari Rabu, 15 Mei 2024, 
                        mulai pukul 09.00 hingga 15.00 WIB. Pemadaman ini dilakukan dalam rangka pemeliharaan jaringan listrik
                        untuk meningkatkan kualitas layanan. Warga diharapkan mempersiapkan diri dengan bijak dan menjaga 
                        alat elektronik agar tidak rusak.',
        ]);
        NewsModel::create([
            'id_admin' => 2,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => 'Kegiatan Posyandu Balita diRW 02',
            'isi' => 'Posyandu Balita RW 05 akan mengadakan kegiatan rutin pada hari Sabtu, 1 Juni 2024, 
                    mulai pukul 08.00 WIB. Kegiatan ini meliputi penimbangan, imunisasi, dan pemeriksaan 
                    kesehatan bagi balita. Ibu-ibu yang memiliki anak balita diharapkan untuk hadir dan 
                    membawa buku kesehatan anak. Kegiatan ini bertujuan untuk memantau tumbuh kembang anak 
                    dan memberikan edukasi kesehatan bagi ',
        ]);
        NewsModel::create([
            'id_admin' => 3,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => ' Program Pembangunan Saluran Air Baru',
            'isi' => 'Dalam upaya mengatasi masalah banjir, RW 02 bersama Dinas Pekerjaan Umum akan membangun saluran air baru di wilayah RT 03 dan RT 04. 
                    Pekerjaan ini akan dimulai pada 15 Juli 2024 dan diperkirakan selesai dalam satu bulan. 
                    Selama proses pembangunan, warga diharapkan bersabar dan bekerja sama demi kelancaran proyek ini.',
        ]);
        NewsModel::create([
            'id_admin' => 4,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => 'Festival Budaya RW 02 Akan Segera Dimulai',
            'isi' => 'RW 02 akan menyelenggarakan Festival Budaya Acara ini akan menampilkan berbagai pertunjukan seni dan budaya, 
                    seperti tari tradisional, musik, dan pameran kerajinan tangan. Warga diundang untuk berpartisipasi dan menikmati berbagai kegiatan menarik 
                    yang telah disiapkan oleh panitia. Festival ini bertujuan untuk melestarikan budaya lokal dan mempererat hubungan antarwarga',
        ]);
    }
}
