@extends('layouts.landing')
@section('content-landingpage')

<div class="px-16 py-9 flex flex-col gap-16">
    <span class="text-secondary text-4xl font-semibold">{{ $title }}</span>
    <div class="flex flex-row gap-16">
        <!-- Daftar Berita -->
        <div class="flex flex-col">
            <input type="text" placeholder="Cari Berita" class="placeholder:text-slate-400 focus:outline-none focus:ring-main focus:ring-2 h-12 p-3 bg-white rounded-2xl mb-6">

            @foreach ($news as $n)
            <a href="{{route('list-berita.show', ['artikel' => $n->id_berita])}}">
                <div class="flex flex-row gap-6 mb-6">
                    <img class="rounded-2xl h-44 w-72 shrink-0" src="{{ $n->url_gambar }}" />
                    <div class="flex flex-col gap-2">
                        <span class="text-neutral-400 text-xl font-medium leading-9">{{ $n->created_at }}</span>
                        <span class="text-secondary text-2xl font-semibold">{{ $n->judul }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Penyematan Berita -->
        <div class="p-6 bg-secondary rounded-2xl text-white w-96 h-fit">
            <h2 class="text-xl font-semibold mb-4">Agenda</h2>
            @foreach ($latestEvent as $levent)   
            <div class="relative">
                <div class="absolute top-0 left-0 w-10 h-10 flex items-center justify-center bg-white text-secondary rounded-full font-bold z-10">no</div>
                <div class="absolute top-2 left-4 w-1 h-full bg-white"></div>
                <div class="ml-8 p-4 bg-secondary rounded-lg">
                    <img class="rounded-lg mb-2" src="{{ $levent->url_gambar }}">
                    <span class="text-sm font-semibold">{{ $levent->tanggal }}</span>
                    <p>{{ $levent->judul }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
</div>

@endsection