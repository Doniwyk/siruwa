@extends('layouts.admin')
@section('content')
<div class="header-edit flex-start gap-1">
    <a href="{{ route('admin.data-penduduk.index') }}">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z" fill="#225157" />
            </svg>
        </span>
    </a>
    <h1 class="h1-semibold">Detail Data Penduduk</h1>
</div>
<main class="bg-white sm:py-4 md:py-9 sm:px-6 md:px-24 rounded-2xl flex flex-col gap-9">
    <section id="identitas-kependudukan" class="">
        <h4 class="h4-semibold">Identitas Kependudukan</h4>
        <form action="" class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <x-form.show-input-form :label="'Nama'" :name="'reqNama'" :value="$resident->nama" />
            <x-form.show-input-form :label="'No. KK'" :name="'reqRegistrasi'" :value="$resident->nomor_kk" />
            <x-form.show-input-form :label="'No. KTP/NIK'" :name="'reqKtp'" :value="$resident->nik" />
            <x-form.show-input-form :label="'Alamat Lengkap'" :name="'reqAlamat'" :value="$resident->alamat" />
            <x-form.show-input-form :label="'RT'" :name="'rt'" :value="$resident->rt" />
        </form>
    </section>
    <section id="identitas-lengkap">
        <h4 class="h4-semibold">Identitas Lengkap</h4>
        <form action="" class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <x-form.show-input-form :label="'Tempat Lahir'" :name="'reqTempatLahir'" :value="$resident->tempat_lahir" />
            <x-form.show-input-form :label="'Tanggal Lahir'" :name="'tanggalLahir'" :value="$resident->tgl_lahir" />
            <x-form.show-input-form :label="'Jenis Kelamin'" :name="'reqJenisKelamin'" :value="$resident->jenis_kelamin" />
            <x-form.show-input-form :label="'Agama'" :name="'reqAgama'" :value="$resident->agama" />
            <x-form.show-input-form :label="'Pendidikan'" :name="'reqPendidikan'" :value="$resident->pendidikan" />
            <x-form.show-input-form :label="'Pekerjaan'" :name="'reqPekerjaan'" :value="$resident->pekerjaan" />
            <x-form.show-input-form :label="'Status Perkawinan'" :name="'reqStatusPerkawinan'" :value="$resident->status_kawin" />
            <x-form.show-input-form :label="'Status dalam Keluarga'" :name="'reqStatusDalamKeluarga'" :value="$resident->status_keluarga" />
            <x-form.show-input-form :label="'Akseptor KB'" :name="'akseptorKB'" :value="(boolean) $resident->akseptor_kb"  />
            <x-form.show-input-form :label="'Jenis Akseptor'" :name="'jenisAkseptor'" :value="$resident->jenis_akseptor" />
            <x-form.show-input-form :label="'Memiliki Tabungan'" :name="'reqMemilikiTabungan'" :value="(boolean) $resident->has_tabungan"  />
        </form>
    </section>
    <section id="kegiatan-keorganisasian">
        <h4 class="h4-semibold">Kegiatan Keorganisasian</h4>
        <form action="" class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <x-form.show-input-form :label="'Aktif dalam Kegiatan Posyandu'" :name="'reqAktifKegiatan'" :value="(boolean) $resident->aktif_posyandu"  />
            <x-form.show-input-form :label="'Ikut dalam kegiatan Koperasi'" :name="'reqKoperasi'" :value="(boolean) $resident->ikut_koperasi"  />
            <x-form.show-input-form :label="'Mengikuti Kelompok Belajar'" :name="'reqKelompokBelajarJenis'" :value="(boolean) $resident->ikut_kel_belajar"  />
            <x-form.show-input-form :label="'Jenis Kelompok Belajar yang Diikuti'" :name="'reqKelompokBelajarJenis'" :value="$resident->jenis_kel_belajar" />
            <x-form.show-input-form :label="'Mengikuti PAUD/Sejenis'" :name="'reqPaud'" :value="(boolean) $resident->ikut_paud"  />
            <x-form.show-input-form :label="'Mengikuti Program Bina Keluarga Balita'" :name="'reqProgramBinaKeluargaBalita'" :value="(boolean) $resident->has_BKB"  />
        </form>
    </section>
    <section id="informasi-keuangan-pribadi">
        <h4 class="h4-semibold">Informasi Keuangan Pribadi</h4>
        <form action="" class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <x-form.show-input-form :label="'Gaji Perbulan'" :name="'gaji'" :value="$resident->gaji * 1000" />
            <x-form.show-input-form :label="'Total Pajak Kendaraan'" :name="'jumlah_kendaraan_bermotor'" :value="$resident->total_pajak_kendaraan * 1000" />
            <x-form.show-input-form :label="'Biaya Pajak Bumi dan Bangunan'" :name="'pajak_bumi'" :value="$resident->pajak_bumi * 1000" />
            <x-form.show-input-form :label="'Biaya Listrik Perbulan'" :name="'biaya_listrik'" :value="$resident->biaya_listrik * 1000" />
            <x-form.show-input-form :label="'Biaya Air Perbulan'" :name="'biaya_air'" :value="$resident->biaya_air * 1000" />
        </form>
    </section>
    <div class="flex flex-end">
        <form action="{{ route('admin.data-penduduk.delete', ['resident' => $resident->id_penduduk]) }}" method="POST" class="flex justify-center items-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-stone-50 font-semibold px-3 py-3 rounded-2xl">
                Hapus Data Penduduk
            </button>
        </form>
    </div>
</main>
@endsection