<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        select:not([size]) {
            background-image: unset;
        }
        [x-cloak] { display: none; }
    </style>
</head>

<body class="bg-[#F1F0E9] flex flex-col min-h-screen">
    <header>
        <x-shared.user-topbar/>
    </header>
    <main>
        <div class="content-user">
            @yield('content-user')
        </div>
    </main>
    <footer class="mt-auto">
        <x-shared.user-footer/>
    </footer>
</body>

</html>
