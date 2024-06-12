<?php

namespace Database\Seeders;

use App\Models\EventModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        EventModel::create([
            'id_admin' => 5,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => 'Seminar Kesehatan: Pentingnya Gizi Seimbang',
            'isi' => 'Kami mengundang seluruh warga RW 2 untuk menghadiri seminar kesehatan dengan tema 
                    "Pentingnya Gizi Seimbang untuk Kesehatan Keluarga." Acara ini akan diadakan pada Sabtu, 15 Juni 2024, pukul 09.00 WIB di Balai RW 2. 
                    Seminar akan dibawakan oleh ahli gizi dari Puskesmas setempat. Jangan lewatkan kesempatan ini untuk mendapatkan 
                    informasi penting tentang pola makan sehat. Untuk informasi lebih lanjut, hubungi Sekretariat RW 2.',
            'tanggal' => '2024-06-15',
        ]);
        EventModel::create([
            'id_admin' => 3,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => 'Aksi Donor Darah di RW 2',
            'isi' => 'RW 2 bekerja sama dengan PMI akan mengadakan aksi donor darah pada Minggu, 23 Juni 2024, pukul 08.00 - 12.00 WIB di Balai RW 2.
                    Donor darah ini bertujuan untuk membantu ketersediaan darah di PMI dan membantu sesama yang membutuhkan. Bagi warga yang ingin mendonorkan darahnya, 
                    diharapkan membawa KTP dan sudah sarapan ringan sebelum datang. Mari berpartisipasi dalam kegiatan sosial ini!',
            'tanggal' => '2024-06-23',
        ]);
        EventModel::create([
            'id_admin' => 2,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => 'Jalan Sehat Keluarga RW 2',
            'isi' => 'Ayo ikut serta dalam acara Jalan Sehat Keluarga RW 2 yang akan diadakan pada Minggu, 4 Agustus 2024, 
                    pukul 06.00 WIB. Start dan finish di Lapangan RW 2. Acara ini bertujuan untuk meningkatkan kebugaran dan 
                    mempererat hubungan antarwarga. Setiap peserta akan mendapatkan kaos dan doorprize menarik. 
                    Pendaftaran dibuka hingga 1 Agustus 2024 di Sekretariat RW 2. Ajak seluruh keluarga untuk berpartisipasi dan 
                    nikmati pagi yang sehat dan menyenangkan!',
            'tanggal' => '2024-08-04',
        ]);
        EventModel::create([
            'id_admin' => 4,
            'url_gambar' => 'https://via.placeholder.com/640x480.png/00dd77?text=consequatur',
            'image_public_id' => 1,
            'judul' => 'Lomba 17 Agustusan RW 2',
            'isi' => 'Dalam rangka memperingati Hari Kemerdekaan Republik Indonesia yang ke-79, RW 2 akan mengadakan berbagai lomba tradisional pada tanggal 17 Agustus 2024 
            mulai pukul 08.00 WIB di Lapangan RW 2. Lomba yang akan diadakan antara lain balap karung, panjat pinang, dan lomba makan kerupuk. Ajak keluarga dan 
            teman-teman untuk ikut serta dan memeriahkan acara ini. Pendaftaran lomba dibuka hingga 10 Agustus 2024 di Sekretariat RW 2.',
            'tanggal' => '2024-08-17',
        ]);

    }
}
