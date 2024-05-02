@extends('layouts.user')
@section('content')
{{-- 
    TO-DO
    GANTI VALUE DARI TIAP TIAP DATA DARI DATABASE, JADI TIAP FIELD LANGSUNG KEISI DATA PENDUDUK
--}}
<body class="bg-[#F1F0E9] py-9 px-16">
    <div class="">
        <div x-data="{ openTab: 1 }" class="">
            <div>
                <div x-show="openTab === 1" class="mb-9 text-secondary text-4xl font-semibold font-['Anek Tamil']">Data Penduduk</div>
                <div x-show="openTab === 2" class="mb-9 text-secondary text-4xl font-semibold">Pengajuan Perubahan Data Penduduk</div>
                <div class="mb-9 flex space-x-4 p-2 bg-white rounded-2xl overflow-hidden max-w-sm">
                    <button x-on:click="openTab = 1" :class="{ 'bg-secondary text-white': openTab === 1 }" class="flex-1 py-2 px-4 rounded-xl text-secondary font-medium focus:font-semibold focus:outline-none focus:shadow-outline-blue transition-all duration-300">Pengajuan</button>
                    <button x-on:click="openTab = 2" :class="{ 'bg-secondary text-white': openTab === 2 }" class="flex-1 py-2 px-4 rounded-xl text-secondary font-medium focus:font-semibold focus:outline-none focus:shadow-outline-blue transition-all duration-300">Riwayat</button>
                </div>
            </div>
    
            <div class="transition duration-300 ease-in-out transform">
                <div x-show="openTab === 1" class="bg-white rounded-2xl py-9 px-16">
                    <form action="">
                        <div>
                            <div class="text-secondary text-base font-semibold">Identitas Kependudukan</div>                       
                            <div class="mt-5 grid gap-x-9 gap-y-5 grid-cols-2">
                                <div class="sm:col-span-1">
                                    <label for="nama" class="block text-base font-medium leading-6 text-cyan-900">Nama</label>
                                    <div class="mt-2">
                                        <input type="text" name="nama" id="nama" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Nama">
                                    </div>
                                </div>
                        
                                <div class="sm:col-span-1">
                                    <label for="nik" class="block text-base font-medium leading-6 text-cyan-900">No. KTP/NIK</label>
                                    <div class="mt-2">
                                        <input type="text" name="nik" id="nik" class="px-6 py-2 block w-full rounded-2xl border-0 text-slate-500 text-base font-medium bg-[#DDE9EA]" value="No. KTP/NIK" disabled>
                                    </div>
                                </div>
                        
                                <div class="sm:col-span-1">
                                    <label for="no_registrasi" class="block text-base font-medium leading-6 text-cyan-900">No. Registrasi</label>
                                    <div class="mt-2">
                                        <input type="text" id="no_registrasi" name="no_registrasi" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Nomor Registrasi">
                                    </div>
                                </div>
                
                                <div class="sm:col-span-1">
                                    <label for="alamat" class="block text-base font-medium leading-6 text-cyan-900">Alamat Lengkap</label>
                                    <div class="mt-2">
                                        <input type="text" id="alamat" name="alamat" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Alamat Lengkap">
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="mt-9">
                            <div class="text-secondary text-base font-semibold">Identitas Lengkap</div>                       
                            <div class="mt-5 grid gap-x-9 gap-y-5 grid-cols-2">
                                <div class="sm:col-span-1">
                                    <label for="pekerjaan" class="block text-base font-medium leading-6 text-cyan-900">Pekerjaan dan Jabatan</label>
                                    <div class="mt-2">
                                        <input type="text" name="pekerjaan" id="pekerjaan" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Pekerjaan dan Jabatan"">
                                    </div>
                                </div>
                        
                                <div class="sm:col-span-1">
                                    <label for="agama" class="block text-base font-medium leading-6 text-cyan-900">Agama</label>
                                    <div class="mt-2">
                                        <input type="text" id="agama" name="agama" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Agama"">
                                    </div>
                                </div>
            
                                <div class="sm:col-span-1">
                                    <label for="tempat_lahir" class="block text-base font-medium leading-6 text-cyan-900">Tempat Lahir</label>
                                    <div class="mt-2">
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Tempat Lahir">
                                    </div>
                                </div>
            
                                <div class="sm:col-span-1">
                                    <label for="tanggal_lahir" class="block text-base font-medium leading-6 text-cyan-900">Tanggal Lahir</label>
                                    <div class="mt-2">
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="2000-12-31">
                                    </div>
                                </div>
                
                                <div class="sm:col-span-1">
                                    <label for="pendidikan" class="block text-base font-medium leading-6 text-cyan-900">Pendidikan</label>
                                    <div class="mt-2">
                                        <input type="text" id="pendidikan" name="pendidikan" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Pendidikan"">
                                    </div>
                                </div>
            
                                <div class="sm:col-span-1">
                                    <label for="jk" class="block text-base font-medium leading-6 text-cyan-900">Jenis Kelamin</label>
                                    <div class="mt-2 relative">
                                        <select name="jk" id="jk" class="px-6 py-2 block w-full rounded-2xl border-0 h-10 shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none appearance-none">
                                            {{-- 
                                                NTAR NGAMBIL LANGSUNG DARI DATABASE CONTOH:
                                                <option value="L" <?php if ($initialValue == 'L') echo 'selected'; ?>>Laki-laki ♂</option>
                                                <option value="P" <?php if ($initialValue == 'P') echo 'selected'; ?>>Perempuan ♀</option>
                                            --}}
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                                            <img src="{{ asset('..\assets\icons\arrow-up.svg') }}">                                 
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="sm:col-span-1">
                                    <label for="status_keluarga" class="block text-base font-medium leading-6 text-cyan-900">Status dalam Keluarga</label>
                                    <div class="mt-2">
                                        <input type="text" name="status_keluarga" id="status_keluarga" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Status dalam keluarga"">
                                    </div>
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="status_kawin" class="block text-base font-medium leading-6 text-cyan-900">Status Perkawinan</label>
                                    <div class="mt-2 relative">
                                        <select name="status_kawin" id="status_kawin" class="px-6 py-2 block w-full rounded-2xl border-0 h-10 shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none appearance-none">
                                            {{-- AMBIL DARI DATABASE KAYAK JENIS KELAMIN TADI --}}
                                            <option value="BK">Belum Kawin</option>
                                            <option value="K">Kawin</option>
                                            <option value="CH">Cerai Hidup</option>
                                            <option value="CM">Cerai Mati</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                                            <img src="{{ asset('..\assets\icons\arrow-up.svg') }}">                                 
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="sm:col-span-1">
                                    <label for="tabungan" class="block text-base font-medium leading-6 text-cyan-900">Memiliki Tabungan</label>
                                    <div class="mt-2 relative">
                                        <select name="tabungan" id="tabungan" class="px-6 py-2 block w-full rounded-2xl border-0 h-10 shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none appearance-none">
                                            <option value="Y">Ya</option>
                                            <option value="N">Tidak</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                                            <img src="{{ asset('..\assets\icons\arrow-up.svg') }}">                                                                   
                                        </div>
                                    </div>
                                </div>
            
                                <div class="sm:col-span-1">
                                    <label for="aseptor_kb" class="block text-base font-medium leading-6 text-cyan-900">Aseptor KB</label>
                                    <div class="mt-2 relative">
                                        <select name="aseptor_kb" id="aseptor_kb" class="px-6 py-2 block w-full rounded-2xl border-0 h-10 shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none appearance-none">
                                            {{-- SAMA LANGSUNG NGAMBIL DARI DATABASE JUGA --}}
                                            <option value="Y">Ya</option>
                                            <option value="N">Tidak</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                                            <img src="{{ asset('..\assets\icons\arrow-up.svg') }}">                                 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="mt-9">
                            <div class="text-secondary text-base font-semibold">Kegiatan Keorganisasian</div>                       
                            <div class="mt-5 grid gap-x-9 gap-y-5 grid-cols-2">
                                <div class="sm:col-span-1">
                                    <label for="kegiatan_organisasi" class="block text-base font-medium leading-6 text-cyan-900">Aktif dalam Kegiatan</label>
                                    <div class="mt-2">
                                        <input type="text" name="kegiatan_organisasi" id="kegiatan_organisasi" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Aktif dalam Kegiatan apa nich">
                                    </div>
                                </div>
                        
                                <div class="sm:col-span-1">
                                    <label for="koperasi" class="block text-base font-medium leading-6 text-cyan-900">Ikut dalam Kegiatan Koperasi</label>
                                    <div class="mt-2">
                                        <input type="text" name="koperasi" id="koperasi" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Ikut dalam Kegiatan Koperasi Apa Nich">
                                    </div>
                                </div>
                        
                                <div class="sm:col-span-1">
                                    <label for="kelompok_belajar" class="block text-base font-medium leading-6 text-cyan-900">Mengikuti Kelompok Belajar Sains</label>
                                    <div class="mt-2">
                                        <input type="text" id="kelompok_belajar" name="kelompok_belajar" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Kelompok Belajar apa nich"">
                                    </div>
                                </div>
            
                                <div class="sm:col-span-1">
                                    <label for="paud" class="block text-base font-medium leading-6 text-cyan-900">Mengikuti PAUD/Sejenis</label>
                                    <div class="mt-2">
                                        <input type="text" id="paud" name="paud" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Mengikuti PAUD/sejenis"">
                                    </div>
                                </div>
            
                                <div class="sm:col-span-1">
                                    <label for="bina_balita" class="block text-base font-medium leading-6 text-cyan-900">Mengikuti Program Bina Keluarga Balita</label>
                                    <div class="mt-2">
                                        <input type="text" id="bina_balita" name="bina_balita" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 text-base font-medium shadow-sm ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none" value="Mengikuti Program Bina Keluarga Balita"">
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="submit" class="rounded-2xl bg-secondary px-12 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-[#0F4C52] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Ajukan Perubahan Data</button>
                        </div>
                    </form>
                </div>
        
                <div x-show="openTab === 2" class="">
                    <div class="overflow-x-auto rounded-xl">
                        <table class="w-full text-base text-left table-fixed">
                            <thead class="text-white bg-secondary">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Nama Pengaju</th>
                                    <th scope="col" class="px-6 py-3">Tipe Berkas</th>
                                    <th scope="col" class="px-6 py-3">Tgl Pengajuan</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd:bg-white even:bg-[#DBE4E5] border-none text-neutral-900">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">Daffa Maulana Satria</th>
                                    <td class="px-6 py-5">Dasawisma</td>
                                    <td class="px-6 py-4">Januari, 24 2024</td>
                                    <td class="px-6 py-4">Diverifikasi</td>
                                </tr>
                                <tr class="odd:bg-white even:bg-[#DBE4E5] border-none text-eutral-900">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">Daffa Maulana Satria</th>
                                    <td class="px-6 py-4">Dasawisma</td>
                                    <td class="px-6 py-4">Januari, 24 2024</td>
                                    <td class="px-6 py-4">Proses Verifikasi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>   
                </div>
            </div>
        </div>
    </div>
@endsection
