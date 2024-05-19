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
    <h1 class="h1-semibold">Edit Data Penduduk</h1>
</div>
<main class="bg-white py-9 px-24 rounded-2xl flex flex-col gap-9">
    <section id="identitas-kependudukan" class="">
        <h4 class="h4-semibold">Identitas Kependudukan</h4>
        <form action="" class="grid grid-rows-2 grid-flow-col gap-x-9 gap-y-5">
            <x-form.input-form_-show :label="'Nama'"  :name="'reqNama'" :value="$resident->nama"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'No. KTP/NIK'"  :name="'reqKtp'" :value="$resident->nik"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'No. Registrasi'"  :name="'reqRegistrasi'" :value="$resident->no_reg"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Alamat Lengkap'"  :name="'reqAlamat'" :value="$resident->alamat"
                :reqValue="' '" />
        </form>
    </section>
    <section id="identitas-lengkap">
        <h4 class="h4-semibold">Identitas Lengkap</h4>
        <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <x-form.input-form_-show :label="'Pekerjaan dan Jabatan'"  :name="'reqPekerjaan'" :value="$resident->pekerjaan"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Tempat Lahir / Umur'"  :name="'reqTempatLahir'" :value="$resident->tempat_lahir . ' / ' . $resident->umur"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Jenis Kelamin'"  :name="'reqJenisKelamin'" :value="$resident->jenis_kelamin"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Agama'"  :name="'reqAgama'" :value="$resident->agama"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Pendidikan'"  :name="'reqPendidikan'" :value="$resident->pendidikan"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Status Perkawinan'"  :name="'reqStatusPerkawinan'" :value="$resident->status_kawin"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Status dalam Keluarga'"  :name="'reqStatusDalamKeluarga'" :value="$resident->status_keluarga"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Memiliki Tabungan'"  :name="'reqMemilikiTabungan'" :value="$resident->has_tabungan"
                :reqValue="' '" />
        </form>
    </section>
    <section id="kegiatan-keorganisasian">
        <h4 class="h4-semibold">Kegiatan Keorganisasian</h4>
        <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <x-form.input-form_-show :label="'Aktif dalam Kegiatan'"  :name="'reqAktifKegiatan'" :value="$resident->aktif_kegiatan"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Ikut dalam kegiatan Koperasi'"  :name="'reqKoperasi'" :value="$resident->ikut_koperasi"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Mengikuti Kelompok Belajar Jenis'"  :name="'reqKelompokBelajarJenis'" :value="$resident->ikut_kel_belajar"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Mengikuti PAUD/Sejenis'"  :name="'reqPaud'" :value="$resident->ikut_paud"
                :reqValue="' '" />
            <x-form.input-form_-show :label="'Mengikuti Program Bina Keluarga Balita'"  :name="'reqProgramBinaKeluargaBalita'" :value="$resident->has_BKB"
                :reqValue="' '" />
        </form>
    </section>
</main>
@endsection
