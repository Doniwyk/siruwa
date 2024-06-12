@extends('layouts.landing')
@section('content-landingpage')
<head>
<title>Artikel</title>
    <style>
        /* styles.css */
        @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: scale(0.5);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
        }

        @keyframes slideDown {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
        }

        .circle, .line, .event-item {
        opacity: 0; /* Hide elements initially */
        }

        .circle.animated {
        animation: fadeIn 0.2s ease-in-out forwards;
        }

        .line.animated {
        animation: slideDown 0.2s ease-in-out forwards;
        }

        .event-item.animated {
        animation: fadeIn 0.2s ease-in-out forwards;
        }
    </style>
    
</head>

  <!-- Navbar -->
  <div class="navbar sticky top-0 w-full z-50 text-white px-16 py-4 sm:px-5 sm:py-0 md:flex md:justify-between items-center transition-transform duration-300 transform bg-secondary">
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
    <div class="md:hidden sm:overflow-hidden sm:sticky sm:max-h-0 transition-[max-height] duration-500 ease-in-out flex flex-col items-end gap-3 navigation-menu sm:hidden">
      @auth
      <a href="{{ route('logout') }}" class="text-white hover:text-gray-100">LOGOUT</a>
      @else
      <a href="{{ route('login') }}" class="text-white hover:text-gray-100">LOGIN</a>
      @endauth
            <a href="{{ route('index') }}#struktur" class="text-white hover:text-gray-100 text-right">KEPENGURUSAN</a>
            <a href="{{ route('index') }}#agenda" class="text-white hover:text-gray-100 text-right">AGENDA</a>
            <a href="{{ route('index') }}#berita" class="text-white hover:text-gray-100 text-right">BERITA</a>
            <a href="{{ route('index') }}#menu" class="text-white hover:text-gray-100 text-right">MENU</a>
            <a href="{{ route('index') }}#beranda" class="text-white hover:text-gray-100 text-right">BERANDA</a>
    </div>

    <!-- Desktop Menu -->
    <ul class="sm:hidden md:flex gap-10 justify-center items-center">
        <li><a href="{{ route('index') }}#struktur" class="text-white hover:text-gray-100 text-right">KEPENGURUSAN</a></li>
        <li><a href="{{ route('index') }}#agenda" class="text-white hover:text-gray-100 text-right">AGENDA</a></li>
        <li><a href="{{ route('index') }}#berita" class="text-white hover:text-gray-100 text-right">BERITA</a></li>
        <li><a href="{{ route('index') }}#menu" class="text-white hover:text-gray-100 text-right">MENU</a></li>
        <li><a href="{{ route('index') }}#beranda" class="text-white hover:text-gray-100 text-right">BERANDA</a></li>   
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

<div class="flex px-20 flex-col gap-12 sm:px-4 sm:gap-8 py-6">
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('list-berita.index') }}">
            <x-icon.back />
        </a>
        <span class="text-secondary text-4xl sm:text-2xl font-semibold"> Artikel </span>
    </div>
    <div class="flex flex-row sm:flex-col gap-16 justify-between"> 
    @if ($type === 'news' || $type === 'event')
        <div class="flex flex-row justify-between w-1/2 w- sm:w-[312px]">
            <div class="flex flex-col w-screen">
                <div class="flex flex-col gap-3">
                    <span class="text-secondary text-3xl sm:text-2xl font-bold">{{ $item->judul }}</span>
                    @if($type === 'news')
                        <p class="text-lg sm:text-base font-medium text-slate-500">{{ date('F, j Y', strtotime($item->created_at)) }}</p>
                    @else
                        <p class="text-lg sm:text-base font-medium text-slate-500">{{ date('F, j Y', strtotime($item->tanggal)) }}</p>
                    @endif
                        <p class="text-lg sm:text-base font-medium text-slate-500">Ditulis oleh : {{ $item->nama }}</p>
                </div>
                <div class="flex flex-col gap-6 pt-6">
                    @if(isset($item->url_gambar))
                        <img src="{{ $item->url_gambar }}" class="w-[824x] h-[464] rounded-2xl">
                    @endif
                    <p>{!! $item->isi !!}</p>
                </div>
            </div>
        </div>
    @endif

        <!-- Agenda -->
        <div class="p-6 bg-secondary rounded-2xl text-white w-[420px] h-max sm:w-full">
            <span class="text-3xl font-semibold sm:text=xl">Agenda</span>
            <div class="p-4 sm:p-2"></div>
            @if ($latestEvent->isEmpty())
                <div class="w-1/2 h-full sm:w-full sm:h-full text-main font-semibold">
                    <p class="text-white w-64">Tidak ada agenda terdekat</p>
                </div>
            @else
            @foreach ($latestEvent as $index => $events)
                <a href="{{ route('list-berita.show', ['type' => 'event', 'id' => $events->id_agenda]) }}">
                    <div class="relative event-container" data-index="{{ $loop->iteration }}">
                        <div class="absolute top-3 left-0 w-12 h-12 sm:w-8 sm:h-8 flex items-center justify-center bg-white text-secondary rounded-full font-bold text-xl sm:text-lg z-10 circle">
                            {{ $loop->iteration }}
                        </div>

                        @if (!$loop->last)
                            <div class="absolute top-10 left-[22px] sm:left-[15px] w-1 sm:w-0.5 h-full bg-white line"></div>
                        @endif

                        <div class="ml-14 sm:ml-10 p-4 bg-secondary rounded-lg event-item">
                            <img class="rounded-lg mb-2" src="{{ $events->url_gambar }}">
                            <div class="flex flex-col">
                                <span class="text-lg sm:text-base font-medium text-neutral-300">Tanggal Acara : {{ date('F, j Y', strtotime($events->tanggal)) }}</span>
                                <span class="text-xl sm:text-lg font-semibold">{{ $events->judul }}</span>    
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            @endif
        </div>
</div>

<script>
// script.js
document.addEventListener('DOMContentLoaded', function () {
    const eventContainers = document.querySelectorAll('.event-container');
    
    const animateEvent = (container, delay) => {
        const circle = container.querySelector('.circle');
        const line = container.querySelector('.line');
        const eventItem = container.querySelector('.event-item');
        
        setTimeout(() => {
            if (circle) circle.classList.add('animated');
        }, delay);

        if (line) {
            setTimeout(() => {
                line.classList.add('animated');
            }, delay + 500); // 500ms delay for circle animation to complete
        }

        if (eventItem) {
            setTimeout(() => {
                eventItem.classList.add('animated');
            }, delay + 50); // 1000ms delay for circle + line animation to complete
        }

        return delay + 1000; // Total delay increment for each event: 1500ms (circle + line + buffer)
    };

    let totalDelay = 0;
    eventContainers.forEach((container) => {
        totalDelay = animateEvent(container, totalDelay);
    });
});


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
</script>
@endsection
