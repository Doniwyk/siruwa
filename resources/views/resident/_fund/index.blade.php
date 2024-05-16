@extends('layouts.user')
@section('content-user')
{{-- 
    TO-DO
    GANTI VALUE DARI TIAP TIAP DATA DARI DATABASE, JADI TIAP FIELD LANGSUNG KEISI DATA PENDUDUK
--}}
    <div class="mb-9 text-secondary text-4xl font-semibold">Iuran RW</div>
    <div x-data="{ openTab: 1 }" class="">
        <div class="flex justify-between">
            <div class="flex bg-white max-w-sm p-2 rounded-2xl overflow-hidden space-x-4">
                <button x-on:click="openTab = 1" :class="{ 'bg-secondary text-white': openTab === 1 }"
                    class="flex-1 py-2 px-4 rounded-xl text-secondary font-medium focus:font-semibold focus:outline-none focus:shadow-outline-blue transition-all duration-300 w-[176px]">Pembayaran</button>
                <button x-on:click="openTab = 2" :class="{ 'bg-secondary text-white': openTab === 2 }"
                    class="flex-1 py-2 px-4 rounded-xl text-secondary font-medium focus:font-semibold focus:outline-none focus:shadow-outline-blue transition-all duration-300 w-[176px]">Riwayat</button>
            </div>

            <button type="submit" class="rounded-2xl bg-secondary px-12 py-3 text-sm font-semibold text-white hover:bg-[#0F4C52] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Lakukan Pembayaran</button>
        </div>

        <div class="mt-9 flex relative">
            <div class="relative w-3/4">
                <input type="text" placeholder="Cari Data" class="py-2 px-6 rounded-2xl placeholder:text-gray-400 text-base font-medium w-full">
                <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                    <img src="{{ asset('..\assets\icons\search.svg') }}">
                </div>
            </div>
            <div class="ml-16 relative w-1/4">
                <select name="" id="" class="py-2 px-14 rounded-2xl text-gray-400 text-base font-medium w-full appearance-none">
                    <option value="">Filter Data</option>
                    <option value="P">Anu</option>
                </select>
                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                    <!-- Select icon -->
                    <img src="{{ asset('..\assets\icons\filter.svg') }}">
                </div>
            </div>
        </div>
        

        <div class="transition duration-300 ease-in-out transform mt-9">
            <div x-show="openTab === 1" class="bg-white rounded-2xl p-3">
                <div class="overflow-x-auto rounded-xl">
                    <table class="table-auto min-w-full divide-y divide-white text-center">
                        <thead class="text-white bg-secondary text-base tracking-wider">
                            <tr>
                                <th scope="col" class="px-6 py-5 font-medium border-white border-r">Bulan</th>
                                <th scope="col" class="px-6 py-5 font-medium">Januari</th>
                                <th scope="col" class="px-6 py-5 font-medium">Februari</th>
                                <th scope="col" class="px-6 py-5 font-medium">Maret</th>
                                <th scope="col" class="px-6 py-5 font-medium">April</th>
                                <th scope="col" class="px-6 py-5 font-medium">Mei</th>
                                <th scope="col" class="px-6 py-5 font-medium">Juni</th>
                                <th scope="col" class="px-6 py-5 font-medium">Juli</th>
                                <th scope="col" class="px-6 py-5 font-medium">Agustus</th>
                                <th scope="col" class="px-6 py-5 font-medium">September</th>
                                <th scope="col" class="px-6 py-5 font-medium">Oktober</th>
                                <th scope="col" class="px-6 py-5 font-medium">November</th>
                                <th scope="col" class="px-6 py-5 font-medium">Desember</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-white text-base font-medium text-gray-600">
                            <tr>
                                <td class="px-6 py-5 font-medium text-white bg-secondary border-white border-r">Iuran Sampah</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                            </tr>
                            <tr class="bg-[#DBE4E5]">
                                <td class="px-6 py-5 font-medium text-white bg-secondary border-white border-r">Iuran Kematian</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                                <td class="px-6 py-5">Lunas</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-show="openTab === 2" class="">
                <div class="overflow-x-auto rounded-xl">
                    <table class="w-full text-base text-left table-fixed">
                        <thead class="text-white bg-secondary">
                            <tr>
                                <th scope="col" class="px-6 py-4">Nama Pembayar</th>
                                <th scope="col" class="px-6 py-3">Tipe Pembayaran</th>
                                <th scope="col" class="px-6 py-3">Nominal</th>
                                <th scope="col" class="px-6 py-3">Tgl. Pembayaran</th>
                                <th scope="col" class="px-6 py-3">Bulan</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd:bg-white even:bg-[#DBE4E5] border-none text-neutral-900">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">Daffa Maulana Satria</th>
                                <td class="px-6 py-5">Iuran Sampah</td>
                                <td class="px-6 py-4">Rp. 900.000</td>
                                <td class="px-6 py-4">Januari, 24 2024</td>
                                <td class="px-6 py-4">Januari</td>
                                <td class="px-6 py-4">Lunas</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-[#DBE4E5] border-none text-eutral-900">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">Daffa Maulana Satria</th>
                                <td class="px-6 py-5">Iuran Sampah</td>
                                <td class="px-6 py-4">Rp. 900.000</td>
                                <td class="px-6 py-4">Januari, 24 2024</td>
                                <td class="px-6 py-4">Januari</td>
                                <td class="px-6 py-4">Proses Verifikasi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
