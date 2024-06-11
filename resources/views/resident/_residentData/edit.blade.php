@extends('layouts.user')
@section('title')
Edit Data Penduduk
@endsection
@section('content-user')

<div class="flex items-center gap-1">
    <a href="{{ route('resident.data-dasawisma.index') }}">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z" fill="#225157" />
            </svg>
        </span>
    </a>
    <span class="resident-header">Edit Data Penduduk</span>
</div>

<main x-data="{ showModal: false }">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form id="residentForm" action="{{ route('resident.data-dasawisma.store', ['resident' => $resident->id_penduduk]) }}" method="POST" class="bg-white sm:py-4 md:py-9 sm:px-6 md:px-24 rounded-2xl flex flex-col gap-9">
        @csrf
        @method('POST')
        <section id="identitas-kependudukan" class="">
            <h4 class="h4-semibold flex items-center">
                Identitas Kependudukan
                <div class="flex-1 h-[2px] bg-secondary ml-2 rounded"></div>
            </h4>
            <div class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.show-input-form :label="'No. KTP/NIK'"  :name="'reqKtp'" :value="$resident->nik" />
                <x-form.show-input-form :label="'No. KK'"  :name="'reqRegistrasi'" :value="$resident->nomor_kk" />
                <x-form.text-input-form label="Nama" name="nama"  value="{{ $resident->nama }}" />
                <x-form.text-input-form label="Alamat Lengkap" name="alamat" value="{{ $resident->alamat }}" />
                <x-form.text-input-form label="RT" name="rt" value="{{ $resident->rt }}" />
            </div>
        </section>
        <section id="identitas-lengkap">
            <h4 class="h4-semibold flex items-center">
                Identitas Lengkap
                <div class="flex-1 h-[2px] bg-secondary ml-2 rounded"></div>
            </h4>
            <div class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.text-input-form label="Tempat Lahir" name="tempat_lahir" value="{{ $resident->tempat_lahir }}" />
                <x-form.text-input-form type="date" label="Tanggal Lahir" name="tgl_lahir" value="{{ $resident->tgl_lahir }}" />
                <x-form.select-input-form label="Jenis Kelamin" name="jenis_kelamin">
                    <option value="">Jenis Kelamin</option>
                    <option value="Laki-laki" {{ $resident->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $resident->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                    <option value="Tidak Bekerja" {{ $resident->pekerjaan == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
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
            <h4 class="h4-semibold flex items-center">
                Kegiatan Keorganisasian
                <div class="flex-1 h-[2px] bg-secondary ml-2 rounded"></div>
            </h4>
            <div class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
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
            <h4 class="h4-semibold flex items-center">
                Informasi Keuangan Pribadi
                <div class="flex-1 h-[2px] bg-secondary ml-2 rounded"></div>
            </h4>
            <div class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.text-input-form label="Gaji Perbulan" name="gaji" value="{{ $resident->gaji }}" />
                <x-form.text-input-form label="Jumlah Tanggungan" name="jumlah_tanggungan" value="{{ $resident->jumlah_tanggungan }}" />
                <x-form.text-input-form label="Total Pajak Kendaraan" name="total_pajak_kendaraan" value="{{ $resident->total_pajak_kendaraan }}" />
                <x-form.text-input-form label="Biaya Pajak Bumi dan Bangunan" name="pajak_bumi" value="{{ $resident->pajak_bumi }}" />
                <x-form.text-input-form label="Biaya Listrik Perbulan" name="biaya_listrik" value="{{ $resident->biaya_listrik }}" />
                <x-form.text-input-form label="Biaya Air Perbulan" name="biaya_air" value="{{ $resident->biaya_air }}" />
            </div>
        </section>
        <section class="flex justify-end gap-x-6">
            <button type="button" class="btn-main button-hover" x-on:click="showModal = true">Ajukan Perubahan</button>
        </section>
    </form>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-10">
        <div class="flex flex-col bg-white rounded-2xl p-10 gap-9" id="document-modal" x-cloak>  
            <div class="flex flex-col justify-center items-center gap-4">
                <svg width="54" height="55" viewBox="0 0 54 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M38.173 0.833313H15.8263C6.11967 0.833313 0.333008 6.61998 0.333008 16.3266V38.6733C0.333008 48.38 6.11967 54.1666 15.8263 54.1666H38.173C47.8797 54.1666 53.6663 48.38 53.6663 38.6733V16.3266C53.6663 6.61998 47.8797 0.833313 38.173 0.833313ZM21.5863 35.2333L15.5863 41.2333C15.1863 41.6333 14.6797 41.82 14.173 41.82C13.6663 41.82 13.133 41.6333 12.7597 41.2333L10.7597 39.2333C9.95967 38.46 9.95967 37.18 10.7597 36.4066C11.533 35.6333 12.7863 35.6333 13.5863 36.4066L14.173 36.9933L18.7597 32.4066C19.533 31.6333 20.7863 31.6333 21.5863 32.4066C22.3597 33.18 22.3597 34.46 21.5863 35.2333ZM21.5863 16.5666L15.5863 22.5666C15.1863 22.9666 14.6797 23.1533 14.173 23.1533C13.6663 23.1533 13.133 22.9666 12.7597 22.5666L10.7597 20.5666C9.95967 19.7933 9.95967 18.5133 10.7597 17.74C11.533 16.9666 12.7863 16.9666 13.5863 17.74L14.173 18.3266L18.7597 13.74C19.533 12.9666 20.7863 12.9666 21.5863 13.74C22.3597 14.5133 22.3597 15.7933 21.5863 16.5666ZM41.8263 39.82H27.8263C26.733 39.82 25.8263 38.9133 25.8263 37.82C25.8263 36.7266 26.733 35.82 27.8263 35.82H41.8263C42.9463 35.82 43.8263 36.7266 43.8263 37.82C43.8263 38.9133 42.9463 39.82 41.8263 39.82ZM41.8263 21.1533H27.8263C26.733 21.1533 25.8263 20.2466 25.8263 19.1533C25.8263 18.06 26.733 17.1533 27.8263 17.1533H41.8263C42.9463 17.1533 43.8263 18.06 43.8263 19.1533C43.8263 20.2466 42.9463 21.1533 41.8263 21.1533Z" fill="#225157"/>
                </svg>
                
                <div class="flex flex-col items-center justify-center gap-4">
                    <div class="text-xl font-semibold text-secondary">
                        Apakah data yang dimasukkan sudah benar?
                    </div>
                </div>          
            </div>      
            <div class="flex justify-center gap-5">
                <button type="button" class="w-52 py-2 bg-secondary text-stone-50 font-semibold rounded-2xl flex justify-center items-center button-hover" x-on:click="showModal = false">
                    Periksa Lagi
                </button>
                <button type="button" class="w-52 py-2 font-semibold text-secondary rounded-2xl border-2 border-secondary flex justify-center items-center button-hover" x-on:click="document.getElementById('residentForm').submit(); showModal = false;">
                    Benar
                </button>
            </div>
        </div>
    </div>
</main>
@endsection