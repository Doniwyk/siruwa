@extends('layouts.landing')
@section('content-landingpage')

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/output.css') }}">
  <title>ASU</title>


  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>

  <script>
    // kalendar
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth, listYear'
        },
        initialView: 'dayGridMonth',
        events: '/fetch-events' // Mengambil event dari endpoint ini
      });

      eventDisplay: '#225157'
      eventColor: '#225157'
      calendar.render();
    });
  </script>

  <style>
    /* CSS untuk membuat header bulan rounded */
    .fc-scrollgrid,
    .fc-scrollgrid-liquid {
      border-radius: 15px;
      background-color: white;
    }

    thead th {
      border-radius: 16px 16px 0 0;
      background-color: rgb(34 81 87 / var(--tw-bg-opacity));
      font-size: 1rem;
      line-height: 1.25rem;
      font-weight: 600;
      color: rgb(255 255 255 / var(--tw-text-opacity));
      padding: 2px 2px 2px;
    }

    fc-col-header-cell-cushion {
      background-color: white;
    }
  </style>
</head>

<!-- Beranda -->
<section id="beranda" class="relative h-screen flex flex-col justify-between overflow-hidden">
  <!-- Navbar -->
  <div class="navbar fixed top-0 w-full z-50 text-white px-16 py-4 sm:px-5 sm:py-0 md:flex md:justify-between items-center transition-transform duration-300 transform bg-transparent">
    <div class="flex justify-between sm:py-2">
      <span class="flex justify-center w-7">
        <img src="{{ asset('assets/icons/logo-white.svg') }}" alt="">
      </span>
      <!-- MENU ICON -->
      <div class="md:hidden flex items-center">
        <button type="button" class="mobile-menu-button flex items-center">
          <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(-1);">
            <g id="SVGRepo_bgCarrier" stroke-width="0" />
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
            <g id="SVGRepo_iconCarrier">
              <path d="M4 18H10" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
              <path d="M4 12L16 12" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
              <path d="M4 6L20 6" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
            </g>
          </svg>
        </button>
      </div>
    </div>
    <!-- Mobile Menu -->
    <div class="md:hidden sm:overflow-hidden sm:max-h-0 transition-[max-height] duration-500 ease-in-out flex flex-col items-end gap-3 navigation-menu sm:hidden">
      @auth
      <a href="{{ route('logout') }}" class="text-white hover:text-gray-100">LOGOUT</a>
      @else
      <a href="{{ route('login') }}" class="text-white hover:text-gray-100">LOGIN</a>
      @endauth
      <a href="#struktur" class="text-white hover:text-gray-100">KEPENGURUSAN</a>
      <a href="#agenda" class="text-white hover:text-gray-100">AGENDA</a>
      <a href="#berita" class="text-white hover:text-gray-100">BERITA</a>
      <a href="#menu" class="text-white hover:text-gray-100">MENU</a>
      <a href="#beranda" class="text-white hover:text-gray-100 sm:pb-2">BERANDA</a>
    </div>
    <!-- Desktop Menu -->
    <ul class="sm:hidden md:flex gap-10 justify-center items-center">
      <li><a href="#struktur">KEPENGURUSAN</a></li>
      <li><a href="#agenda">AGENDA</a></li>
      <li><a href="#berita">BERITA</a></li>
      <li><a href="#menu">MENU</a></li>
      <li><a href="#beranda">BERANDA</a></li>
      <li>
        <a href="@auth {{ route('logout') }} @else {{ route('login') }} @endauth">
          <span class="flex justify-center items-center bg-white rounded-2xl px-4 py-2 gap-3">
            <div class="text-secondary">@auth Logout @else Login @endauth</div>
            @auth
            @php
            $userId = Auth::id();
            $account = App\Models\AccountModel::findOrFail($userId);
            $urlProfile = $account->urlProfile;
            @endphp
            <img class="rounded-full w-9 h-9" src="{{ $urlProfile }}" alt="Profile Image">
            @else
            <img class="rounded-full w-9 h-9" src="{{ asset('assets/icons/user.svg') }}" alt="User Icon">
            @endauth
          </span>
        </a>
      </li>

    </ul>

  </div>

  <!-- Picture Div -->
  <div x-data="slideshow()" x-init="init()" class="absolute inset-0 z-0">
    <template x-for="(image, index) in images" :key="index">
      <div x-show="currentIndex === index" class="absolute inset-0 bg-center bg-cover transition-opacity duration-500" :style="'background-image: url(' + image + ');'" x-transition:enter="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="opacity-100" x-transition:leave-end="opacity-0">
      </div>
    </template>
    <div class="absolute inset-0 bg-main opacity-80"></div>
    <div class="relative z-10 flex flex-col justify-center items-center text-white text-center h-full px-4">
      <div class="text-8xl sm:text-5xl font-extrabold">SIRUWA</div>
      <div class="text-4xl sm:text-2xl font-semibold mb-10">Sistem Informasi RW 02</div>
      <div class="text-2xl sm:text-xl font-medium">Selamat datang di SIRUWA, jelajahi aplikasi web mutakhir untuk mengatur segala hal di dunia.</div>
      @auth
      <a href="#menu" class="absolute bottom-0 z-10 flex flex-col text-center text-white mb-4">
        @else
        <a href="#berita" class="absolute bottom-0 z-10 flex flex-col text-center text-white mb-4">
          @endauth
          <span>Mulai Jelajah !</span>
          <span>↓</span>
        </a>
    </div>
  </div>
</section>


@auth
@if (auth()->user()->role === 'resident')
<!-- Menu -->
<section id="menu" class="bg-secondary flex flex-col justify-center w-full h-auto md:p-16 sm:p-4 md:gap-16 sm:gap-4">
  <span class="text-center text-white text-5xl sm:text-3xl font-semibold">Menu</span>
  <div class="grid grid-rows-2 grid-cols-2 md:grid-rows-1 md:grid-cols-4 sm:gap-y-4">
    <a href="{{ route('resident.profil.index') }}" class="menu">
      <img class="h-12 sm:w-16 " src="{{ asset('assets/icons/user-filled.svg') }}" alt="">
      <span class="">Profil</span>
    </a>
    <a href="{{ route('resident.data-dasawisma.index') }}" class="menu">
      <img class="h-12" src="{{ asset('assets/icons/document-filled.svg') }}" alt="">
      <span>Data Penduduk</span>
    </a>
    <a href="{{ route('resident.data-dokumen.index') }}" class="menu">
      <img class="h-12" src="{{ asset('assets/icons/document-upload-filled.svg') }}" alt="">
      <span>Pengajuan Dokumen</span>
    </a>
    <a href="{{ route('resident.data-pembayaran.index') }}" class="menu">
      <img class="h-12" src="{{ asset('assets/icons/money-filled.svg') }}" alt="">
      <span>Iuran</span>
    </a>
  </div>
</section>
@endif
@endauth

<!-- Berita -->
<section id="berita" class="h-screen p-16 sm:px-4 sm:py-8 flex flex-col justify-center">
  <div class="flex justify-between items-center w-full mb-6">
    <span class="text-secondary text-5xl sm:text-3xl font-semibold">Berita</span>

    <button class="px-8 py-3 bg-secondary rounded-2xl flex-col justify-start items-end gap-2.5 inline-flex">
      <div class="justify-start items-center gap-8 inline-flex">
        <span class="text-white text-base font-semibold cursor-pointer" onclick="window.location='{{ route('list-berita.index') }}'">Lebih Banyak ></span>
      </div>
    </button>
  </div>
  <div class="flex gap-6 sm:hidden">
    <div class="w-1/2">
      <a href="{{route('list-berita.show', ['artikel' => $latestNews[0]->id_berita])}}">
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
      @for ($i = 1; $i <= 2; $i++) @if(isset($latestNews[$i])) <a href="{{route('list-berita.show', ['artikel' => $latestNews[$i]->id_berita])}}" class="h-1/2 news-container-landing" style="background-image: url('{{ $latestNews[$i]->url_gambar }}');">
        <div class="news-landing">
          <span class="text-stone-100 text-base font-medium">{{ $latestNews[$i]->created_at }}</span>
          <span class="text-stone-100 text-xl font-bold">{{ $latestNews[$i]->judul }}</span>
        </div>
        </a>
        @endif
        @endfor
    </div>
  </div>

  <div class="flex flex-col flex-1 gap-4 md:hidden">
    @for ($i = 0; $i <= 2; $i++) @if(isset($latestNews[$i])) <a href="{{route('list-berita.show', ['artikel' => $latestNews[$i]->id_berita])}}" class="h-1/2 news-container-landing" style="background-image: url('{{ $latestNews[$i]->url_gambar }}');">
      <div class="news-landing">
        <span class="text-stone-100 text-base font-medium">{{ $latestNews[$i]->created_at }}</span>
        <span class="text-stone-100 text-xl font-bold">{{ $latestNews[$i]->judul }}</span>
      </div>
      </a>
      @endif
      @endfor
  </div>
</section>

<!-- Statistik -->
<section id="statistik" class="bg-secondary flex flex-col justify-center w-full h-auto md:p-16 sm:p-4 md:gap-16 sm:gap-4">
  <span class="text-center text-white text-5xl sm:text-3xl font-semibold">RW 2 dalam Angka</span>
  <div class="grid grid-rows-2 grid-cols-2 md:grid-rows-1 md:grid-cols-4 sm:gap-y-6">
    <div class="menu">
      <span class="text-4xl sm:text-2xl">{{$dataDashboard['resident']}}</span>
      <span class="sm:hidden">Populasi Penduduk</span>
      <span class="md:hidden">Populasi</span>
    </div>
    <div class="menu">
      <span class="text-4xl sm:text-2xl">{{$dataDashboard['data'][0]->fasilitas_pendidikan}}</span>
      <span class="sm:hidden">Fasilitas Pendidikan</span>
      <span class="md:hidden">Pendidikan</span>
    </div>
    <div class="menu">
      <span class="text-4xl sm:text-2xl">{{$dataDashboard['data'][0]->fasilitas_kesehatan}}</span>
      <span class="sm:hidden">Kesehatan</span>
      <span class="md:hidden">Kesehatan</span>
    </div>
    <div class="menu">
      <span class="text-4xl sm:text-2xl">{{$dataDashboard['data'][0]->fasilitas_administrasi}}</span>
      <span class="sm:hidden">Administrasi</span>
      <span class="md:hidden">Administrasi</span>
    </div>
  </div>
  </div>
</section>

<!-- Kalender -->
<section id="agenda" class="bg-bg_color flex flex-col content-center p-16 w-full gap-6 items-center h-screen">
  <span class="text-main text-5xl font-semibold">Agenda</span>
  <div class="w-3/5 text-main font-semibold" id='calendar'></div>
</section>

<!-- Struktur Organisasi -->
<section id="struktur" class="h-screen sm:h-auto bg-bg_color flex flex-col justify-center content-center p-16 sm:px-4 sm:py-8 w-full gap-6 sm:gap-4">
  <span class="text-cyan-900 text-5xl sm:text-3xl font-semibold">Struktur Organisasi</span>
  <div class="flex flex-center">
    <img class="rounded-2xl" src="{{ $dataDashboard['data'][0]->image }}" alt="Image">
  </div>
</section>

<script>
  // Gambar Slideshow ofc dari GPT h3h3
  function slideshow() {
    return {
      images: [
        "{{ asset('https://cdn.api.upstation.media/upstation_x/ac915e5166ffa9c578d1e40313c2b116be4753502b5331bb55050f58a68d85c74c1b97b50b32fd8d4ceb844f388faad447fff9957b5bd19f402995558a38958c') }}",
        "{{ asset('https://api.duniagames.co.id/api/content/upload/file/6182724481603360805.jpeg') }}",
        "{{ asset('https://upload-os-bbs.hoyolab.com/upload/2022/08/11/17136071/989ca1a56ed158e8e6f8386984f9c31c_1397685953817154726.jpeg?x-oss-process=image%2Fresize%2Cs_1000%2Fauto-orient%2C0%2Finterlace%2C1%2Fformat%2Cwebp%2Fquality%2Cq_80') }}",
      ],
      currentIndex: 0,
      init() {
        setInterval(() => {
          this.currentIndex = (this.currentIndex + 1) % this.images.length;
        }, 3000);
      }
    }
  }

  var navbar = document.querySelector('.navbar');
  var lastScrollTop = 0;

  function handleScroll() {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > document.getElementById('beranda').offsetHeight) {
      navbar.classList.add('bg-secondary');
      navbar.classList.remove('bg-transparent');
    } else {
      navbar.classList.remove('bg-secondary');
      navbar.classList.add('bg-transparent');
    }

    if (scrollTop > lastScrollTop) {
      navbar.classList.add('-translate-y-full');
    } else {
      navbar.classList.remove('-translate-y-full');
    }

    lastScrollTop = scrollTop;
  }

  window.addEventListener('load', handleScroll);

  window.addEventListener('scroll', handleScroll);

  const mobileMenuButton = document.querySelector('.mobile-menu-button');
  const mobileMenu = document.querySelector('.navigation-menu');

  mobileMenuButton.addEventListener('click', () => {
    if (mobileMenu.classList.contains('sm:hidden')) {
      mobileMenu.classList.remove('sm:hidden');
      mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
    } else {
      mobileMenu.style.maxHeight = '0';
      mobileMenu.addEventListener('transitionend', () => {
        mobileMenu.classList.add('sm:hidden');
      }, {
        once: true
      });
    }
  });
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();

      const targetId = this.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);

      // Smooth scroll to the target section
      targetElement.scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
</script>


@endsection