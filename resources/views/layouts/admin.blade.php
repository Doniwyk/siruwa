<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/luxon@2.1.0/build/global/luxon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <style>
        select:not([size]) {
            background-image: unset;
        }

        [x-cloak] { display: none; }
    </style>
</head>

<body>
    <div id="root" class="h-screen flex flex-col">
        <header>
            <x-shared.topbar />
        </header>
        <main class="grow flex">
            @yield('modal')
            <x-shared.leftsidebar :page="$page" />
            <div class="content" id="content">
                @yield('content')
            </div>
        </main>
    </div>
</body>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
@yield('script')
@yield('sidebar')
<script>
    $(document).ready(function() {
        var debounceTimer;
        $('#search-input').on('keyup', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                var search = $('#search-input').val();
                var order = $('#order-select').val();
                var typeDocument = $('#typeDocument').val();
                fetchData(typeDocument, search, order);
            }, 300);
        });

        $('#order-select').on('click', function() {
            const order = this.value == 'asc' ? 'desc' : 'asc';
            $(this).toggleClass('button-order_desc');
            var search = $('#search-input').val();
            var typeDocument = $('#typeDocument').val();
            fetchData(typeDocument, search, order);
            this.value = order;
        });

        $('#typeDocument').on('keyup', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                var typeDocument = $('#typeDocument').val();
                var search = $('#search-input').val();
                var order = $('#order-select').val();
                fetchData(typeDocument, search, order);
            }, 300);
        });

        function fetchData(typeDocument, search, order) {
            if (typeDocument == "berita") {
                fetchNewsData(typeDocument, search, order);
            } else if (typeDocument == "acara") {
                fetchEventData(typeDocument, search, order);
            } else if (typeDocument == "pembayaran" || typeDocument == "riwayatPembayaran") {
                fetchPaymentData(typeDocument, search, order);
            } else if (typeDocument == "iuran-kematian" || typeDocument == "iuran-sampah") {
                fetchTunggakanData(typeDocument, search, order);
            } else {
                fetchResidentData(typeDocument, search, order);
            }
        }

    });
</script>

</html>
