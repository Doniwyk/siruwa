@extends('layouts.landing')
@section('content-landingpage')

<div class="px-16 py-9 flex flex-col gap-16">
    <span class="text-cyan-900 text-4xl font-semibold"> Daftar Berita</span>
    <div class="flex flex-row gap-6">
        <div class="flex flex-col gap-6">
            <input type="text" placeholder="Cari Berita" class="placeholder:text-slate-400 focus:outline-none focus:ring-main focus:ring-2 h-12 p-3 bg-white rounded-2xl justify-start items-center gap-2.5 inline-flex">
            <div class="flex flex-row gap-6">
                <img class="w-72 rounded-2xl" src="https://via.placeholder.com/294x180" />
                <div class="flex flex-col justify-between">
                    <div class="flex flex-col gap-2">
                        <span class="text-neutral-400 text-2xl font-medium leading-9">Maret, 14 2024</span>
                        <span class="text-cyan-900 text-2xl font-semibold">Politeknik Negeri Malang terjerat kasus dugaan korupsi pengadaan tanah senilai 40M, dua direktur diperiksa.</span>
                    </div>
                    <span class="text-neutral-400 text-xl font-medium">#Pendidikantinggi #korupsi #viral #ptn</span>
                </div>
            </div>

            <div class="flex flex-row gap-6">
                <img class="w-72 rounded-2xl" src="https://via.placeholder.com/294x180" />
                <div class="flex flex-col justify-between">
                    <div class="flex flex-col gap-2">
                        <span class="text-neutral-400 text-2xl font-medium leading-9">Maret, 14 2024</span>
                        <span class="text-cyan-900 text-2xl font-semibold">Politeknik Negeri Malang terjerat kasus dugaan korupsi pengadaan tanah senilai 40M, dua direktur diperiksa.</span>
                    </div>
                    <span class="text-neutral-400 text-xl font-medium">#Pendidikantinggi #korupsi #viral #ptn</span>
                </div>
            </div>
        </div>

        <!-- Penyematan Berita -->
        <div class="p-6 bg-cyan-900 rounded-2xl flex-col justify-start items-start gap-6 inline-flex">
            <div class="justify-start items-center gap-3 inline-flex">
                <span class="text-white text-2xl font-semibold">Berita Tersematkan</span>
            </div>
            <div class="w-72 flex-col justify-start items-start gap-3 flex">
                <img class="rounded-2xl" src="https://via.placeholder.com/299x180"/>
                <div class="flex flex-col gap-2">
                    <span class="text-neutral-400 text-xl font-medium">Maret, 16 2024</span>
                    <span class="text-stone-100 text-xl font-semibold">Desa Sumberejo akan menggelar Mobile Legends competition pada tahun...</span>
                </div>
            </div>

            <div class="w-72 flex-col justify-start items-start gap-3 flex">
                <img class="rounded-2xl" src="https://via.placeholder.com/299x180"/>
                <div class="flex flex-col gap-2">
                    <span class="text-neutral-400 text-xl font-medium">Maret, 16 2024</span>
                    <span class="text-stone-100 text-xl font-semibold">Desa Sumberejo akan menggelar Mobile Legends competition pada tahun...</span>
                </div>
            </div>
        </div>
</div>
@endsection