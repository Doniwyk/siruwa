<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiUwU</title>
    @vite('resources/css/app.css')
</head>

<body>
  <div class="bg-green-600 z-10 fixed bg-nav w-full px-20 py-4 items-center gap-6 inline-flex justify-end">
    <span class="text-center text-stone-50 text-3xl font-extrabold font-['Baloo 2']">>///<</span>
    <div class="w-screen h-14 text-center gap-8 flex justify-end items-center">
      <span class="text-white text-sm font-medium font-['Anek Tamil']">KEPENGURUSAN</span>
      <span class="text-white text-sm font-medium font-['Anek Tamil']">AGENDA</span>
      <span class="text-white text-sm font-medium font-['Anek Tamil']">BERITA</span>
      <span class="text-white text-sm font-medium font-['Anek Tamil']">MENU</span>
      <span class="text-white text-sm font-medium font-['Anek Tamil']">BERANDA</span>
    </div>

                <!-- MyUwU login -->
    <div class="bg-white rounded-2xl justify-center items-center gap-8 flex-auto">
      <div class="justify-center items-center gap-4 inline-flex py-2 px-8">
        <span class="text-center text-teal-900 text-sm font-medium font-['Anek Tamil']">MyUwU</span>
        <img class="w-11 h-11 rounded-full" src="https://via.placeholder.com/44x44" />
      </div>
    </div>
  </div>

    <!-- Beranda -->
  <section class="bg_beranda flex justify-center content-center p-72 w-full h-screen">
    <div class="flex flex-col justify-start items-center gap-16 w-3/4">
      <div class="flex flex-col gap-10">
        <span class="text-center text-bg-nav text-8xl font-extrabold font-['Anek Tamil'] leading-10">SIUwU</span>
        <span class="text-center text-bg-nav text-4xl font-semibold font-['Anek Tamil'] leading-10">Sistem Informasi Kawaiiiii</span>
      </div>
      <p class="text-center text-bg0nav text-2xl font-medium font-['Anek Tamil'] leading-9">Selamat datang di SIUwU, jelajahi aplikasi web mutakhir untuk mengatur segala hal di dunia.</p>
    </div>
  </section>

  <!-- Menu -->
  <section class="bg-main flex flex-col justify-center w-full h-96 px-20 p-16 gap-16">
    <span class="text-center text-white text-5xl font-semibold font-['Anek Tamil']">Menu</span>
    <div class="flex flex-row justify-between item-center">
        <div class="flex flex-col justify-center items-center gap-6">
          <img class="w-28 h-28" src="{{ asset('assets/icons/user-filled.svg') }}" alt="">
          <span class="text-white text-2xl text-center font-bold font-['Anek Tamil']">Edit Profil</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
          <img class="w-28 h-28" src="{{ asset('assets/icons/document-filled.svg') }}" alt="">
          <span class="text-white text-2xl text-center font-bold font-['Anek Tamil']">Data Penduduk</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
          <img class="w-28 h-28" src="{{ asset('assets/icons/document-upload-filled.svg') }}" alt="">
          <span class="text-white text-2xl text-center font-bold font-['Anek Tamil']">Pengajuan Dokumen</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
          <img class="w-28 h-28" src="{{ asset('assets/icons/money-filled.svg') }}" alt="">
          <span class="text-white text-2xl text-center font-bold font-['Anek Tamil']">Iuran Desa</span>
        </div>
    </div>
  </section>

  <!-- Berita -->
  <section class="bg-bg_color flex justify-center content-center p-72 w-full h-screen">
    <div class="w-96 h-16 justify-between items-center inline-flex">
      <span class="text-cyan-900 text-5xl font-semibold font-['Anek Tamil']">Berita</span>
      <button class="px-8 py-3 bg-cyan-900 rounded-2xl flex-col justify-start items-end gap-2.5 inline-flex">
        <div class="self-stretch justify-start items-center gap-8 inline-flex">
          <div class="text-white text-base font-semibold font-['Anek Tamil'] leading-normal">Lebih Banyak</div>
          <div class="w-6 h-6 justify-center items-center flex"> </div>
        </div>
      </button>
    </div>
  </section>

  <!-- Statistik -->
  <section class="bg-main flex flex-col justify-center w-full h-96 px-20 p-16 gap-16">
    <span class="text-center text-white text-5xl font-semibold font-['Anek Tamil']">Sumberejo dalam Angka</span>
    <div class="flex flex-row justify-between item-center">
        <div class="flex flex-col justify-center items-center gap-6">
          <span class="text-white text-4xl text-center font-bold font-['Anek Tamil']">205+</span>
          <span class="text-white text-2xl text-center font-bold font-['Anek Tamil']">Populasi Penduduk</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
        <span class="text-white text-4xl text-center font-bold font-['Anek Tamil']">0</span>
          <span class="text-white text-2xl text-center font-bold font-['Anek Tamil']">Fasilitas Pendidikan</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
          <span class="text-white text-4xl text-center font-bold font-['Anek Tamil']">1</span>
          <span class="text-white text-2xl text-center font-bold font-['Anek Tamil']">Fasilitas Kesehatan</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-6">
          <span class="text-white text-4xl text-center font-bold font-['Anek Tamil']">900</span>
          <span class="text-white text-2xl text-center font-bold font-['Anek Tamil']">Fasilitas Administrasi</span>
        </div>
    </div>
  </section>
</body>

</html>
