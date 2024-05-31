@extends('layouts.landing')
@section('content-landingpage')
  <!-- Beranda -->
  <section id="beranda" class="h-screen bg_beranda flex flex-col justify-between">
    <div class="text-white flex justify-between px-16 py-4 ">
      <span class="flex justify-center"><img src="{{ asset('assets/icons/logo-white.svg') }}" alt=""></span>
      <ul class="flex gap-10 justify-center h-[3.5rem] items-center">
        <li><a href="#struktur">KEPENGURUSAN</a></li>
        <li><a href="#agenda">AGENDA</a></li>
        <li><a href="#berita">BERITA</a></li>
        <li><a href="#menu">MENU</a></li>
        <li><a href="#beranda">BERANDA</a></li>
        @auth
        <li>
            <a href="{{ route('logout') }}">
                <span class="flex justify-center items-center bg-white rounded-2xl px-4 py-2 gap-3">
                    <div class="text-secondary">Logout</div>
                    <img class="rounded-full w-9 h-9" src="{{ asset('assets/icons/user.svg') }}">
                </span>
            </a>
        </li>
        @else
        <li>
            <a href="{{ route('login') }}">
                <span class="flex justify-center items-center bg-white rounded-2xl px-4 py-2 gap-3">
                    <div class="text-secondary">Login</div>
                    <img class="rounded-full w-9 h-9" src="{{ asset('assets/icons/user.svg') }}">
                </span>
            </a>
        </li>
        @endauth
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

  @auth
  <!-- Menu -->
  <section id="menu" class="bg-secondary flex flex-col justify-center w-full h-96 px-72 p-16 gap-16">
    <span class="text-center text-white text-5xl font-semibold">Menu</span>

    <div class="flex flex-row justify-between item-center">
      <a href="{{ route('resident.profil.index') }}" class="menu">
        <img class="w-20 h-20" src="{{ asset('assets/icons/user-filled.svg') }}" alt="">
        <span class="">Profil</span>
      </a>
      <a href="{{ route('resident.data-dasawisma.index') }}" class="menu">
        <img class="w-20 h-20" src="{{ asset('assets/icons/document-filled.svg') }}" alt="">
        <span>Data Penduduk</span>
      </a>
      <a href="{{ route('resident.data-dokumen.index') }}" class="menu">
        <img class="w-20 h-20" src="{{ asset('assets/icons/document-upload-filled.svg') }}" alt="">
        <span>Pengajuan Dokumen</span>
      </a>
      <a href="{{ route('resident.data-pembayaran.index') }}" class="menu">
        <img class="w-20 h-20" src="{{ asset('assets/icons/money-filled.svg') }}" alt="">
        <span>Iuran Desa</span>
      </a>
    </div>
  </section>
  @endauth

  <!-- Berita -->
  <section id="berita" class="h-screen p-16 flex flex-col justify-center">
    <div class="flex justify-between items-center w-full mb-6">
      <span class="text-secondary text-5xl font-semibold">Berita</span>

      <button class="px-8 py-3 bg-secondary rounded-2xl flex-col justify-start items-end gap-2.5 inline-flex">
        <div class="justify-start items-center gap-8 inline-flex">
          <span class="text-white text-base font-semibold cursor-pointer" onclick="window.location='{{ route('list-berita.index') }}'">Lebih Banyak ></span>
        </div>
      </button>
    </div>
    <div class="flex gap-6">
      <div class="w-1/2">
        <a href="">
            <div class="h-[50rem] news-container-landing" style="background-image: url('{{ $latestNews[0]->url_gambar }}');">
                <div class="news-landing">
                  @if(isset($latestNews[0]))
                    <span class="text-stone-100 text-base font-medium">{{ $latestNews[0]->created_at }}</span>
                    <span class="text-stone-100 text-xl font-bold">{{ $latestNews[0]->judul }}</span>
                  @endif
                </div>
            </div>
        </a>
      </div>

      <div class="flex flex-col w-1/2 gap-6">
        @for ($i = 1; $i <= 2; $i++)
          @if(isset($latestNews[$i]))
            <a href="" class="h-1/2 news-container-landing" style="background-image: url('{{ $latestNews[$i]->url_gambar }}');">
              <div class="news-landing">
                <span class="text-stone-100 text-base font-medium">{{ $latestNews[$i]->created_at }}</span>
                <span class="text-stone-100 text-xl font-bold">{{ $latestNews[$i]->judul }}</span>
              </div>
            </a>
          @endif
        @endfor
      </div>
      
    </div>
  </section>

  <!-- Statistik -->
  <section id="statistik" class="bg-secondary flex flex-col justify-center w-full h-96 px-44 p-16 gap-16">
    <span class="text-center text-white text-5xl font-semibold">RW 2 dalam Angka</span>
    <div class="flex flex-row justify-between item-center">
      <div class="menu">
        <span class="text-4xl">205+</span>
        <span>Populasi Penduduk</span>
      </div>
      <div class="menu">
        <span class="text-4xl">0</span>
        <span>Fasilitas Pendidikan</span>
      </div>
      <div class="menu">
        <span class="text-4xl">1</span>
        <span>Fasilitas Kesehatan</span>
      </div>
      <div class="menu">
        <span class="text-4xl">900</span>
        <span>Fasilitas Administrasi</span>
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
