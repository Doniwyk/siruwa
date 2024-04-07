<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pages }}</title>
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
        <footer></footer>
    </div>

</body>

</html>
