@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <div class="summary-card_news">
        <div class="summary-card card-top flex flex-col border-y border-r border-l-8 border-main">
            <h4 class="text-xl text-main font-semibold mb-2">Acara terdekat</h4>
            @if (!$lastestEvent->isEmpty())
                @foreach ($lastestEvent as $ln)
                    <x-highlight-card :newsData=$ln />
                @endforeach
            @else
                <span class="text-center font-semibold text-lg text-main">NOT FOUND</span>
            @endif
        </div>
        <div class="summary-card card-top flex flex-col border-y border-r border-l-8 border-main">
            <h4 class="text-xl text-main font-semibold mb-2">Berita terbaru</h4>
            @if (!$lastestNews->isEmpty())
                @foreach ($lastestNews as $ln)
                    <x-highlight-card :newsData=$ln />
                @endforeach
            @else
                <span class="text-center font-semibold text-lg text-main">NOT FOUND</span>
            @endif
        </div>
    </div>

    <section class="flex-between gap-16 max-w-full">
        <div class="link-option_parrent">
            <a href="{{ route('admin.manajemen-berita.index', ['typeDocument' => 'berita']) }}"
                @class([
                    'link-option',
                    'link-option_active' => $typeDocument == 'berita',
                ])>Berita</a>
            <a href="{{ route('admin.manajemen-berita.index', ['typeDocument' => 'acara']) }}"
                @class([
                    'link-option',
                    'link-option_active' => $typeDocument == 'acara',
                ])>Acara</a>
        </div>
        @switch($typeDocument)
            @case('berita')
                <x-add-news-button route="{{ route('admin.manajemen-berita.add', ['typeDocument' => 'berita']) }}" />
            @break

            @case('acara')
                <x-add-news-button route="{{ route('admin.manajemen-acara.add', ['typeDocument' => 'acara']) }}" />
            @break

            @default
        @endswitch
    </section>
    <x-filter :typeDocument=$typeDocument :search="$search" :order="$order" />
    @switch($typeDocument)
        @case('berita')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Judul Berita</th>
                        <th class="sm:hidden lg:table-cell">Detail Berita</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-base font-medium">
                    @if ($news->isEmpty())
                        <tr>
                            <td class="text-center sm:col-span-2 lg:col-span-3">No data found</td>
                        </tr>
                    @else
                        @foreach ($news as $n)
                            <tr>
                                <td>
                                    <div class="flex gap-5 text-main sm:items-center lg:items-start">
                                        <img src="{{ $n->url_gambar }}" alt="logo" class="w-[8.2rem] h-20 rounded-2xl  object-contain">
                                        <p class="desc-news">
                                            {{ $n->judul }}
                                        </p>
                                    </div>
                                </td>
                                <td class="sm:hidden lg:table-cell">
                                    <div class="details">
                                        <x-icon.uploaded />
                                        <label for="">{{ date('F, j Y', strtotime($n->created_at)) }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="action flex gap-6">
                                        <a href="{{route('admin.manajemen-berita.edit', ['news'=>$n->id_berita])}}" class="hover">
                                            <x-icon.edit />
                                        </a>
                                        <form action="{{ route('admin.manajemen-berita.delete', ['news' => $n->id_berita]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <x-icon.delete />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div id="pagination">
                {{ $news->links() }}
            </div>
        @break

        @case('acara')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Judul Acara</th>
                        <th class="sm:hidden lg:table-cell">Detail Acara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-base font-medium">
                    @if ($news->isEmpty())
                    <tr>
                        <td class="text-center">No data found</td>
                    </tr>
                @else
                    @foreach ($news as $n)
                        <tr>
                            <td>
                                <div class="flex gap-5 text-main">
                                    <img src="{{ $n->url_gambar }}" alt="logo" class="w-[8.2rem] h-20 rounded-2xl object-contain">
                                    <p class="desc-news">
                                        {{ $n->judul }}
                                    </p>
                                </div>
                            </td>
                            <td class="sm:hidden lg:table-cell">
                                <div class="details">
                                    <x-icon.uploaded />
                                    <label for="">{{ date('F, j Y', strtotime($n->created_at)) }}</label>
                                </div>
                            </td>
                            <td>
                                <div class="action flex gap-6">
                                    <a href="{{route('admin.manajemen-acara.edit', ['event'=>$n->id_agenda])}}" class="hover">
                                        <x-icon.edit />
                                    </a>
                                    <form action="{{ route('admin.manajemen-acara.delete', ['event' => $n->id_agenda]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <x-icon.delete />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        @break

        @default
    @endswitch
@endsection
