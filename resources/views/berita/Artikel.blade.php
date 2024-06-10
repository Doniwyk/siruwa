@extends('layouts.landing')
@section('content-landingpage')

<div class="flex flex-col gap-16">
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('index') }}">
            <x-icon.back />
        </a>
        <span class="text-secondary text-4xl font-semibold"> Artikel </span>
    </div>
    <div class="flex flex-row"> 
        @if ($type === 'news' || $type === 'event')
        <div class="flex flex-row justify-between w-1/2">
            <div class="flex flex-col w-screen">
                <div class="flex flex-col gap-3">
                    <span class="text-secondary text-2xl font-bold">{{ $item->judul }}</span>
                    <p>{{ $item->created_at }}</p>
                    @if($type === 'event')
                        <p>{{ $item->nama }}</p>
                    @endif
                </div>
                <div class="flex flex-col gap-6">
                    @if(isset($item->url_gambar))
                        <img src="{{ $item->url_gambar }}" class="w-[624px] h-[464] object-none">
                    @endif
                    <p>{{ $item->isi }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="p-6 bg-secondary rounded-2xl text-white w-[420px] h-max">
            <span class="text-3xl font-semibold">Agenda</span>
            <div class="p-4"></div>
            @foreach ($event as $index => $events)
                <a href="{{ route('list-berita.show', ['type' => 'event', 'id' => $events->id_agenda]) }}">
                    <div class="relative">
                        <div class="absolute top-3 left-0 w-12 h-12 flex items-center justify-center bg-white text-secondary rounded-full font-bold text-xl z-10">{{ $loop->iteration }}</div>

                        @if (!$loop->last)
                            <div class="absolute top-10 left-[22px] w-1 h-full bg-white"></div>
                        @endif

                        <div class="ml-14 p-4 bg-secondary rounded-lg">
                            <img class="rounded-lg mb-2" src="{{ $events->url_gambar }}">
                            <div class="flex flex-col">
                                <span class="text-lg font-medium text-neutral-300">Tanggal Acara : {{ $events->tanggal }}</span>
                                <span class="text-xl font-semibold">{{ $events->judul }}</span>    
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
