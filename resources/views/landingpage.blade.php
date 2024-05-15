@extends('layouts.landing')
@section('content-landingpage')
  <!-- Beranda -->
  <section id="beranda" class="h-screen bg_beranda flex flex-col justify-between">
    <div class="text-white flex justify-between px-16 py-4">
      <span class="flex justify-center"><img src="{{ asset('assets/icons/logo-white.svg') }}" alt=""></span>
      <ul class="flex gap-3 justify-center h-[4rem] items-center">
        <li><a href="#struktur">KEPENGURUSAN</a></li>
        <li><a href="#agenda">AGENDA</a></li>
        <li><a href="#berita">BERITA</a></li>
        <li><a href="#menu">MENU</a></li>
        <li><a href="#beranda">BERANDA</a></li>
        <li>
          <a href="{{ route('login') }}">
            <span class="flex justify-center items-center bg-white rounded-2xl px-4 py-2 gap-3">
              <div class="text-secondary">Siruwa</div>
              <img class="rounded-full w-11 h-11" src="{{ asset('assets/icons/user.svg') }}">
            </span>
          </a>
        </li>
      </ul>
    </div>

    <div class="text-white">
      <div class="text-center text-8xl font-extrabold">SIRUWA</div>
      <div class="text-center text-4xl font-semibold mb-10">Sistem Informasi RW Dua</div>
      <div class="text-center text-2xl font-medium">Selamat datang di SIRUWA, jelajahi aplikasi web mutakhir untuk
        mengatur segala hal di dunia.</div>
    </div>

    <a href="#menu" class="mb-2 flex flex-col text-center text-white">
      <span>Mulai Jelajah !</span>
      <span>↓</span>
    </a>
  </section>

  <!-- Menu -->
  <section id="menu" class="bg-main flex flex-col justify-center w-full h-96 px-72 p-16 gap-16">
    <span class="text-center text-white text-5xl font-semibold">Menu</span>
    <div class="flex flex-row justify-between item-center">
      <a class="flex flex-col justify-center items-center gap-6">
        <img class="w-20 h-20" src="{{ asset('assets/icons/user-filled.svg') }}" alt="">
        <span class="text-white text-2xl text-center font-bold">Profil</span>
      </a>
      <a class="flex flex-col justify-center items-center gap-6">
        <img class="w-20 h-20" src="{{ asset('assets/icons/document-filled.svg') }}" alt="">
        <span class="text-white text-2xl text-center font-bold">Data Penduduk</span>
      </a>
      <a class="flex flex-col justify-center items-center gap-6">
        <img class="w-20 h-20" src="{{ asset('assets/icons/document-upload-filled.svg') }}" alt="">
        <span class="text-white text-2xl text-center font-bold">Pengajuan Dokumen</span>
      </a>
      <a class="flex flex-col justify-center items-center gap-6">
        <img class="w-20 h-20" src="{{ asset('assets/icons/money-filled.svg') }}" alt="">
        <span class="text-white text-2xl text-center font-bold">Iuran Desa</span>
      </a>
    </div>
  </section>

  <!-- Berita -->
  <section id="berita" class="h-screen p-16 flex flex-col justify-center">
    <div class="flex justify-between items-center w-full mb-6">
      <span class="text-secondary text-5xl font-semibold">Berita</span>

      <button class="px-8 py-3 bg-secondary rounded-2xl flex-col justify-start items-end gap-2.5 inline-flex">
        <div class="justify-start items-center gap-8 inline-flex">
          <span class="text-white text-base font-semibold leading-normal">Lebih Banyak ></span>
        </div>
      </button>
    </div>
    <div class="flex gap-6">
      <div class="w-1/2">
        <a href="">
            <div class="h-[50rem] rounded-2xl flex flex-col justify-end" style="background-image: url('{{ $latestNews[0]->url_gambar }}');">
                <div class="flex flex-col justify-end gap-2.5 bg-gradient-to-t from-black to-transparent rounded-2xl p-4">
                  @if(isset($latestNews[0]))
                    <span class="text-stone-100 text-base font-medium">{{ $latestNews[0]->created_at }}</span>
                    <span class="text-stone-100 text-xl font-bold">{{ $latestNews[0]->judul }}</span>
                  @endif
                </div>
            </div>
        </a>
      </div>

      <div class="flex flex-col w-1/2 gap-6">
        <a href="" 
        class="h-1/2 rounded-2xl flex flex-col justify-end" style="background-image: url('{{ $latestNews[1]->url_gambar }}');">
          <div class="flex flex-col justify-end gap-2.5 bg-gradient-to-t from-black to-transparent rounded-2xl p-4">
            @if(isset($latestNews[1]))
              <span class="text-stone-100 text-base font-medium">{{ $latestNews[1]->created_at }}</span>
              <span class="text-stone-100 text-xl font-bold ">{{ $latestNews[1]->judul }}</span>
            @endif
          </div>
        </a>

        <a href="" 
        class="h-1/2 rounded-2xl flex flex-col justify-end" style="background-image: url('{{ $latestNews[2]->url_gambar }}');">
          <div class="flex flex-col justify-end gap-2.5 bg-gradient-to-t from-black to-transparent rounded-2xl p-4">
            @if(isset($latestNews[1]))
              <span class="text-stone-100 text-base font-medium">{{ $latestNews[2]->created_at }}</span>
              <span class="text-stone-200 text-xl font-bold ">{{ $latestNews[2]->judul }}</span>
            @endif
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- Statistik -->
  <section id="statistik" class="bg-main flex flex-col justify-center w-full h-96 px-44 p-16 gap-16">
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
  <section id="agenda" class="bg-bg_color flex flex-col content-center p-16 w-full gap-6 items-center h-screen justify-center">
    <span class="text-cyan-900 text-5xl font-semibold">Agenda</span>
    <div class="flex gap-10 items-center">
      <div id="calendarContainer" class=""></div>
      <div id="organizerContainer"></div>
    </div>
  </section>

  <!-- Struktur Organisasi -->
  <section id="struktur" class="bg-bg_color flex flex-col justify-center content-center p-16 w-full gap-6">
    <span class="text-cyan-900 text-5xl font-semibold">Struktur Organisasi</span>
    <div class="flex justify-between">

    </div>
  </section>

  <!-- Stick script at the end of the body -->
  <script src="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.js"></script>
  <script>
    var calendar = new Calendar("calendarContainer", "medium",
      ["Monday", 3],
      ["#ffffff", "#225157", "#225157", "#ffffff"], {
        indicator: true,
        indicator_type: 1,
      });

    var data = {
      2024: {
        5: {
          2: [{
            startTime: "00:00",
            endTime: "24:00",
            text: "Mata Kuliah PSI"
          }]
        }
      }
    };

    var organizer = new Organizer("organizerContainer", calendar, data);
  </script>
@endsection
