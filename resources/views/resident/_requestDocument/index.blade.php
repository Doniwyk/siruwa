@extends('layouts.user')
@section('content-user')
{{-- 
    TO-DO
    GANTI VALUE DARI TIAP TIAP DATA DARI DATABASE, JADI TIAP FIELD LANGSUNG KEISI DATA PENDUDUK
--}}
    <div class="mb-9 text-secondary text-4xl font-semibold">Pengajuan Dokumen</div>
    <div x-data="{ openTab: 1 }" class="">
        <div>
            <div class="mb-9 flex space-x-4 p-2 bg-white rounded-2xl overflow-hidden max-w-sm">
                <button x-on:click="openTab = 1" :class="{ 'bg-secondary text-white': openTab === 1 }" class="flex-1 py-2 px-4 rounded-xl text-secondary font-medium focus:font-semibold focus:outline-none focus:shadow-outline-blue transition-all duration-300">Pengajuan</button>
                <button x-on:click="openTab = 2" :class="{ 'bg-secondary text-white': openTab === 2 }" class="flex-1 py-2 px-4 rounded-xl text-secondary font-medium focus:font-semibold focus:outline-none focus:shadow-outline-blue transition-all duration-300">Riwayat</button>
            </div>
        </div>

        <div class="transition duration-300 ease-in-out transform">
            <div x-show="openTab === 1" class="bg-white rounded-2xl py-9 px-16">
                <form action="">
                    <div class="text-secondary text-2xl font-bold">Jenis Dokumen</div>                       
                    <div class="mt-5 grid gap-x-9 gap-y-5 grid-cols-2">
                        <div class="sm:col-span-1">
                            <div class="mt-2 relative">
                                <select name="jenis_dokumen" id="jenis_dokumen" class="p-4 pl-6 block w-full rounded-2xl border-0 py-2 h-10 shadow-sm ring-2 ring-inset ring-gray-400 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none appearance-none">
                                    <option value="">Pilih Jenis Dokumen</option>
                                    <option value="A">Surat Pengantar Pernikahan</option>
                                    <option value="B">Surat Pengantar KTP</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                                    <img src="{{ asset('..\assets\icons\arrow-up.svg') }}">                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="mt-9">
                    <span class="text-secondary text-base font-bold">Lorem, ipsum dolor.</span>
                    <span class="text-secondary text-base font-medium"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum facilis laudantium atque corrupti totam quidem, beatae iure fuga nulla? Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, in. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officia!</span>
                </div>

                <hr class="h-1 mx-auto bg-secondary border-0 rounded my-9">
                
                <p class="text-secondary text-base font-medium">Silahkan isi formulir dibawah ini!</p>

                <div class="mt-5 grid gap-x-9 gap-y-5 grid-cols-2">
                    <div>
                        <label for="nama_pengaju" class="block text-base font-medium leading-6 text-secondary">Nama Lengkap</label>
                        <div class="mt-3">
                            <input type="text" name="nama_pengaju" id="nama_pengaju" value="Nama Lengkap" class="px-6 py-2 block w-full rounded-2xl border-0 bg-[#DDE9EA] text-slate-500 text-base font-medium">
                        </div>
                    </div>
            
                    <div>
                        <label for="tanggal_pengajuan" class="block text-base font-medium leading-6 text-secondary">Tanggal Pengajuan</label>
                        <div class="mt-3">
                            <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" class="px-6 py-2 block w-full rounded-2xl border-0 text-gray-900 bg-[#DDE9EA]">
                        </div>
                    </div>
            
                    <div class="col-span-2">
                        <label for="nomor_hp" class="block text-base font-medium leading-6 text-secondary">Alasan Pengajuan</label>
                        <div class="mt-3">
                            <textarea name="" id="" cols="30" rows="10" class="px-6 py-6 block w-full rounded-2xl border-0 text-gray-900 ring-2 ring-inset ring-gray-400 focus:ring-2 focus:ring-inset focus:ring-secondary focus:outline-none"></textarea>
                            <input id="nomor_hp" name="nomor_hp" type="textarea" class="">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-2xl bg-secondary px-12 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-[#0F4C52] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Ajukan</button>
                </div>
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
@endsection
