@extends('layouts.admin')
@section('title')
    Form Tambah Penduduk
@endsection
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
        <h1 class="h1-semibold">Tambah Data Penduduk</h1>
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
        <form action="{{ route('admin.data-penduduk.store') }}" method="POST"
            class="bg-white py-9 px-24 rounded-2xl flex flex-col gap-9">
            @csrf
            @method('POST')
            <section id="identitas-kependudukan" class="">
                <h4 class="h4-semibold">Identitas Kependudukan</h4>
                <div class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                    <x-form.text-input-form label="Nama" name="nama" />
                    <x-form.text-input-form label="No. KK" name="nomor_kk" />
                    <x-form.text-input-form label="No. KTP/NIK" name="nik" />
                    <x-form.text-input-form label="Alamat Lengkap" name="alamat" />
                    <x-form.text-input-form label="RT" name="rt" />
                </div>
            </section>
            <section id="identitas-lengkap">
                <h4 class="h4-semibold">Identitas Lengkap</h4>
                <div class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                    <x-form.text-input-form label="Tempat Lahir" name="tempat_lahir" />
                    <x-form.text-input-form type="date" label="Tanggal Lahir" name="tgl_lahir" />
                    <x-form.select-input-form label="Jenis Kelamin" name="jenis_kelamin">
                        <option value="">Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Agama" name="agama">
                        <option value="">Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Khatolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Kepercayaan Lain">Kepercayaan Lain</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Pendidikan" name="pendidikan">
                        <option value="">Pendidikan</option>
                        <option value="Tidak Tamat SD">Tidak sekolah/Tamat SD</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Sarjana">Sarjana</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Pekerjaan" name="pekerjaan">
                        <option value="">Pekerjaan</option>
                        <option value="PNS">PNS</option>
                        <option value="TNI/POLRI">TNI/POLRI</option>
                        <option value="Wirausaha">Wirausaha</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Status Perkawinan" name="status_kawin">
                        <option value="">Status Perkawinan</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Status dalam Keluarga" name="status_keluarga">
                        <option value="">Status dalam Keluarga</option>
                        <option value="Kepala Keluarga">Kepala Keluarga</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Akseptor KB" name="akseptor_kb">
                        <option value="">Akseptor KB</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-form.select-input-form>
                    <x-form.text-input-form label="Jenis Akseptor" name="jenis_akseptor" />
                    <x-form.text-input-form label="Email" name="email" />
                    <x-form.text-input-form label="No. Telepon" name="noHp" />
                    <x-form.select-input-form label="Memiliki Tabungan" name="has_tabungan">
                        <option value="">Memiliki Tabungan</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-form.select-input-form>
                </div>
            </section>
            <section id="kegiatan-keorganisasian">
                <h4 class="h4-semibold">Kegiatan Keorganisasian</h4>
                <div class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                    <x-form.select-input-form label="Keaktifan dalam Kegiatan Posyandu" name="aktif_posyandu">
                        <option value="">Keaktifan dalam Kegiatan Posyandu</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Ikut dalam Kegiatan Koperasi" name="ikut_koperasi">
                        <option value="">Ikut dalam Keiaatan Koperasi</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Ikut Dalam Kelompok Belajar" name="ikut_kel_belajar">
                        <option value="">Ikut Dalam Kelompok Belajar</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-form.select-input-form>
                    <x-form.text-input-form label="Jenis Kelompok Belajar yang Diikuti" name="jenis_kel_belajar" />
                    <x-form.select-input-form label="Mengikuti PAUD/Sejenis" name="ikut_paud">
                        <option value="">Mengikuti PAUD/Sejenis</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-form.select-input-form>
                    <x-form.select-input-form label="Mengikuti Program Bina Keluarga Balita" name="has_BKB">
                        <option value="">Mengikuti Program Bina Keluarga Balita</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-form.select-input-form>
                </div>
            </section>
            <section id="informasi-keuangan-pribadi">
                <h4 class="h4-semibold">Informasi Keuangan Pribadi</h4>
                <div class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                    <x-form.text-input-form label="Gaji Perbulan" name="gaji" />
                    <x-form.text-input-form label="Total Pajak Kendaraan" name="total_pajak_kendaraan" />
                    <x-form.text-input-form label="Biaya Pajak Bumi dan Bangunan" name="pajak_bumi" />
                    <x-form.text-input-form label="Biaya Listrik Perbulan" name="biaya_listrik" />
                    <x-form.text-input-form label="Biaya Air Perbulan" name="biaya_air" />
                    <x-form.text-input-form label="Tanggungan" name="jumlah_tanggungan" />
                </div>
            </section>
            <section class="flex justify-end gap-x-6">
                <button type="button" class="py-3 px-10 w-60 font-semibold text-main rounded-2xl border-2 border-main"
                    onclick="window.location='{{ route('admin.data-penduduk.index') }}'">Batalkan</button>
                <button type="submit" class="py-3 px-10 w-60 bg-main font-semibold text-white rounded-2xl">Simpan
                    Data</button>
            </section>
        </form>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.data-penduduk.store') }}",
                    data: $(this).serialize(),
                    success: function(response) {

                    },
                    error: function(response) {
                        console.log(response);
                        const {errors} = response.responseJSON
                        $.each(errors, function(key, value) {
                            $('#error-' + key).text(value[0]);
                        });
                    }
                });
            });
        });
    </script>
@endsection
