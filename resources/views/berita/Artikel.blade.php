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

<div class="flex px-20 flex-col gap-12 sm:px-4 sm:gap-8">
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
</script>
@endsection
