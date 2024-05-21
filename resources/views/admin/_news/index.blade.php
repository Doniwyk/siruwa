@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <div class="summary-card_news">
        <div class="summary-card card-total">
            <div class="border-r flex-1">
                <label for="">{{$news->total()}}</label>
                <label for="">Berita Diunggah</label>
            </div>
            <div class="border-l flex-1">
                <label for="">2</label>
                <label for="">Berita Disematkan</label>
            </div>
        </div>
        <div class="summary-card card-top flex flex-col gap-5">
            <h4 class="text-xl text-main font-semibold">Berita teratas</h4>
            <div class="news flex gap-5">
                <img src="{{ asset('assets/img/news-img.png') }}" alt="img">
                <div class="desc">
                    <label for="">Maret, 14 2024 | 600 kali dilihat | 50 komentar</label>
                    <p class="desc-news">Politeknik Negeri Malang terjerat kasus dugaan korupsi pengadaan tanah senilai 40
                        M, dua dir...</p>
                </div>
            </div>
            <div class="news flex gap-5">
                <img src="{{ asset('assets/img/news-img.png') }}" alt="img">
                <div class="desc">
                    <label for="">Maret, 14 2024 | 600 kali dilihat | 50 komentar</label>
                    <p class="desc-news">Politeknik Negeri Malang terjerat kasus dugaan korupsi pengadaan tanah senilai 40
                        M, dua dir...</p>
                </div>
            </div>
        </div>
    </div>
    <section class="flex gap-16">
        <x-filter :typeDocument="'berita'" :search="$search" :order="$order" />
        <x-add-news-button />
    </section>
    <table class="table-parent" id="table-parent">
        <thead>
            <tr>
                <th>Judul Berita</th>
                <th>Detail Berita</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-base font-medium">
            @foreach ($news as $n)
                <tr>
                    <td>
                        <div class="flex gap-5 text-main">
                            <img src="{{ $n['url_gambar'] }}" alt="logo" class="w-[8.2rem] h-20 rounded-2xl">
                            <p class="desc-news">
                                {{ $n['judul'] }}
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="grid grid-rows-2 grid-cols-2 gap-4">
                            <x-icon.uploaded />
                            <x-icon.like />
                            <x-icon.eyes />
                            <x-icon.comment />
                        </div>
                    </td>
                    <td>
                        <div class="action flex gap-6">
                            <x-icon.edit />
                            <x-icon.delete />
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div id="pagination">
        {{ $news->links() }}
    </div>
@endsection
