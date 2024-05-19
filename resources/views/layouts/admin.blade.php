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
            <div class="content ">
                @yield('content')
            </div>
        </main>
    </div>
</body>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchData(typeDocument = '', search = '', order = 'asc', page = 1) {
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
                    console.log(residents);

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

    });
</script>

</html>
