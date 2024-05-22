<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            <x-shared.leftsidebar :page="$page" />
            <div class="content overflow-hidden">
                @yield('content')
            </div>
        </main>
    </div>
</body>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        const tableBody = document.getElementById('table-parent');
                    console.log(tableBody);
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
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 7.75V14.5" stroke="#225157" stroke-width="2" stroke-linecap="round" />
                                        <circle cx="13" cy="17.875" r="1" fill="#51526C" stroke="#225157"
                                            stroke-width="0.25" />
                                        <path
                                            d="M24.0246 13.0001C24.0246 6.91116 19.0885 1.9751 12.9996 1.9751C6.91067 1.9751 1.97461 6.91116 1.97461 13.0001C1.97461 19.089 6.91067 24.0251 12.9996 24.0251C19.0885 24.0251 24.0246 19.089 24.0246 13.0001Z"
                                            stroke="#225157" stroke-width="2" stroke-miterlimit="10" />
                                    </svg>
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
                                    <button class="flex-center">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 7.75V14.5" stroke="#225157" stroke-width="2" stroke-linecap="round" />
                                        <circle cx="13" cy="17.875" r="1" fill="#51526C" stroke="#225157"
                                            stroke-width="0.25" />
                                        <path
                                            d="M24.0246 13.0001C24.0246 6.91116 19.0885 1.9751 12.9996 1.9751C6.91067 1.9751 1.97461 6.91116 1.97461 13.0001C1.97461 19.089 6.91067 24.0251 12.9996 24.0251C19.0885 24.0251 24.0246 19.089 24.0246 13.0001Z"
                                            stroke="#225157" stroke-width="2" stroke-miterlimit="10" />
                                    </svg>
                                </button>
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
                    console.error("Error: " + status + " " + error);
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
                    console.log(news);

                    if (!news.length) {
                        $('#table-parent tbody').append(
                            `<tr>
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>`
                        );
                        return;
                    }
                    $.each(news, function(index, news) {
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
                                    <div class="grid grid-rows-2 grid-cols-2 gap-4">
                                        <x-icon.uploaded />
                                        <x-icon.like />
                                        <x-icon.eyes />
                                        <x-icon.comment />
                                    </div>
                                </td>
                                <td>
                                    <div class="action flex gap-6">
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.5 22H3.5C3.09 22 2.75 21.66 2.75 21.25C2.75 20.84 3.09 20.5 3.5 20.5H21.5C21.91 20.5 22.25 20.84 22.25 21.25C22.25 21.66 21.91 22 21.5 22Z"
                                                fill="#225157" />
                                            <path
                                                d="M19.5206 3.48016C17.5806 1.54016 15.6806 1.49016 13.6906 3.48016L12.4806 4.69016C12.3806 4.79016 12.3406 4.95016 12.3806 5.09016C13.1406 7.74016 15.2606 9.86016 17.9106 10.6202C17.9506 10.6302 17.9906 10.6402 18.0306 10.6402C18.1406 10.6402 18.2406 10.6002 18.3206 10.5202L19.5206 9.31016C20.5106 8.33016 20.9906 7.38016 20.9906 6.42016C21.0006 5.43016 20.5206 4.47016 19.5206 3.48016Z"
                                                fill="#225157" />
                                            <path
                                                d="M16.1103 11.5298C15.8203 11.3898 15.5403 11.2498 15.2703 11.0898C15.0503 10.9598 14.8403 10.8198 14.6303 10.6698C14.4603 10.5598 14.2603 10.3998 14.0703 10.2398C14.0503 10.2298 13.9803 10.1698 13.9003 10.0898C13.5703 9.8098 13.2003 9.4498 12.8703 9.0498C12.8403 9.0298 12.7903 8.9598 12.7203 8.8698C12.6203 8.7498 12.4503 8.5498 12.3003 8.3198C12.1803 8.1698 12.0403 7.9498 11.9103 7.7298C11.7503 7.4598 11.6103 7.1898 11.4703 6.9098C11.4491 6.86441 11.4286 6.81924 11.4088 6.77434C11.2612 6.44102 10.8265 6.34358 10.5688 6.60133L4.84032 12.3298C4.71032 12.4598 4.59032 12.7098 4.56032 12.8798L4.02032 16.7098C3.92032 17.3898 4.11032 18.0298 4.53032 18.4598C4.89032 18.8098 5.39032 18.9998 5.93032 18.9998C6.05032 18.9998 6.17032 18.9898 6.29032 18.9698L10.1303 18.4298C10.3103 18.3998 10.5603 18.2798 10.6803 18.1498L16.4016 12.4285C16.6612 12.1689 16.5633 11.7235 16.2257 11.5794C16.1877 11.5632 16.1492 11.5467 16.1103 11.5298Z"
                                                fill="#225157" />
                                        </svg>
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.5697 5.23C19.9597 5.07 18.3497 4.95 16.7297 4.86V4.85L16.5097 3.55C16.3597 2.63 16.1397 1.25 13.7997 1.25H11.1797C8.84967 1.25 8.62967 2.57 8.46967 3.54L8.25967 4.82C7.32967 4.88 6.39967 4.94 5.46967 5.03L3.42967 5.23C3.00967 5.27 2.70967 5.64 2.74967 6.05C2.78967 6.46 3.14967 6.76 3.56967 6.72L5.60967 6.52C10.8497 6 16.1297 6.2 21.4297 6.73C21.4597 6.73 21.4797 6.73 21.5097 6.73C21.8897 6.73 22.2197 6.44 22.2597 6.05C22.2897 5.64 21.9897 5.27 21.5697 5.23Z"
                                                fill="#DA2121" />
                                            <path
                                                d="M19.7298 8.14C19.4898 7.89 19.1598 7.75 18.8198 7.75H6.17975C5.83975 7.75 5.49975 7.89 5.26975 8.14C5.03975 8.39 4.90975 8.73 4.92975 9.08L5.54975 19.34C5.65975 20.86 5.79975 22.76 9.28975 22.76H15.7098C19.1998 22.76 19.3398 20.87 19.4498 19.34L20.0698 9.09C20.0898 8.73 19.9598 8.39 19.7298 8.14ZM14.1597 17.75H10.8298C10.4198 17.75 10.0798 17.41 10.0798 17C10.0798 16.59 10.4198 16.25 10.8298 16.25H14.1597C14.5697 16.25 14.9097 16.59 14.9097 17C14.9097 17.41 14.5697 17.75 14.1597 17.75ZM14.9998 13.75H9.99975C9.58975 13.75 9.24975 13.41 9.24975 13C9.24975 12.59 9.58975 12.25 9.99975 12.25H14.9998C15.4097 12.25 15.7498 12.59 15.7498 13C15.7498 13.41 15.4097 13.75 14.9998 13.75Z"
                                                fill="#DA2121" />
                                        </svg>

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
            if (typeDocument == "berita") {
                fetchNewsData(typeDocument, search, order);
            } else {
                fetchResidentData(typeDocument, search, order);
            }
        });

        // Event handler untuk select order
        $('#order-select').on('click', function() {
            const order = this.value == 'asc' ? 'desc' : 'asc';
            $(this).toggleClass('button-order_desc');
            var search = $('#search-input').val();
            var typeDocument = $('#typeDocument').val();
            if (typeDocument == "berita") {
                fetchNewsData(typeDocument, search, order);
            } else {
                fetchResidentData(typeDocument, search, order);
            }
            this.value = order;
        });

        $('#typeDocument').on('keyup', function() {
            var typeDocument = $(this).val();
            var search = $('#search-input').val();
            var order = $('#order-select').val();
            if (typeDocument == "berita") {
                fetchNewsData(typeDocument, search, order);
            } else {
                fetchResidentData(typeDocument, search, order);
            }
        });

    });
</script>

</html>
