<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{ $pages }}</title> --}}
    @vite('resources/css/app.css')
    @vite('resources/css/output.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>

<body class="bg-[#F1F0E9] flex flex-col min-h-screen">
    <header>
        <x-shared.user-topbar/>
    </header>
    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>
    <footer class="mt-auto">
        <x-shared.user-footer/>
    </footer>
</body>

</html>
