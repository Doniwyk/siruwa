@extends('layouts.user')
@section('content')
{{-- 
    TO-DO
    GANTI VALUE DARI TIAP TIAP DATA DARI DATABASE, JADI TIAP FIELD LANGSUNG KEISI DATA PENDUDUK
--}}
<div class="mb-9 text-secondary text-4xl font-semibold">Edit Profil</div>
<div class="flex gap-9">
    <div class="w-[296px] h-[696px] p-9 bg-secondary rounded-2xl">
        <div class="flex flex-col items-center">
            <img class="w-[144.50px] h-[144.50px] mb-9 rounded-full z-50" src="https://via.placeholder.com/144x144" />
            <div class="text-white text-center text-xl font-medium">Arucaden</div>
            <div class="text-white text-center text-2xl font-bold mb-6">Daffa Loli-Lover</div>
            <div class="flex flex-col gap-[8px] text-center text-white leading-normal">
                <div>23921391293912783</div>
                <div>daffamaulanasatria@gmail.com</div>
                <div>083845734645</div>
            </div>
        </div>
    </div>

    <div class="flex-1 p-4 bg-white rounded-2xl px-16 py-9">
        <div class="flex flex-col">
            <form action="">
                <div class="text-secondary text-2xl font-bold">Informasi Pengguna</div>                       
                <div class="mt-5 grid gap-x-9 gap-y-5 grid-cols-2">
                    <div class="sm:col-span-1">
                        <label for="username" class="block text-sm font-medium leading-6 text-cyan-900">Username</label>
                        <div class="mt-3">
                            <input type="text" name="username" id="username" value="Username" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none sm:text-sm sm:leading-6">
                        </div>
                    </div>
            
                    <div class="sm:col-span-1">
                        <label for="email" class="block text-sm font-medium leading-6 text-cyan-900">Email</label>
                        <div class="mt-3">
                                <input type="email" name="email" id="email" value="Email" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none sm:text-sm sm:leading-6">
                        </div>
                    </div>
            
                    <div class="sm:col-span-1">
                        <label for="nomor_hp" class="block text-sm font-medium leading-6 text-cyan-900">No. HP</label>
                        <div class="mt-3">
                            <input id="nomor_hp" name="nomor_hp" type="nomor_hp" value="08xxxxxxxx" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-2xl bg-secondary px-12 py-3.5 text-sm font-semibold text-white hover:bg-[#0F4C52] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan Perubahan</button>
                </div>
            </form>
            {{-- -------------------------------------------------------------------------------- --}}
            <div class="mt-9">
                <form action="">
                    <div class=" text-secondary text-2xl font-bold">Kata Sandi</div>
                    <div class="mt-5 grid gap-x-9 gap-y-5 grid-cols-2">
                        <div class="sm:col-span-1">
                            <label for="sandi_baru" class="block text-sm font-medium leading-6 text-cyan-900">Kata Sandi Baru</label>
                            <div class="mt-3">
                                <div class="relative">
                                    <input type="text" name="sandi_baru" id="sandi_baru" placeholder="Kata Sandi Baru" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 ring-2 ring-inset ring-gray-400 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none sm:text-sm sm:leading-6">
                                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                                        <img src="{{ asset('..\assets\icons\eye.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="sm:col-span-1">
                            <label for="sandi_lama" class="block text-sm font-medium leading-6 text-cyan-900">Kata Sandi Lama</label>
                            <div class="mt-3">
                                <div class="relative">
                                    <input type="text" name="sandi_lama" id="sandi_lama" placeholder="Kata Sandi Lama" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 ring-2 ring-inset ring-gray-400 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none sm:text-sm sm:leading-6">
                                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                                        <img src="{{ asset('..\assets\icons\eye.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="sm:col-span-1">
                            <label for="konfirmasi_sandi" class="block text-sm font-medium leading-6 text-cyan-900">Konfirmasi Kata Sandi Baru</label>
                            <div class="mt-3">
                                <div class="relative">
                                    <input type="text" id="konfirmasi_sandi" name="konfirmasi_sandi" placeholder="Konfirmasi Kata Sandi Baru" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 ring-2 ring-inset ring-gray-400 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none sm:text-sm sm:leading-6">
                                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                                        <img src="{{ asset('..\assets\icons\eye.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit" class="rounded-2xl bg-secondary px-12 py-3.5 text-sm font-semibold text-white hover:bg-[#0F4C52] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>      
@endsection
