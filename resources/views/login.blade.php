<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    {{-- @vite('resources/css/app.css')
    @vite('resources/css/output.css') --}}
    <title>Login</title>
</head>

<body class="bg-[#F1F0E9] flex h-screen">
    <div class="hidden md:block md:w-1/2 overflow-hidden">
        <img src="{{ asset('login.png') }}" class="object-cover w-full h-full" style="object-position: top left;">
    </div>
    <form action="login" method="post" class="w-full md:w-1/2 px-6 md:px-24 flex items-center justify-center flex-col">
        @csrf
        <span><img src="{{ asset('assets/icons/logo-green.svg') }}" alt=""></span>
        <div class="text-center text-secondary text-5xl font-bold mt-4">SIRUWA</div>
        <input type="text" name="username" placeholder="Username" class="w-full md:w-3/4 mt-16 form-input-login-page">
        
        <div class="w-full md:w-3/4 mt-5 relative" x-data="{ showPassword: false }">
            <input 
                :type="showPassword ? 'text' : 'password'" 
                name="password" 
                placeholder="Password" 
                class="form-input-login-page w-full"
            >
            <img 
                src="{{ asset('assets/icons/eye.svg') }}" 
                alt="Show Password" 
                class="right-icon cursor-pointer absolute inset-y-0 right-3"
                @click="showPassword = !showPassword" 
                x-bind:src="showPassword ? '{{ asset('assets/icons/eye-slash.svg') }}' : '{{ asset('assets/icons/eye.svg') }}'">
        </div>

        @if ($errors->any())
            <div class="w-full md:w-3/4 text-[#D01C1C] font-medium px-4 py-3 relative" role="alert">
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="flex flex-col items-center gap-5 w-full mt-9">
            <button type="submit" class="button-hover w-full md:w-3/4 bg-secondary rounded-2xl text-white px-6 py-3 text-base font-semibold">Masuk</button>
            <a href="#"><span class="text-slate-400 text-base font-medium">Lupa kata sandi?</span></a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
