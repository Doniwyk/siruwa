@extends('layouts.landing')
@section('content-landingpage')

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiUwU</title>
    @vite('resources/css/app.css')
</head> -->

<body>
    <!-- Beranda -->
  <section class="bg_beranda flex justify-center content-center pr-72 pl-72 pt-44 w-full flex-col">
    <div class="flex flex-col justify-center items-center gap-16 pb-28">
      <div class="flex flex-col gap-10 justify-center items-center">
        <span class="text-center text-white text-8xl font-extrabold">SIRUWA</span>
        <span class="text-center text-white text-4xl font-semibold">Sistem Informasi RW Dua</span>
      </div>
      <p class="text-center text-white text-2xl font-medium w-2/3">Selamat datang di SIRUWA, jelajahi aplikasi web mutakhir untuk mengatur segala hal di dunia.</p>
    </div>
    <a href="#menu" class="pb-4 flex flex-col text-center">
      <p class="text-white">Mulai Jelajah !</p>
      <p class="text-white">↓</p>
    </a>
  </section>

  <!-- Menu -->
  <section id="menu" class="bg-main flex flex-col justify-center w-full h-96 px-20 p-16 gap-16">
    <span class="text-center text-white text-5xl font-semibold">Menu</span>
    <div class="flex flex-row justify-between item-center">
      <button class="flex flex-col justify-center items-center gap-6">
        <img class="w-20 h-20" src="{{ asset('assets/icons/user-filled.svg') }}" alt="">
        <span class="text-white text-2xl text-center font-bold">Edit Profil</span>
      </button>
      <button class="flex flex-col justify-center items-center gap-6">
        <img class="w-20 h-20" src="{{ asset('assets/icons/document-filled.svg') }}" alt="">
        <span class="text-white text-2xl text-center font-bold">Data Penduduk</span>
      </button>
      <button class="flex flex-col justify-center items-center gap-6">
        <img class="w-20 h-20" src="{{ asset('assets/icons/document-upload-filled.svg') }}" alt="">
        <span class="text-white text-2xl text-center font-bold">Pengajuan Dokumen</span>
      </button>
      <button class="flex flex-col justify-center items-center gap-6">
        <img class="w-20 h-20" src="{{ asset('assets/icons/money-filled.svg') }}" alt="">
        <span class="text-white text-2xl text-center font-bold">Iuran Desa</span>
      </button>
    </div>
  </section>

  <!-- Berita -->
  <section class="bg-bg_color flex-col justify-center content-center p-16 w-full h-screen">
    <div class="flex gap-6 flex-col h-full">
      <div class="justify-between items-center inline-flex w-full">
        <span class="text-cyan-900 text-5xl font-semibold">Berita</span>

        <button class="px-8 py-3 bg-cyan-900 rounded-2xl flex-col justify-start items-end gap-2.5 inline-flex">
          <div class="self-stretch justify-start items-center gap-8 inline-flex">
            <span class="text-white text-base font-semibold leading-normal">Lebih Banyak ></span>
          </div>
        </button>
      </div>

      <div class="flex gap-6 h-full">
        <div class="p-6 rounded-2xl flex-col justify-end items-center gap-2.5 inline-flex bg_berita1">
          <div class="self-stretch p-6 bg-black bg-opacity-50 rounded-2xl flex-col justify-end items-start gap-2.5 flex">
            <span class="text-stone-100 text-base font-medium">March, 14 2024</span>
            <span class="self-stretch text-justify text-stone-100 text-xl font-bold ">Politeknik Negeri Malang terjerat kasus dugaan korupsi pengadaan tanah senilai 40M, 2 direktur diperiksa.</span>
          </div>
        </div>
        
        <div class="flex flex-col gap-6">
          <div class="h-full p-6 rounded-2xl flex-col justify-end items-start gap-2.5 inline-flex bg_berita2">
            <div class="self-stretch p-6 bg-black bg-opacity-50 rounded-2xl flex-col justify-end items-start gap-2.5 flex">
              <div class="justify-start items-center gap-2 inline-flex">
              <span class="text-stone-100 text-base font-medium">March, 15 2024</span>
              </div>
            <span class="self-stretch text-justify text-stone-100 text-xl font-bold ">Sejumlah mahasiswa Politeknik Negeri Malang mengunjungi Desa Seumberejo untuk mewujudkan digitalisasi Indonesia.</span>
          </div>
        </div>

        <div class="h-full p-6 rounded-2xl flex-col justify-end items-start gap-2.5 inline-flex bg_berita2">
          <div class="self-stretch p-6 bg-black bg-opacity-50 rounded-2xl flex-col justify-end items-start gap-2.5 flex">
            <div class="justify-start items-center gap-2 inline-flex">
              <span class="text-stone-100 text-base font-medium">March, 15 2024</span>
            </div>
            <span class="self-stretch text-justify text-stone-100 text-xl font-bold">Sejumlah mahasiswa Politeknik Negeri Malang mengunjungi Desa Seumberejo untuk mewujudkan digitalisasi Indonesia.</span>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Statistik -->
  <section class="bg-main flex flex-col justify-center w-full h-96 px-20 p-16 gap-16">
    <span class="text-center text-white text-5xl font-semibold">Sumberejo dalam Angka</span>
    <div class="flex flex-row justify-between item-center">
        <div class="flex flex-col justify-center items-center gap-6">
          <span class="text-white text-4xl text-center font-bold">205+</span>
          <span class="text-white text-2xl text-center font-bold">Populasi Penduduk</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
        <span class="text-white text-4xl text-center font-bold ">0</span>
          <span class="text-white text-2xl text-center font-bold">Fasilitas Pendidikan</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
          <span class="text-white text-4xl text-center font-bold">1</span>
          <span class="text-white text-2xl text-center font-bold">Fasilitas Kesehatan</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
          <span class="text-white text-4xl text-center font-bold">900</span>
          <span class="text-white text-2xl text-center font-bold">Fasilitas Administrasi</span>
        </div>
    </div>
  </section>

  <!-- Kalender -->
  <section class="bg-bg_color flex flex-col justify-center content-center p-16 w-full gap-6">
  <span class="text-cyan-900 text-5xl font-semibold">Agenda</span>
  <div class="flex justify-between">
    <div id="calendarContainer" class=""></div>
    <div id="organizerContainer"></div>
  </div>
  </section>

  <!-- Struktur Organisasi -->
  <section class="bg-bg_color flex flex-col justify-center content-center p-16 w-full gap-6">
  <span class="text-cyan-900 text-5xl font-semibold">Struktur Organisasi</span>
  <div class="flex justify-between">
    
  </div>
  </section>
</body>

<!-- Stick script at the end of the body -->
<script src="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.js"></script>
    <script>
        var calendar = new Calendar("calendarContainer", "medium",
                            [ "Monday", 3 ],
                            [ "#ffffff", "#225157", "#225157", "#ffffff" ],
                            {
                                indicator: true,
                                indicator_type: 1,
                            });

        var data = {
                    2024: {
                        5: {
                            2: [
                                {
                                    startTime: "00:00",
                                    endTime: "24:00",
                                    text: "Mata Kuliah PSI"
                                }
                            ]
                        }
                    }
                };

        var organizer = new Organizer("organizerContainer", calendar, data);
    </script>
@endsection
