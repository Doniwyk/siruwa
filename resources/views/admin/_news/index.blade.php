@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Manajemen Berita & Acara</h1>
    <div class="summary-card_news">
        <div
            class="summary-card card-top flex flex-col border-y border-r border-l-8 border-main sm:gap-1 md:gap-4 drop-shadow-xl">
            <h4 class="text-xl text-main font-semibold mb-2">Acara terdekat</h4>
            @if (!$lastestEvent->isEmpty())
                @foreach ($lastestEvent as $ln)
                    <x-highlight-card :newsData=$ln />
                @endforeach
            @else
                <span class="text-center font-semibold text md text-main">NOT FOUND</span>
            @endif
        </div>
        <div
            class="summary-card card-top flex flex-col border-y border-r border-l-8 border-main sm:gap-1 md:gap-4 drop-shadow-xl">
            <h4 class="text-xl text-main font-semibold mb-2">Berita terbaru</h4>
            @if (!$lastestNews->isEmpty())
                @foreach ($lastestNews as $ln)
                    <x-highlight-card :newsData=$ln />
                @endforeach
            @else
                <span class="text-center font-semibold text md text-main">NOT FOUND</span>
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
                        <th class="sm:text-sm md:text-base">Judul Berita</th>
                        <th class="sm:hidden md:table-cell sm:text-sm md:text-base">Tanggal Upload</th>
                        <th class="sm:text-sm md:text-base">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-base font-medium">
                    @if ($news->isEmpty())
                        <tr>
                            <td class="text-center sm:col-span-2 md:col-span-3 ">No data found</td>
                        </tr>
                    @else
                        @foreach ($news as $n)
                            <tr>
                                <td class="sm:text-sm md:text-base relative">
                                    <div class=" flex gap-5 text-main sm:items-center md:items-start relative">
                                        <div class="relative min-w-[8.2rem] h-20">
                                            <div
                                                class="animate-pulse flex items-center justify-center w-full h-full bg-gray-300 dark:bg-gray-700 rounded-2xl absolute">
                                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                    <path
                                                        d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                                </svg>
                                            </div>
                                            <img src="{{ $n->url_gambar }}" alt="logo"
                                                class="min-w-[8.2rem] h-20 rounded-2xl object-fill hidden">
                                        </div>
                                        <p class="desc-news text-wrap">
                                            {{ $n->judul }}
                                        </p>
                                    </div>
                                </td>
                                <td class="sm:hidden md:table-cell sm:text-sm md:text-base">
                                    <div class="details">
                                        <x-icon.uploaded />
                                        <label for="">{{ date('F, j Y', strtotime($n->created_at)) }}</label>
                                    </div>
                                </td>
                                <td class="sm:text-sm md:text-base">
                                    <div class="action flex gap-6">
                                        <a href="{{ route('admin.manajemen-berita.edit', ['news' => $n->id_berita]) }}"
                                            class="hover">
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
                                        <form action="{{ route('admin.manajemen-berita.edit-status', ['news' => $n->id_berita]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            @switch($n->status)
                                                @case('Uploaded')
                                                    <button type="submit" name="action" value="draft">
                                                        <x-icon.draft-icon />
                                                    </button>
                                                @break

                                                @case('Draft')
                                                    <button type="submit" name="action" value="upload">
                                                        <x-icon.publish-icon />
                                                    </button>
                                                @break
                                            @endswitch
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
                        <th class="sm:text-sm md:text-base">Judul Acara</th>
                        <th class="sm:hidden md:table-cell">Detail Acara</th>
                        <th class="sm:text-sm md:text-base">Aksi</th>
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
                                <td class="sm:text-sm md:text-base relative">
                                    <div class=" flex gap-5 text-main sm:items-center md:items-start relative">
                                        <div class="relative min-w-[8.2rem] h-20">
                                            <div
                                                class="animate-pulse flex items-center justify-center w-full h-full bg-gray-300 dark:bg-gray-700 rounded-2xl absolute">
                                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                    <path
                                                        d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                                                </svg>
                                            </div>
                                            <img src="{{ $n->url_gambar }}" alt="logo"
                                                class="min-w-[8.2rem] h-20 rounded-2xl object-fill hidden">
                                        </div>
                                        <p class="desc-news text-wrap">
                                            {{ $n->judul }}
                                        </p>
                                    </div>
                                </td>
                                <td class="sm:hidden md:table-cell sm:text-sm md:text-base">
                                    <div class="details">
                                        <x-icon.uploaded />
                                        <label for="">{{ date('F, j Y', strtotime($n->created_at)) }}</label>
                                    </div>
                                </td>
                                <td class="sm:text-sm md:text-base">
                                    <div class="action flex gap-6">
                                        <a href="{{ route('admin.manajemen-acara.edit', ['event' => $n->id_agenda]) }}"
                                            class="hover">
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
                                        <form action="{{ route('admin.manajemen-acara.edit-status', ['event' => $n->id_agenda]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            @switch($n->status)
                                                @case('Uploaded')
                                                    <button type="submit" name="action" value="draft">
                                                        <x-icon.draft-icon />
                                                    </button>
                                                @break

                                                @case('Draft')
                                                    <button type="submit" name="action" value="upload">
                                                        <x-icon.publish-icon />
                                                    </button>
                                                @break
                                            @endswitch
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

@section('script')
    <script>
        function fetchNewsData(typeDocument = '', search = '', order = 'asc', page = 1) {
            $.ajax({
                url: '{{ route('admin.manajemen-berita.index') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    typeDocument: typeDocument,
                    search: search,
                    order: order,
                    page: page
                },
                success: function(data) {
                    const tableBody = document.getElementById('table-parent tbody');
                    console.log(tableBody);

                    $('#table-parent tbody').empty();
                    $('#pagination').empty();

                    const initialLocation =
                        `${window.location.origin}/admin/manajemen-berita?typeDocument=${typeDocument}&search=${search}&order=${order}&page=${page}`;
                    window.history.pushState({
                        path: initialLocation
                    }, '', initialLocation);

                    const news = data.news;

                    if (!news.length) {
                        $('#table-parent tbody').append(
                            `<tr>
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>`
                        );
                        return;
                    }

                    $.each(news, function(index, news) {
                        let dateString = news.created_at;

                        let dateTime = luxon.DateTime.fromISO(dateString);

                        let formattedDate = dateTime.toFormat('MMMM, dd yyyy');

                        let editUrl = `{{ route('admin.manajemen-berita.edit', ':id') }}`.replace(
                            ':id', news.id_berita);
                        let deleteUrl = `{{ route('admin.manajemen-berita.delete', ':id') }}`.replace(
                            ':id', news.id_berita);
                        let editStatusUrl = `{{ route('admin.manajemen-berita.edit-status', ':id') }}`
                            .replace(':id', news.id_berita);

                        let statusButton;
                        if (news.status === 'Uploaded') {
                            statusButton = `
                                <form action="${editStatusUrl}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="draft">
                                        <x-icon.draft-icon />
                                    </button>
                                </form>
                            `;
                        } else if (news.status === 'Draft') {
                            statusButton = `
                                <form action="${editStatusUrl}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="upload">
                                        <x-icon.publish-icon />
                                    </button>
                                </form>
                            `;
                        }

                        $('#table-parent tbody').append(
                            `
                            <tr>
                                <td class="sm:text-sm md:text-base">
                                    <div class="flex gap-5 text-main">
                                        <img src="${news.url_gambar}" alt="logo" 
                                            class="w-[8.2rem] h-20 rounded-2xl">
                                        <p class="desc-news text-wrap">
                                            ${news.judul}
                                        </p>
                                    </div>
                                </td>
                                <td class="sm:hidden md:table-cell sm:text-sm md:text-base">
                                    <div class="details">
                                        <x-icon.uploaded />
                                        <label for="">${formattedDate}</label>
                                    </div>
                                </td>
                                <td class="sm:text-sm md:text-base">
                                    <div class="action flex gap-6">
                                        <a href="${editUrl}" 
                                            class="hover">
                                            <x-icon.edit />
                                        </a>
                                        <form action="${deleteUrl}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <x-icon.delete />
                                            </button>
                                        </form>
                                        ${statusButton}
                                    </div>
                                </td>
                            </tr>
                            `
                        );
                    });

                    $('#pagination').append(data.paginationHtml); // Update pagination HTML
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                }
            });
        }


        function fetchEventData(typeDocument = '', search = '', order = 'asc', page = 1) {
            $.ajax({
                url: '{{ route('admin.manajemen-berita.index') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    typeDocument: typeDocument,
                    search: search,
                    order: order,
                    page: page
                },
                success: function(data) {
                    const tableBody = document.getElementById('table-parent tbody');
                    console.log(tableBody);

                    $('#table-parent tbody').empty();
                    $('#pagination').empty();

                    const initialLocation =
                        `${window.location.origin}/admin/manajemen-berita?typeDocument=${typeDocument}&search=${search}&order=${order}&page=${page}`;
                    window.history.pushState({
                        path: initialLocation
                    }, '', initialLocation);

                    const news = data.news;

                    if (!news.length) {
                        $('#table-parent tbody').append(
                            `<tr>
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>`
                        );
                        return;
                    }
                    $.each(news, function(index, news) {
                        let dateString = news.tanggal;

                        dateTime = luxon.DateTime.fromSQL(dateString);

                        let formattedDate = dateTime.toFormat('MMMM, dd yyyy');

                        let editUrl = `{{ route('admin.manajemen-acara.edit', ':id') }}`.replace(':id',
                            news.id_agenda);
                        let deleteUrl = `{{ route('admin.manajemen-acara.delete', ':id') }}`.replace(
                            ':id', news.id_agenda);
                        let editStatusUrl = `{{ route('admin.manajemen-acara.edit-status', ':id') }}`
                            .replace(':id', news.id_agenda);

                        let statusButton;
                        if (news.status === 'Uploaded') {
                            statusButton = `
                                <form action="${editStatusUrl}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="draft">
                                        <x-icon.draft-icon />
                                    </button>
                                </form>
                            `;
                        } else if (news.status === 'Draft') {
                            statusButton = `
                                <form action="${editStatusUrl}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="upload">
                                        <x-icon.publish-icon />
                                    </button>
                                </form>
                            `;
                        }
                        $('#table-parent tbody').append(
                            `
                            <tr>
                                <td class="sm:text-sm md:text-base">
                                    <div class="flex gap-5 text-main">
                                        <img src="${news.url_gambar}" alt="logo" 
                                            class="w-[8.2rem] h-20 rounded-2xl">
                                        <p class="desc-news text-wrap">
                                            ${news.judul}
                                        </p>
                                    </div>
                                </td>
                                <td class="sm:hidden md:table-cell sm:text-sm md:text-base">
                                    <div class="details">
                                        <x-icon.uploaded />
                                        <label for="">${formattedDate}</label>
                                    </div>
                                </td>
                                <td class="sm:text-sm md:text-base">
                                    <div class="action flex gap-6">
                                        <a href="${editUrl}" 
                                            class="hover">
                                            <x-icon.edit />
                                        </a>
                                        <form action="${deleteUrl}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <x-icon.delete />
                                            </button>
                                        </form>
                                        ${statusButton}
                                    </div>
                                </td>
                            </tr>
                            `
                        );
                    });

                    $('#pagination').append(data.paginationHtml); // Update HTML paginasi
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                }
            });
        }
        $(document).ready(function() {
            let images = $('.animate-pulse + img');

            images.each(function() {
                let image = $(this);
                let skeleton = image.prev('.animate-pulse');

                image.on('load', function() {
                    image.removeClass('hidden');
                    skeleton.addClass('hidden');
                });

                if (image[0].complete) {
                    image.trigger('load');
                }
            });
        })
    </script>
@endsection
