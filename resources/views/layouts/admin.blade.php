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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    @vite('resources/css/output.css')
    {{-- @stack('css') --}}
    <style>
        select:not([size]) {
            background-image: unset;
        }
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@yield('script')
@yield('sidebar')
<script>
    $(document).ready(function() {
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
            } else if (typeDocument == "pembayaran" || typeDocument == "riwayatPembayaran") {
                fetchPaymentData(typeDocument, search, order);
            } else {
                fetchResidentData(typeDocument, search, order);
            }
        }

    });
</script>
</html>
