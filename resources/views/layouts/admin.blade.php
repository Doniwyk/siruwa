<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/luxon@2.1.0/build/global/luxon.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    @vite('resources/css/output.css')
</head>

<body>
    <div id="root" class="h-screen flex flex-col">
        <header>
            <x-shared.topbar />
        </header>
        <main class="grow flex">
            @yield('modal')
            <x-shared.leftsidebar :page="$page" />
            <div class="content ">
                <div class="wrapper flex flex-col gap-y-5 h-full overflow-scroll bg-white p-11 rounded-2xl relative">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        function fetchResidentData(typeDocument = '', search = '', order = 'asc', page = 1) {
            $.ajax({
                url: '{{ route('admin.data-penduduk.index') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    typeDocument: typeDocument,
                    search: search,
                    order: order,
                    page: page
                },
                success: function(data) {
                    console.log(data);
                    const initialLocation =
                        `${window.location.origin}/admin/data-penduduk?typeDocument=${typeDocument}&search=${search}&order=${order}&page=${page}`;
                    window.history.pushState({
                        path: initialLocation
                    }, '', initialLocation);

                    const residents = data.residents;

                    $('#table-parent tbody').empty();
                    $('#pagination').empty();

                    if (!residents.length) {
                        $('#table-parent tbody').append(
                            `<tr>
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>`
                        );
                        return;
                    }
                    switch (typeDocument) {
                        case 'daftar-penduduk':
                            $.each(residents, function(index, resident) {
                                const residentId = resident.id_penduduk;
                                console.log(residentId);
                                $('#table-parent tbody').append(
                                    `<tr>
                                <td>${resident.nama}</td>
                                <td>${resident.nik}</td>
                                <td>${resident.tgl_lahir}</td>
                                <td>${resident.no_reg}</td>
                                <td class="flex-start">
                                    <a class="flex-center"
                                    href=" data-penduduk/${residentId}/show ">
                                    <x-icon.detail />
                                </a>
                                </td>
                            </tr>`
                                );
                            });
                            break;
                        case 'pengajuan':
                            $.each(residents, function(index, resident) {
                                $('#table-parent tbody').append(
                                    `<tr>
                                <td>${resident.nama}</td>
                                <td>${resident.nik}</td>
                                <td>${resident.tgl_lahir}</td>
                                <td>${resident.no_reg}</td>
                                <td>
                                    <a class="flex-start" href=" data-penduduk/${resident.id_penduduk}/edit }}">
                                        <x-icon.detail />
                                    </a>
                                </td>
                            </tr>`
                                );
                            });
                            break;
                        case 'riwayat':
                            $.each(residents, function(index, resident) {
                                $('#table-parent tbody').append(
                                    `<tr>
                                <td>${resident.nama}</td>
                                <td>${resident.nik}</td>
                                <td>${resident.tgl_lahir}</td>
                                <td>${resident.no_reg}</td>
                                <td>${resident.status}</td>
                            </tr>`
                                );
                            });
                            break;
                        default:
                            break;
                    }

                    $('#pagination').append(data.paginationHtml); // Update HTML paginasi
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

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
                        var dateString = news.created_at;

                        var dateTime = luxon.DateTime.fromISO(dateString);

                        var formattedDate = dateTime.toFormat('MMMM, dd yyyy');
                        $('#table-parent tbody').append(
                            `
                            <tr>
                                <td>
                                    <div class="flex gap-5 text-main">
                                        <img src="${news.url_gambar}" alt="logo" class="w-[8.2rem] h-20 rounded-2xl">
                                        <p class="desc-news">
                                            ${news.judul}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="details">
                                    <x-icon.uploaded />
                                    <label for="">${formattedDate}</label>
                                </div>
                                </td>
                                <td>
                                    <div class="action flex gap-6">
                                        <x-icon.edit />
                                        <x-icon.delete />
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
                        var dateString = news.tanggal;

                        var dateTime = luxon.DateTime.fromISO(dateString);

                        var formattedDate = dateTime.toFormat('MMMM, dd yyyy');
                        $('#table-parent tbody').append(
                            `
                            <tr>
                                <td>
                                    <div class="flex gap-5 text-main">
                                        <img src="${news.url_gambar}" alt="logo" class="w-[8.2rem] h-20 rounded-2xl">
                                        <p class="desc-news">
                                            ${news.judul}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="details">
                                    <x-icon.uploaded />
                                    <label for="">${formattedDate}</label>
                                </div>
                                </td>
                                <td>
                                    <div class="action flex gap-6">
                                        <x-icon.edit />
                                        <x-icon.delete />
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

        // Event handler untuk input search
        $('#search-input').on('keyup', function() {
            var search = $(this).val();
            var order = $('#order-select').val();
            var typeDocument = $('#typeDocument').val();
            fetchData(typeDocument, search, order);
        });

        // Event handler untuk select order
        $('#order-select').on('click', function() {
            const order = this.value == 'asc' ? 'desc' : 'asc';
            $(this).toggleClass('button-order_desc');
            var search = $('#search-input').val();
            var typeDocument = $('#typeDocument').val();
            fetchData(typeDocument, search, order);
            this.value = order;
        });

        $('#typeDocument').on('keyup', function() {
            var typeDocument = $(this).val();
            var search = $('#search-input').val();
            var order = $('#order-select').val();
            fetchData(typeDocument, search, order);
        });

        function fetchData(typeDocument, search, order) {
            if (typeDocument == "berita") {
                fetchNewsData(typeDocument, search, order);
            } else if (typeDocument == "acara") {
                fetchEventData(typeDocument, search, order);
            } else {
                fetchResidentData(typeDocument, search, order);
            }
        }

    });
</script>
@yield('script')
</html>
