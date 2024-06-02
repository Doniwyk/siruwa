@extends('layouts.admin')
@section('content')
{{-- @dd($reqResident->umur()) --}}
<div class="header-edit flex-start gap-1">
    <a href="{{ route('admin.data-penduduk.index', ['typeDocument' => 'pengajuan']) }}">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z" fill="#225157" />
            </svg>
        </span>
    </a>
    <h1 class="h1-semibold">Edit Data Penduduk</h1>
</div>
<main class="bg-white py-9 px-24 rounded-2xl ">
    <form action="{{ route('admin.data-penduduk.validate', ['resident' => $reqResident->id_temporary]) }}" method="POST" class="flex flex-col gap-9">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $reqResident->id_temporary }}" />
        <fieldset id="identitas-kependudukan" class="">
            <h4 class="h4-semibold">Identitas Kependudukan</h4>
            <div action="" class="grid grid-rows-2 grid-flow-col gap-x-9 gap-y-5">
                <x-form.disabled-input :label="'Nama'" :prevName="'prevNama'" :reqName="'reqNama'" :prevValue="$resident->nama" :reqValue="$reqResident->nama" />
                <x-form.disabled-input :label="'No. KTP/NIK'" :prevName="'prevKtp'" :reqName="'reqKtp'" :prevValue="$resident->nik" :reqValue="$reqResident->nik" />
                <x-form.disabled-input :label="'No. Registrasi'" :prevName="'prevRegistrasi'" :reqName="'reqRegistrasi'" :prevValue="$reqResident->id_temporary" :reqValue="$reqResident->id_temporary" />
                <x-form.disabled-input :label="'Alamat Lengkap'" :prevName="'prevAlamat'" :reqName="'reqAlamat'" :prevValue="$resident->alamat" :reqValue="$reqResident->alamat" />
            </div>
        </fieldset>
        <fieldset id="identitas-lengkap">
            <h4 class="h4-semibold">Identitas Lengkap</h4>
            <div action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.disabled-input :label="'Pekerjaan dan Jabatan'" :prevName="'prevPekerjaan'" :reqName="'reqPekerjaan'" :prevValue="$resident->pekerjaan" :reqValue="$reqResident->pekerjaan" />
                <x-form.disabled-input :label="'Tempat Lahir / Umur'" :prevName="'prevTempatLahir'" :reqName="'reqTempatLahir'" :prevValue="$resident->tempat_lahir . ' / ' . $reqResident->umur()" :reqValue="$reqResident->tempat_lahir . ' / ' . $reqResident->umur()" />
                <x-form.disabled-input :label="'Jenis Kelamin'" :prevName="'prevJenisKelamin'" :reqName="'reqJenisKelamin'" :prevValue="$resident->jenis_kelamin" :reqValue="$reqResident->jenis_kelamin" />
                <x-form.disabled-input :label="'Agama'" :prevName="'prevAgama'" :reqName="'reqAgama'" :prevValue="$resident->agama" :reqValue="$reqResident->agama" />
                <x-form.disabled-input :label="'Pendidikan'" :prevName="'prevPendidikan'" :reqName="'reqPendidikan'" :prevValue="$resident->pendidikan" :reqValue="$reqResident->pendidikan" />
                <x-form.disabled-input :label="'Status Perkawinan'" :prevName="'prevStatusPerkawinan'" :reqName="'reqStatusPerkawinan'" :prevValue="$resident->status_kawin" :reqValue="$reqResident->status_kawin" />
                <x-form.disabled-input :label="'Status dalam Keluarga'" :prevName="'prevStatusDalamKeluarga'" :reqName="'reqStatusDalamKeluarga'" :prevValue="$resident->status_keluarga" :reqValue="$reqResident->status_keluarga" />
                <x-form.disabled-input :label="'Memiliki Tabungan'" :prevName="'prevMemilikiTabungan'" :reqName="'reqMemilikiTabungan'" :prevValue="(boolean) $resident->has_tabungan" :reqValue="(boolean) $reqResident->has_tabungan" />
            </div>
        </fieldset>
        <fieldset id="kegiatan-keorganisasian">
            <h4 class="h4-semibold">Kegiatan Keorganisasian</h4>
            <div action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.disabled-input :label="'Aktif dalam Kegiatan'" :prevName="'prevAktifKegiatan'" :reqName="'reqAktifKegiatan'" :prevValue="(boolean) $resident->aktif_kegiatan" :reqValue="(boolean) $reqResident->aktif_kegiatan" />
                <x-form.disabled-input :label="'Ikut dalam kegiatan Koperasi'" :prevName="'prevKoperasi'" :reqName="'reqKoperasi'" :prevValue="(boolean) $resident->ikut_koperasi" :reqValue="(boolean) $reqResident->ikut_koperasi" />
                <x-form.disabled-input :label="'Mengikuti Kelompok Belajar Jenis'" :prevName="'prevKelompokBelajarJenis'" :reqName="'reqKelompokBelajarJenis'" :prevValue="(boolean) $resident->ikut_kel_belajar" :reqValue="(boolean) $reqResident->ikut_kel_belajar" />
                <x-form.disabled-input :label="'Mengikuti PAUD/Sejenis'" :prevName="'prevPaud'" :reqName="'reqPaud'" :prevValue="(boolean) $resident->ikut_paud" :reqValue="(boolean) $reqResident->ikut_paud" />
                <x-form.disabled-input :label="'Mengikuti Program Bina Keluarga Balita'" :prevName="'prevProgramBinaKeluargaBalita'" :reqName="'reqProgramBinaKeluargaBalita'" :prevValue="(boolean) $resident->has_BKB" :reqValue="(boolean) $reqResident->has_BKB" />
            </div>
        </fieldset>
        <section id="informasi-keuangan-pribadi">
            <h4 class="h4-semibold">Informasi Keuangan Pribadi</h4>
            <div action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.disabled-input :label="'Gaji Perbulan'"  :prevName="'prevGajiPerbulan'" :reqName="'reqGajiPerbulan'" :prevValue="(double) $resident->gaji * 1000" :reqValue="(double) $reqResident->gaji * 1000" />
                <x-form.disabled-input :label="'Total Pajak Kendaraan'"  :prevName="'prevPajakKendaraan'" :reqName="'reqPajakKendaraan'" :prevValue="(double) $resident->total_pajak_kendaraan * 1000" :reqValue="(double) $reqResident->ikut_kel_belajar * 1000" />
                <x-form.disabled-input :label="'Biaya Pajak Bumi dan Bangunan'"  :prevName="'prevBPB'" :reqName="'reqBPB'" :prevValue="(double) $resident->pajak_bumi * 1000" :reqValue="(double) $reqResident->pajak_bumi * 1000" />
                <x-form.disabled-input :label="'Biaya Listrik Perbulan'"  :prevName="'prevListrik'" :reqName="'reqListrik'" :prevValue="(double) $resident->biaya_listrik * 1000" :reqValue="(double) $reqResident->biaya_listrik * 1000" />
                <x-form.disabled-input :label="'Biaya Air Perbulan'"  :prevName="'prevBiayaAir'" :reqName="'reqBiayaAir'" :prevValue="(double) $resident->biaya_air * 1000" :reqValue="(double) $reqResident->biaya_air * 1000" />
            </div>
        </section>

        <fieldset class="flex-end col-span-2 gap-6 text-white font-semibold">
            <button type="submit" class="px-24 py-3 rounded-2xl bg-red-600" name="action" value="reject">Tolak</button>
            <button type="submit" class="px-24 py-3 rounded-2xl bg-main" name="action" value="accept">Terima</button>
        </fieldset>
    </form>
</main>
@endsection