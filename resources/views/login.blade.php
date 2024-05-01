<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>
<body class="bg-[#F1F0E9] flex h-screen">
    <div class="w-1/2 overflow-hidden">
        <img src="{{ asset('..\login.png') }}" class="object-cover w-full h-full" style="object-position: top left;">
    </div>
    <div class="w-1/2 px-24 flex items-center justify-center flex-col">
        <div class="text-center text-secondary text-5xl font-extrabold">{>///<}</div>
        <div class="text-center text-secondary text-5xl font-extrabold mt-4">Siuwu Login</div>
        <input type="text" placeholder="Username" class="w-3/4 rounded-2xl py-3 px-6 mt-16 border-0 text-gray-900 ring-inset focus:ring-1 focus:ring-inset focus:ring-secondary focus:outline-none">
        <input type="password" placeholder="Password" class="w-3/4 rounded-2xl py-3 px-6 mt-5 text-gray-900 ring-inset focus:ring-1 focus:ring-inset focus:ring-secondary focus:outline-none">
        <div class="flex justify-between w-3/4 mt-5">
            <label class="flex items-center">
                <input type="checkbox" class="mr-2 appearance-none border-none rounded-md bg-white w-6 h-6 checked:bg-secondary">
                <span class="text-secondary text-base font-medium">Ingat saya</span>
            </label>
            <a href=""><span class="text-slate-400 text-base font-medium">Lupa kata sandi?</span></a>
        </div>
        <button type="submit" class="w-3/4 bg-secondary rounded-2xl text-white px-6 py-3 text-base font-semibold mt-9">Masuk</button>
    </div>
</body>
</html>