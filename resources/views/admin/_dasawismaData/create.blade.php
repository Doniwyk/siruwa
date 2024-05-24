@extends('layouts.admin')
@section('content')
<div class="header-edit flex-start gap-1">
    <a href="{{ route('admin.data-penduduk.index') }}">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z"
                    fill="#225157" />
            </svg>
        </span>
    </a>
    <h1 class="h1-semibold">Tambah Penduduk</h1>
</div>
<main class="bg-white py-9 px-24 rounded-2xl flex flex-col gap-9">
    <section id="identitas-kependudukan" class="">
        <h4 class="h4-semibold">Identitas Kependudukan</h4>
        <form action="" class="grid grid-rows-2 grid-flow-col gap-x-9 gap-y-5">
            <x-form.add-input :label="'Nama'"  :name="'reqNama'" :placeholder="'Masukkan Nama'" />
            <x-form.add-input :label="'No. KTP/NIK'"  :name="'reqKtp'" :placeholder="'Masukkan No. KTP/NIK'" />
            <x-form.add-input :label="'No. Registrasi'"  :name="'reqRegistrasi'" :placeholder="'Masukkan No. Registrasi'" />
            <x-form.add-input :label="'Alamat Lengkap'"  :name="'reqAlamat'" :placeholder="'Masukkan Alamat Lengkap'" />
        </form>
    </section>
    <section id="identitas-lengkap">
        <h4 class="h4-semibold">Identitas Lengkap</h4>
        <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <x-form.add-input :label="'Pekerjaan dan Jabatan'"  :name="'reqPekerjaan'" :placeholder="'Masukkan Pekerjaan dan Jabatan'" />
            <x-form.add-input :label="'Tempat Lahir / Umur'"  :name="'reqTempatLahir'" :placeholder="'Masukkan Tempat Lahir / Umur'" />
            <x-form.add-input :label="'Jenis Kelamin'"  :name="'reqJenisKelamin'" :placeholder="'Masukkan Jenis Kelamin'" />
            <x-form.add-input :label="'Agama'"  :name="'reqAgama'" :placeholder="'Masukkan Agama'" />
            <x-form.add-input :label="'Pendidikan'"  :name="'reqPendidikan'" :placeholder="'Masukkan Pendidikan'" />
            <x-form.add-input :label="'Status Perkawinan'"  :name="'reqStatusPerkawinan'" :placeholder="'Masukkan Status Perkawinan'" />
            <x-form.add-input :label="'Status dalam Keluarga'"  :name="'reqStatusDalamKeluarga'" :placeholder="'Masukkan Status dalam Keluarga'" />
            <x-form.add-input :label="'Memiliki Tabungan'"  :name="'reqMemilikiTabungan'" :placeholder="'Iya/Tidak'" />
        </form>
    </section>
    <section id="kegiatan-keorganisasian">
        <h4 class="h4-semibold">Kegiatan Keorganisasian</h4>
        <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <x-form.add-input :label="'Aktif dalam Kegiatan'"  :name="'reqAktifKegiatan'" :placeholder="'Iya/Tidak'" />
            <x-form.add-input :label="'Ikut dalam kegiatan Koperasi'"  :name="'reqKoperasi'" :placeholder="'Iya/Tidak'" />
            <x-form.add-input :label="'Mengikuti Kelompok Belajar Jenis'"  :name="'reqKelompokBelajarJenis'" :placeholder="'Iya/Tidak'" />
            <x-form.add-input :label="'Mengikuti PAUD/Sejenis'"  :name="'reqPaud'" :placeholder="'Iya/Tidak'" />
            <x-form.add-input :label="'Mengikuti Program Bina Keluarga Balita'"  :name="'reqProgramBinaKeluargaBalita'" :placeholder="'Iya/Tidak'" />
        </form>
    </section>
</main>
@endsection