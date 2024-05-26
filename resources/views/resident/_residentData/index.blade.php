@extends('layouts.user')
@section('content-user')

    <div class="resident-header">{{ $title }}</div>

    <!-- TAB -->
    <div x-data="{ openTab: localStorage.getItem('openTab') ? parseInt(localStorage.getItem('openTab')) : 1, showModal: false }">
        <div class="resident-tab-parent">
            <button x-on:click="openTab = 1; localStorage.setItem('openTab', 1)" :class="{ 'bg-secondary text-white': openTab === 1 }"
                class="resident-tab">Pengajuan</button>
            <button x-on:click="openTab = 2; localStorage.setItem('openTab', 2)" :class="{ 'bg-secondary text-white': openTab === 2 }"
                class="resident-tab">Riwayat</button>
        </div>

        <!-- TAB PENGAJUAN -->
        <div x-show="openTab === 1">
            <div class="bg-white py-9 px-16 rounded-2xl flex flex-col gap-9">
                <section id="identitas-kependudukan" class="">
                    <h4 class="h4-semibold">Identitas Kependudukan</h4>
                    <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                        <x-form.show-input-form :label="'No. KTP/NIK'"  :name="'reqKtp'" :value="$resident->nik" />
                        <x-form.show-input-form :label="'No. KK'"  :name="'reqRegistrasi'" :value="$resident->nomor_kk" />
                        <x-form.show-input-form :label="'Nama'"  :name="'reqNama'" :value="$resident->nama" />
                        <x-form.show-input-form :label="'Alamat Lengkap'"  :name="'reqAlamat'" :value="$resident->alamat" />
                        <x-form.show-input-form :label="'RT'"  :name="'rt'" :value="$resident->rt" />
                    </form>
                </section>
                <section id="identitas-lengkap">
                    <h4 class="h4-semibold">Identitas Lengkap</h4>
                    <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                        <x-form.show-input-form :label="'Tempat Lahir'"  :name="'reqTempatLahir'" :value="$resident->tempat_lahir" />
                        <x-form.show-input-form :label="'Tanggal Lahir'"  :name="'tanggalLahir'" :value="$resident->tgl_lahir" />
                        <x-form.show-input-form :label="'Jenis Kelamin'"  :name="'reqJenisKelamin'" :value="$resident->jenis_kelamin" />
                        <x-form.show-input-form :label="'Agama'"  :name="'reqAgama'" :value="$resident->agama" />
                        <x-form.show-input-form :label="'Pendidikan'"  :name="'reqPendidikan'" :value="$resident->pendidikan" />
                        <x-form.show-input-form :label="'Pekerjaan'"  :name="'reqPekerjaan'" :value="$resident->pekerjaan" />
                        <x-form.show-input-form :label="'Status Perkawinan'"  :name="'reqStatusPerkawinan'" :value="$resident->status_kawin" />
                        <x-form.show-input-form :label="'Status dalam Keluarga'"  :name="'reqStatusDalamKeluarga'" :value="$resident->status_keluarga" />
                        <x-form.show-input-form :label="'Akseptor KB'"  :name="'akseptorKB'" :value="$resident->akseptor_kb" :isBoolean="true" />
                        <x-form.show-input-form :label="'Jenis Akseptor'"  :name="'jenisAkseptor'" :value="$resident->jenis_akseptor" />
                        <x-form.show-input-form :label="'Memiliki Tabungan'"  :name="'reqMemilikiTabungan'" :value="$resident->has_tabungan" :isBoolean="true" />
                    </form>
                </section>
                <section id="kegiatan-keorganisasian">
                    <h4 class="h4-semibold">Kegiatan Keorganisasian</h4>
                    <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                        <x-form.show-input-form :label="'Aktif dalam Kegiatan Posyandu'"  :name="'reqAktifKegiatan'" :value="$resident->aktif_posyandu" :isBoolean="true" />
                        <x-form.show-input-form :label="'Ikut dalam kegiatan Koperasi'"  :name="'reqKoperasi'" :value="$resident->ikut_koperasi" :isBoolean="true" />
                        <x-form.show-input-form :label="'Mengikuti Kelompok Belajar'"  :name="'reqKelompokBelajarJenis'" :value="$resident->ikut_kel_belajar" :isBoolean="true" />
                        <x-form.show-input-form :label="'Jenis Kelompok Belajar yang Diikuti'"  :name="'reqKelompokBelajarJenis'" :value="$resident->jenis_kel_belajar" />
                        <x-form.show-input-form :label="'Mengikuti PAUD/Sejenis'"  :name="'reqPaud'" :value="$resident->ikut_paud" :isBoolean="true" />
                        <x-form.show-input-form :label="'Mengikuti Program Bina Keluarga Balita'"  :name="'reqProgramBinaKeluargaBalita'" :value="$resident->has_BKB" :isBoolean="true" />
                    </form>
                </section>
                <section id="informasi-keuangan-pribadi">
                    <h4 class="h4-semibold">Informasi Keuangan Pribadi</h4>
                    <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                        <x-form.show-input-form :label="'Gaji Perbulan'"  :name="'gaji'" :value="$resident->gaji" />
                        <x-form.show-input-form :label="'Jumlah Kendaraan'"  :name="'jumlah_kendaraan_bermotor'" :value="$resident->jumlah_kendaraan_bermotor" />
                        <x-form.show-input-form :label="'Biaya Pajak Bumi dan Bangunan'"  :name="'pajak_bumi'" :value="$resident->pajak_bumi" />
                        <x-form.show-input-form :label="'Biaya Listrik Perbulan'"  :name="'biaya_listrik'" :value="$resident->biaya_listrik" />
                        <x-form.show-input-form :label="'Biaya Air Perbulan'"  :name="'biaya_air'" :value="$resident->biaya_air" />
                    </form>
                </section>
                <section class="flex justify-end">
                    <a href="{{ route('resident.data-dasawisma.edit', $resident->id) }}" class="btn-main">Edit Data</a>
                </section>
            </div>
        </div>

    <!-- TAB RIWAYAT -->
        <div x-show="openTab === 2">
            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-left table-fixed">
                    <thead class="history-header">
                        <tr>
                            <th>Nama Pembayar</th>
                            <th>Tipe Berkas</th>
                            <th>Tgl. Pengajuan</th>
                            <th>Detail Status</th>
                        </tr>
                    </thead>
                    <tbody class="history-body">
                        <tr>
                            <td>Daffa Maulana Satria</td>
                            <td>Iuran Sampah</td>
                            <td>Rp. 900.000</td>
                            <td>Januari, 24 2024</td>
                        </tr>
                        <tr>
                            <td>Daffa Maulana Satria</td>
                            <td>Iuran Sampah</td>
                            <td>Rp. 900.000</td>
                            <td>Januari, 24 2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
