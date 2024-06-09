<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
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
        <input type="text" name="username" placeholder="Username"
            class="w-full md:w-3/4 mt-16 form-input-login-page">

        <div class="w-full md:w-3/4 mt-5 relative" x-data="{ showPassword: false }">
            <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Password"
                class="form-input-login-page w-full">
            <img src="{{ asset('assets/icons/eye.svg') }}" alt="Show Password"
                class="right-icon cursor-pointer absolute inset-y-0 right-3" @click="showPassword = !showPassword"
                x-bind:src="showPassword ? '{{ asset('assets/icons/eye-slash.svg') }}' : '{{ asset('assets/icons/eye.svg') }}'">
        </div>

        @if ($errors->any())
            <div class="w-full md:w-3/4 text-[#D01C1C] font-medium px-4 py-3 relative" role="alert">
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="flex flex-col items-center gap-5 w-full mt-9">
            <button type="submit" id="button_submit"
                class="button-hover w-full md:w-3/4 bg-secondary rounded-2xl text-white px-6 py-3 text-base font-semibold">
                <svg id="loader" role="status" class="inline w-4 h-4 me-3 text-white animate-spin hidden"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="#E5E7EB" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentColor" />
            </svg>
            <span>Masuk</span>
            </button>
            <a href="#"><span class="text-slate-400 text-base font-medium">Lupa kata sandi?</span></a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () { 
        $('form').on('submit', function () {
            $('#loader').removeClass('hidden')
            $('form button span').text('Loading...');
          })
     })
</script>
</html>
