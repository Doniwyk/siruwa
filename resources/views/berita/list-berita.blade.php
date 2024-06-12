@extends('layouts.landing')
@section('content-landingpage')
<head>
<title>Berita</title>
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

<div x-data="newsSearch()" class="flex flex-col gap-12 px-20 sm:px-4 sm:gap-8 sm:overflow-hidden sm:pl-3 py-6">
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('index') }}">
            <x-icon.back />
        </a>
        <h1 class="h1-semibold">Daftar Berita</h1>
    </div>
    <div class="flex flex-row sm:flex-col gap-16 justify-between">
        <div class="flex flex-col w-3/5 sm:w-screen">
            <input 
                type="text" 
                placeholder="Cari Berita" 
                class="placeholder:text-slate-400 sm:w-80 focus:outline-none focus:ring-main focus:ring-2 h-12 p-3 bg-white rounded-2xl mb-6"
                x-model="searchQuery"
                @input="searchNews"
            >

            <div id="news-container">
                <template x-for="n in filteredNews" :key="n.id_berita">
                    <a :href="`/berita/news/${n.id_berita}/artikel`">
                        <div class="flex flex-row sm:flex-col gap-6 mb-6 sm:gap-4 sm:mb-4 sm:w-80">
                            <img class="rounded-2xl h-44 w-72 sm:size-full shrink-0" :src="n.url_gambar" />
                            <div class="flex flex-col gap-2">
                                <span class="text-neutral-400 text-xl sm:text-lg font-medium" x-text="n.created_at"></span> 
                                <span class="text-secondary text-2xl sm:text-xl font-semibold" x-text="n.judul"></span>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </div>

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
</div>

<script>
    function newsSearch() {
        return {
            searchQuery: '',
            allNews: @json($news),
            get filteredNews() {
                if (this.searchQuery === '') {
                    return this.allNews;
                }
                return this.allNews.filter(news => news.judul.toLowerCase().includes(this.searchQuery.toLowerCase()));
            },
            searchNews() {
                // Triggered when the searchQuery input changes
            }
        }
    }

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
