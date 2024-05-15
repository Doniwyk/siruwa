@extends('layouts.admin')
@section('content')
    <div class="header-edit flex-start gap-1">
        <a href="{{route('admin.data-penduduk.index')}}">
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
    <main class="bg-white py-9 px-24 rounded-2xl flex flex-col gap-5">
        <section id="identitas-kependudukan" class="">
            <h4 class="h4-semibold">Identitas Kependudukan</h4>
            <form action="" class="grid grid-rows-2 grid-flow-col gap-x-9 gap-y-5">
                <x-form.disabled-input :label="'Nama'" :prevName="'prevNama'" :reqName="'reqNama'" :prevValue="$resident->nama" :reqValue="' '"/>
                <x-form.disabled-input :label="'No. KTP/NIK'" :prevName="'prevKtp'" :reqName="'reqKtp'" :prevValue="$resident->nik" :reqValue="' '"/>
                <x-form.disabled-input :label="'No. Registrasi'" :prevName="'prevRegistrasi'" :reqName="'reqRegistrasi'" :prevValue="$resident->no_reg" :reqValue="' '"/>
                <x-form.disabled-input :label="'Alamat Lengkap'" :prevName="'prevAlamat'" :reqName="'reqAlamat'" :prevValue="$resident->alamat" :reqValue="' '"/>
            </form>
        </section>
        <section id="identitas-lengkap">
            <h4 class="h4-semibold">Identitas Lengkap</h4>
            <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.disabled-input :label="'Pekerjaan dan Jabatan'" :prevName="'prevPekerjaan'" :reqName="'reqPekerjaan'" :prevValue="$resident->pekerjaan" :reqValue="' '"/>
                <x-form.disabled-input :label="'Tempat Lahir / Umur'" :prevName="'prevTempatLahir'" :reqName="'reqTempatLahir'" :prevValue="$resident->tempat_lahir .' / ' . $resident->umur" :reqValue="' '"/>
                <x-form.disabled-input :label="'Jenis Kelamin'" :prevName="'prevJenisKelamin'" :reqName="'reqJenisKelamin'" :prevValue="$resident->jenis_kelamin" :reqValue="' '"/>
                <x-form.disabled-input :label="'Agama'" :prevName="'prevAgama'" :reqName="'reqAgama'" :prevValue="$resident->agama" :reqValue="' '"/>
                <x-form.disabled-input :label="'Pendidikan'" :prevName="'prevPendidikan'" :reqName="'reqPendidikan'" :prevValue="$resident->pendidikan" :reqValue="' '"/>
                <x-form.disabled-input :label="'Status Perkawinan'" :prevName="'prevStatusPerkawinan'" :reqName="'reqStatusPerkawinan'" :prevValue="$resident->status_kawin" :reqValue="' '"/>
                <x-form.disabled-input :label="'Status dalam Keluarga'" :prevName="'prevStatusDalamKeluarga'" :reqName="'reqStatusDalamKeluarga'" :prevValue="$resident->status_keluarga" :reqValue="' '"/>
                <x-form.disabled-input :label="'Memiliki Tabungan'" :prevName="'prevMemilikiTabungan'" :reqName="'reqMemilikiTabungan'" :prevValue="$resident->has_tabungan" :reqValue="' '"/>
            </form>
        </section>
        <section id="kegiatan-keorganisasian">
            <h4 class="h4-semibold">Kegiatan Keorganisasian</h4>
            <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.disabled-input :label="'Aktif dalam Kegiatan'" :prevName="'prevAktifKegiatan'" :reqName="'reqAktifKegiatan'" :prevValue="$resident->aktif_kegiatan" :reqValue="' '"/>
                <x-form.disabled-input :label="'Ikut dalam kegiatan Koperasi'" :prevName="'prevKoperasi'" :reqName="'reqKoperasi'" :prevValue="$resident->ikut_koperasi" :reqValue="' '"/>
                <x-form.disabled-input :label="'Mengikuti Kelompok Belajar Jenis'" :prevName="'prevKelompokBelajarJenis'" :reqName="'reqKelompokBelajarJenis'" :prevValue="$resident->ikut_kel_belajar" :reqValue="' '"/>
                <x-form.disabled-input :label="'Mengikuti PAUD/Sejenis'" :prevName="'prevPaud'" :reqName="'reqPaud'" :prevValue="$resident->ikut_paud" :reqValue="' '"/>
                <x-form.disabled-input :label="'Mengikuti Program Bina Keluarga Balita'" :prevName="'prevProgramBinaKeluargaBalita'" :reqName="'reqProgramBinaKeluargaBalita'" :prevValue="$resident->has_BKB" :reqValue="' '"/>
            </form>
        </section>
    </main>
@endsection
