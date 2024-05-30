@extends('layouts.user')
@section('content-user')

<div class="header-edit flex-start gap-19">
    <a href="{{ route('resident.data-dasawisma.index') }}" class="mb-9">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z" fill="#225157" />
            </svg>
        </span>
    </a>
    <h1 class="resident-header">{{ $title }}</h1>
</div>

<main>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="{{ route('resident.data-dasawisma.store', ['resident' => $resident->id_penduduk]) }}" method="POST" class="bg-white py-9 px-24 rounded-2xl flex flex-col gap-9">
        @csrf
        @method('POST')
        <section id="identitas-kependudukan" class="">
            <h4 class="h4-semibold">Identitas Kependudukan</h4>
            <div class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.show-input-form :label="'No. KTP/NIK'"  :name="'reqKtp'" :value="$resident->nik" />
                <x-form.show-input-form :label="'No. KK'"  :name="'reqRegistrasi'" :value="$resident->nomor_kk" />
                <x-form.text-input-form label="Nama" name="nama"  value="{{ $resident->nama }}" />
                <x-form.text-input-form label="Alamat Lengkap" name="alamat" value="{{ $resident->alamat }}" />
                <x-form.text-input-form label="RT" name="rt" value="{{ $resident->rt }}" />
            </div>
        </section>
        <section id="identitas-lengkap">
            <h4 class="h4-semibold">Identitas Lengkap</h4>
            <div class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.text-input-form label="Tempat Lahir" name="tempat_lahir" value="{{ $resident->tempat_lahir }}" />
                <x-form.text-input-form type="date" label="Tanggal Lahir" name="tgl_lahir" value="{{ $resident->tgl_lahir }}" />
                <x-form.select-input-form label="Jenis Kelamin" name="jenis_kelamin">
                    <option value="">Jenis Kelamin</option>
                    <option value="L" {{ $resident->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $resident->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Agama" name="agama">
                    <option value="">Agama</option>
                    <option value="Islam" {{ $resident->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $resident->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ $resident->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ $resident->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ $resident->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ $resident->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    <option value="Kepercayaan Lain" {{ $resident->agama == 'Kepercayaan Lain' ? 'selected' : '' }}>Kepercayaan Lain</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Pendidikan" name="pendidikan">
                    <option value="">Pendidikan</option>
                    <option value="Tidak Tamat SD" {{ $resident->pendidikan == 'Tidak Tamat SD' ? 'selected' : '' }}>Tidak sekolah/Tamat SD</option>
                    <option value="SD" {{ $resident->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ $resident->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ $resident->pendidikan == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="Diploma" {{ $resident->pendidikan == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                    <option value="Sarjana" {{ $resident->pendidikan == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Pekerjaan" name="pekerjaan">
                    <option value="">Pekerjaan</option>
                    <option value="PNS" {{ $resident->pekerjaan == 'PNS' ? 'selected' : '' }}>PNS</option>
                    <option value="TNI/POLRI" {{ $resident->pekerjaan == 'TNI/POLRI' ? 'selected' : '' }}>TNI/POLRI</option>
                    <option value="Wirausaha" {{ $resident->pekerjaan == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                    <option value="Wiraswasta" {{ $resident->pekerjaan == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                    <option value="Pelajar/Mahasiswa" {{ $resident->pekerjaan == 'Pelajar/Mahasiswa' ? 'selected' : '' }}>Pelajar/Mahasiswa</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Status Perkawinan" name="status_kawin">
                    <option value="">Status Perkawinan</option>
                    <option value="Belum Menikah" {{ $resident->status_kawin == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                    <option value="Menikah" {{ $resident->status_kawin == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="Cerai Hidup" {{ $resident->status_kawin == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ $resident->status_kawin == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Status dalam Keluarga" name="status_keluarga">
                    <option value="">Status dalam Keluarga</option>
                    <option value="Kepala Keluarga" {{ $resident->status_keluarga == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                    <option value="Istri" {{ $resident->status_keluarga == 'Istri' ? 'selected' : '' }}>Istri</option>
                    <option value="Anak" {{ $resident->status_keluarga == 'Anak' ? 'selected' : '' }}>Anak</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Akseptor KB" name="akseptor_kb">
                    <option value="">Akseptor KB</option>
                    <option value="1" {{ $resident->akseptor_kb == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $resident->akseptor_kb == '0' ? 'selected' : '' }}>Tidak</option>
                </x-form.select-input-form>
                <x-form.text-input-form label="Jenis Akseptor" name="jenis_akseptor" value="{{ $resident->jenis_akseptor }}" />
                <x-form.select-input-form label="Memiliki Tabungan" name="has_tabungan">
                    <option value="">Memiliki Tabungan</option>
                    <option value="1" {{ $resident->has_tabungan == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $resident->has_tabungan == '0' ? 'selected' : '' }}>Tidak</option>
                </x-form.select-input-form>
            </div>
        </section>
        <section id="kegiatan-keorganisasian">
            <h4 class="h4-semibold">Kegiatan Keorganisasian</h4>
            <div class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.select-input-form label="Keaktifan dalam Kegiatan Posyandu" name="aktif_posyandu">
                    <option value="">Keaktifan dalam Kegiatan Posyandu</option>
                    <option value="1" {{ $resident->aktif_posyandu == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $resident->aktif_posyandu == '0' ? 'selected' : '' }}>Tidak</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Ikut dalam Kegiatan Koperasi" name="ikut_koperasi">
                    <option value="">Ikut dalam Kegiatan Koperasi</option>
                    <option value="1" {{ $resident->ikut_koperasi == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $resident->ikut_koperasi == '0' ? 'selected' : '' }}>Tidak</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Ikut Dalam Kelompok Belajar" name="ikut_koperasi">
                    <option value="">Ikut Dalam Kelompok Belajar</option>
                    <option value="1" {{ $resident->ikut_koperasi == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $resident->ikut_koperasi == '0' ? 'selected' : '' }}>Tidak</option>
                </x-form.select-input-form>
                <x-form.text-input-form label="Jenis Kelompok Belajar yang Diikuti" name="jenis_kel_belajar" value="{{ $resident->jenis_kel_belajar }}" />
                <x-form.select-input-form label="Mengikuti PAUD/Sejenis" name="ikut_paud">
                    <option value="">Mengikuti PAUD/Sejenis</option>
                    <option value="1" {{ $resident->ikut_paud == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $resident->ikut_paud == '0' ? 'selected' : '' }}>Tidak</option>
                </x-form.select-input-form>
                <x-form.select-input-form label="Mengikuti Program Bina Keluarga Balita" name="has_BKB">
                    <option value="">Mengikuti Program Bina Keluarga Balita</option>
                    <option value="1" {{ $resident->has_BKB == '1' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ $resident->has_BKB == '0' ? 'selected' : '' }}>Tidak</option>
                </x-form.select-input-form>
            </div>
        </section>
        <section id="informasi-keuangan-pribadi">
            <h4 class="h4-semibold">Informasi Keuangan Pribadi</h4>
            <div class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.text-input-form label="Gaji Perbulan" name="gaji" value="{{ $resident->gaji }}" />
                <x-form.text-input-form label="Jumlah Kendaraan" name="jumlah_kendaraan_bermotor" value="{{ $resident->jumlah_kendaraan_bermotor }}" />
                <x-form.text-input-form label="Biaya Pajak Bumi dan Bangunan" name="pajak_bumi" value="{{ $resident->pajak_bumi }}" />
                <x-form.text-input-form label="Biaya Listrik Perbulan" name="biaya_listrik" value="{{ $resident->biaya_listrik }}" />
                <x-form.text-input-form label="Biaya Air Perbulan" name="biaya_air" value="{{ $resident->biaya_air }}" />
            </div>
        </section>
        <section class="flex justify-end gap-x-6">
            <a type="button" class="btn-secondary" href="{{ route('resident.data-dasawisma.index') }}">Batalkan</a>
            <button type="submit" class="btn-main">Simpan Data</button>
        </section>
    </form>
</main>
@endsection