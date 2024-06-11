<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="https://cdn.jsdelivr.net/npm/luxon@2.1.0/build/global/luxon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <title>@yield('title')</title>

    @vite('resources/css/app.css')

    <style>
        select:not([size]) {
            background-image: unset;
        }

        [x-cloak] {
            display: none;
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
            @yield('modal_riwayat')
            <section class="absolute min-h-full min-w-full flex items-center justify-center bg-black/50 z-50"
                id="loader-modal_parent">
                <div role="status">
                    <svg aria-hidden="true"
                        class="w-16 h-16 text-gray-200 animate-spin dark:text-gray-600 fill-secondary"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </section>
            <x-shared.left-sidebar :page="$page" />
            <div class="content" id="content">
                @yield('content')
            </div>
        </main>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@yield('script')
@yield('sidebar')
<script>
    $(document).ready(function() {
        loader.addClass('hidden')

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
