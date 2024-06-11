@extends('layouts.user')
@section('content-user')
<head>
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

<div x-data="newsSearch()" class="flex flex-col gap-16 px-20 sm:px-4 sm:gap-8 sm:overflow-hidden sm:pl-3">
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
            @foreach ($event as $index => $events)
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
</script>

@endsection
