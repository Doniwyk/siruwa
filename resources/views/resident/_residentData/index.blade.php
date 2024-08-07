@extends('layouts.user')
@section('title')
Data Penduduk
@endsection
@section('content-user')
    <div class="resident-header">Data Penduduk</div>
    <div x-data="{ 
    showModal: false, 
    currentStatus: '', 
    currentKeterangan: '', 
    showEditPopup: false 
    }" class="flex flex-col gap-9">
        <section class="w-full flex justify-between flex-wrap gap-8">
            <div class="link-option_parrent">
                <a href="{{ route('resident.data-dasawisma.index', ['typeDocument' => 'pengajuan']) }}"
                   class="link-option {{ $typeDocument == 'pengajuan' ? 'link-option_active' : false }}">
                    Pengajuan
                </a>
                <a href="{{ route('resident.data-dasawisma.index', ['typeDocument' => 'riwayat']) }}"
                   class="link-option {{ $typeDocument == 'riwayat' ? 'link-option_active' : false }}">
                    Riwayat
                </a>
            </div>
            @if($typeDocument == 'riwayat')
                <div class="relative basis-1/5">
                    <select class="resident-select cursor-pointer" onchange="sortHistory(this.value)">
                        <option value="default">Urutkan</option>
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                    <img src="{{ asset('assets/icons/filter.svg') }}" alt="Filter Icon" class="left-icon pointer-events-none">
                    <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Arrow Icon" class="right-icon pointer-events-none">
                </div>
            @endif
        </section>
    
        @switch($typeDocument)
            @case('pengajuan')
                <div class="bg-white sm:py-4 md:py-9 sm:px-6 md:px-24 rounded-2xl flex flex-col gap-9">
                    <section id="identitas-kependudukan" class="">
                        <h4 class="h4-semibold flex items-center">
                            Identitas Kependudukan
                            <div class="flex-1 h-[2px] bg-secondary ml-2 rounded md:hidden"></div>
                        </h4>
                        <form action="" class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-4">
                            <x-form.show-input-form :label="'No. KTP/NIK'"  :name="'reqKtp'" :value="$resident->nik" />
                            <x-form.show-input-form :label="'No. KK'"  :name="'reqRegistrasi'" :value="$resident->nomor_kk" />
                            <x-form.show-input-form :label="'Nama'"  :name="'reqNama'" :value="$resident->nama" />
                            <x-form.show-input-form :label="'Alamat Lengkap'"  :name="'reqAlamat'" :value="$resident->alamat" />
                            <x-form.show-input-form :label="'RT'"  :name="'rt'" :value="$resident->rt" />
                        </form>
                    </section>
                    <section id="identitas-lengkap">
                        <h4 class="h4-semibold flex items-center">
                            Identitas Lengkap
                            <div class="flex-1 h-[2px] bg-secondary ml-2 rounded md:hidden"></div>
                        </h4>
                        <form action="" class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-4">
                            <x-form.show-input-form :label="'Tempat Lahir'"  :name="'reqTempatLahir'" :value="$resident->tempat_lahir" />
                            <x-form.show-input-form :label="'Tanggal Lahir'"  :name="'tanggalLahir'" :value="$resident->tgl_lahir" />
                            <x-form.show-input-form :label="'Jenis Kelamin'"  :name="'reqJenisKelamin'" :value="$resident->jenis_kelamin" />
                            <x-form.show-input-form :label="'Agama'"  :name="'reqAgama'" :value="$resident->agama" />
                            <x-form.show-input-form :label="'Pendidikan'"  :name="'reqPendidikan'" :value="$resident->pendidikan" />
                            <x-form.show-input-form :label="'Pekerjaan'"  :name="'reqPekerjaan'" :value="$resident->pekerjaan" />
                            <x-form.show-input-form :label="'Status Perkawinan'"  :name="'reqStatusPerkawinan'" :value="$resident->status_kawin" />
                            <x-form.show-input-form :label="'Status dalam Keluarga'"  :name="'reqStatusDalamKeluarga'" :value="$resident->status_keluarga" />
                            <x-form.show-input-form :label="'Akseptor KB'"  :name="'akseptorKB'" :value="(boolean) $resident->akseptor_kb" />
                            <x-form.show-input-form :label="'Jenis Akseptor'"  :name="'jenisAkseptor'" :value="$resident->jenis_akseptor" />
                            <x-form.show-input-form :label="'Memiliki Tabungan'"  :name="'reqMemilikiTabungan'" :value="(boolean) $resident->has_tabungan" />
                        </form>
                    </section>
                    <section id="kegiatan-keorganisasian">
                        <h4 class="h4-semibold flex items-center">
                            Kegiatan Keorganisasian
                            <div class="flex-1 h-[2px] bg-secondary ml-2 rounded md:hidden"></div>
                        </h4>
                        <form action="" class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-4">
                            <x-form.show-input-form :label="'Aktif dalam Kegiatan Posyandu'"  :name="'reqAktifKegiatan'" :value="(boolean) $resident->aktif_posyandu" />
                            <x-form.show-input-form :label="'Ikut dalam kegiatan Koperasi'"  :name="'reqKoperasi'" :value="(boolean) $resident->ikut_koperasi" />
                            <x-form.show-input-form :label="'Mengikuti Kelompok Belajar'"  :name="'reqKelompokBelajarJenis'" :value="(boolean) $resident->ikut_kel_belajar" />
                            <x-form.show-input-form :label="'Jenis Kelompok Belajar yang Diikuti'"  :name="'reqKelompokBelajarJenis'" :value="$resident->jenis_kel_belajar" />
                            <x-form.show-input-form :label="'Mengikuti PAUD/Sejenis'"  :name="'reqPaud'" :value="(boolean) $resident->ikut_paud" />
                            <x-form.show-input-form :label="'Mengikuti Program Bina Keluarga Balita'"  :name="'reqProgramBinaKeluargaBalita'" :value="(boolean) $resident->has_BKB" />
                        </form>
                    </section>
                    <section id="informasi-keuangan-pribadi">
                        <h4 class="h4-semibold flex items-center">
                            Informasi Keuangan Pribadi
                            <div class="flex-1 h-[2px] bg-secondary ml-2 rounded md:hidden"></div>
                        </h4>
                        <form action="" class="sm:flex sm:flex-col md:grid grid-cols-2 grid-flow-row gap-x-9 gap-y-4">
                            <x-form.show-input-form :label="'Gaji Perbulan'"  :name="'gaji'" :value="$resident->gaji" />
                            <x-form.show-input-form :label="'Jumlah Tanggungan'"  :name="'jumlah_tanggungan'" :value="$resident->jumlah_tanggungan" />
                            <x-form.show-input-form :label="'Total Pajak Kendaraan'"  :name="'total_pajak_kendaraan'" :value="$resident->total_pajak_kendaraan" />
                            <x-form.show-input-form :label="'Biaya Pajak Bumi dan Bangunan'"  :name="'pajak_bumi'" :value="$resident->pajak_bumi" />
                            <x-form.show-input-form :label="'Biaya Listrik Perbulan'"  :name="'biaya_listrik'" :value="$resident->biaya_listrik" />
                            <x-form.show-input-form :label="'Biaya Air Perbulan'"  :name="'biaya_air'" :value="$resident->biaya_air" />
                        </form>
                    </section>
                    
                    <section class="flex justify-end">
                        <a href="#" 
                        class="btn-main button-hover" 
                        x-on:click.prevent="
                            console.log('Clicked Edit Data');
                            if (historyNotEmpty && anyPendingVerification) {
                                console.log('Condition met: Showing popup');
                                showEditPopup = true;
                            } else {
                                console.log('Redirecting to edit page');
                                window.location.href = '{{ route('resident.data-dasawisma.edit', $resident->id) }}';
                            }">
                        Edit Data
                        </a>
                    </section>
                </div>
            @break
    
            @case('riwayat')
                <div class="overflow-x-auto rounded-xl">
                    <table class="table-parent w-full">
                        <thead>
                            <tr>
                                <th class="sm:hidden">Nama Pengaju</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Pembaharuan Terakhir</th>
                                <th>Detail Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($history->isEmpty())
                                <tr class="hover:bg-fourth transition-all ease-linear">
                                    <td colspan="4" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @else
                                @foreach($history as $record)
                                    <tr class="hover:bg-fourth transition-all ease-linear">
                                        <td class="sm:hidden">{{ $record->nama }}</td>
                                        <td>{{ $record->created_at->format('d F Y') }}</td>
                                        <td>{{ $record->updated_at }}</td>
                                        <td class="flex">
                                            <div class="font-bold w-1/2 sm:hidden {{ 
                                                $record->status == 'Ditolak' ? 'text-red-600' : ($record->status == 'Diterima' ? 'text-secondary' : ($record->status == 'Menunggu Verifikasi' ? 'text-main/50' : 'text-secondary')) }}">
                                                {{ $record->status }}
                                            </div>
                                            <button 
                                                class="w-1/2 button-hover" 
                                                x-on:click="showModal = true; 
                                                currentStatus = '{{ $record->status }}'; 
                                                currentKeterangan = '{{ $record->keterangan_status ? $record->keterangan_status : 'Tidak ada keterangan tambahan' }}';">
                                                <x-icon.detail />
                                            </button>
                                        </td>
                                    </tr>
                                    <tr id="no-results" style="display: none;">
                                        <td colspan="4" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @break
    
            @default
        @endswitch
        
        <!-- Detail Modal -->
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60" x-cloak>
            <div class="w-[33rem] flex flex-col bg-white p-10 rounded-2xl gap-9 text-secondary" id="document-modal">
                <div class="flex flex-col items-center">
                    <span class="text-xl font-bold mb-4">DETAIL STATUS VERIFIKASI</span>
                    <div>
                        <span class="text-xl font-semibold">Status:</span>
                        <span x-text="currentStatus" :class="{'text-main/50': currentStatus === 'Menunggu Verifikasi', 'text-red-600': currentStatus === 'Ditolak', 'text-secondary': currentStatus === 'Diterima'}" class="text-xl font-semibold"></span>
                    </div>
                </div>
                <div>
                    <div class="text-xl font-semibold mb-3">Keterangan</div>
                    <span id="mySpan" class="px-6 py-2 block w-full text-slate-500 overflow-hidden resize-none min-h-[40px] leading-[20px] bg-input-disabled border-none rounded-2xl pointer-events-none" role="textbox" contenteditable x-text="currentKeterangan"></span>
                </div>
                <div class="flex items-center justify-center">
                    <button 
                        class="flex px-20 py-2 bg-secondary text-stone-50 rounded-2xl text-base font-semibold button-hover"
                        x-on:click="showModal = false">
                        Baik
                    </button>
                </div>
            </div>
        </div>

        <!-- ALready Request Modal -->
        <div x-show="showEditPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60" x-cloak>
            <div class="flex flex-col bg-white md:p-10 sm:p-5 rounded-2xl gap-9 text-secondary" id="document-modal">
                <div class="flex flex-col items-center justify-center gap-4">
                    <svg width="54" height="55" viewBox="0 0 54 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27 15.6875V30.875" stroke="#225157" stroke-width="4" stroke-linecap="round"/>
                        <circle cx="27" cy="38.4688" r="1.53125" fill="#51526C" stroke="#225157" stroke-width="2"/>
                        <path d="M51.8059 27.5001C51.8059 13.8 40.6997 2.69385 26.9996 2.69385C13.2995 2.69385 2.19336 13.8 2.19336 27.5001C2.19336 41.2002 13.2995 52.3064 26.9996 52.3064C40.6997 52.3064 51.8059 41.2002 51.8059 27.5001Z" stroke="#225157" stroke-width="4" stroke-miterlimit="10"/>
                    </svg>
                    <div class="flex flex-col text-center text-xl">
                        <span class="font-semibold">Anda sudah mengajukan permintaan</span>
                        <span>Harap tunggu verifikasi</span>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <button 
                        class="flex px-20 py-2 bg-secondary text-stone-50 rounded-2xl text-base font-semibold button-hover"
                        x-on:click="showEditPopup = false">
                        Baik
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let historyNotEmpty = @json($history->isNotEmpty());
        let anyPendingVerification = @json($history->contains(function ($value, $key) {
            return $value->status === 'Menunggu Verifikasi';
        }));

        function sortHistory(option) {
            const tbody = document.querySelector('.table-parent tbody');
            let rows = Array.from(tbody.querySelectorAll('tr')).filter(row => row.style.display !== 'none');

            switch(option) {
                case 'newest':
                    rows.sort((a, b) => new Date(getCellValue(b, 1)) - new Date(getCellValue(a, 1)));
                    break;
                case 'oldest':
                    rows.sort((a, b) => new Date(getCellValue(a, 1)) - new Date(getCellValue(b, 1)));
                    break;
                default:
                    break;
            }

            rows.forEach(row => {
                tbody.appendChild(row);
            });
        }

        function getCellValue(row, index) {
            return row.children[index].textContent.trim();
        }

    </script>
@endsection
