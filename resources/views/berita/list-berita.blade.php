@extends('layouts.landing')
@section('content-landingpage')

<div x-data="newsSearch()" class="flex flex-col gap-16 px-20">
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('index') }}">
            <x-icon.back />
        </a>
        <h1 class="h1-semibold">Daftar Berita</h1>
    </div>
    <div class="flex flex-row gap-16 justify-between">
        <div class="flex flex-col w-3/5">
            <input 
                type="text" 
                placeholder="Cari Berita" 
                class="placeholder:text-slate-400 focus:outline-none focus:ring-main focus:ring-2 h-12 p-3 bg-white rounded-2xl mb-6"
                x-model="searchQuery"
                @input="searchNews"
            >

            <div id="news-container">
                <template x-for="n in filteredNews" :key="n.id_berita">
                    <a :href="`/berita/news/${n.id_berita}/artikel`">
                        <div class="flex flex-row gap-6 mb-6">
                            <img class="rounded-2xl h-44 w-72 shrink-0" :src="n.url_gambar" />
                            <div class="flex flex-col gap-2">
                                <span class="text-neutral-400 text-xl font-medium" x-text="n.created_at"></span> 
                                <span class="text-secondary text-2xl font-semibold" x-text="n.judul"></span>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </div>

         <!-- Agenda -->
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
</script>

@endsection
