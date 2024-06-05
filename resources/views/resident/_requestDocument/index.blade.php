@extends('layouts.user')
@section('content-user')

<script>
    window.documentLabels = {
        'Surat Pengantar Pernikahan': {
            label: 'Surat Pengantar Pernikahan',
            desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum facilis laudantium atque corrupti totam quidem, beatae iure fuga nulla? Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, in. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officia!'
        },
        'Surat Pengantar KTP': {
            label: 'Surat Pengantar KTP',
            desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum facilis laudantium atque corrupti totam quidem, beatae iure fuga nulla? Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, in. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officia!'
        },
        'Surat Keterangan': {
            label: 'Surat Keterangan',
            desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum facilis laudantium atque corrupti totam quidem, beatae iure fuga nulla? Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, in. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officia!'
        }
    };
</script>

<div class="resident-header">{{ $title }}</div>

<!-- TAB -->
<div x-data="{ 
        openTab: localStorage.getItem('openTab') ? parseInt(localStorage.getItem('openTab')) : 1, 
        showModal: false, 
        currentType: '',
        currentStatus: '', 
        currentKeterangan: '', 
        selectedDocument: '', 
        documents: window.documentLabels, 
        showConfirmationModal: false 
    }" id="data-document">
    <div class="resident-tab-parent">
        <button x-on:click="openTab = 1; localStorage.setItem('openTab', 1)" 
            :class="{ 'bg-secondary text-white': openTab === 1 }" 
            class="resident-tab">Pengajuan</button>
        <button x-on:click="openTab = 2; localStorage.setItem('openTab', 2)" 
            :class="{ 'bg-secondary text-white': openTab === 2 }" 
            class="resident-tab">Riwayat</button>
    </div>

    <!-- TAB PENGAJUAN -->
    <div x-show="openTab === 1">
        <form action="{{ route('resident.data-dokumen.request') }}" method="post" class="flex flex-col bg-white rounded-2xl md:py-9 md:px-16 sm:py-5 sm:px-5 gap-5" id="residentForm">
            @csrf
            @method('POST')
            <div class="text-secondary text-xl font-bold">Jenis Dokumen</div>
            <section>
                <div class="grid gap-x-9 grid-cols-2">
                    <div class="col-span-1 sm:col-span-2">
                        <div class="relative">
                            <select x-model="selectedDocument" name="jenis" id="jenis_dokumen" class="form-control-input appearance-none cursor-pointer w-full">
                                <option value="">Pilih Jenis Dokumen</option>
                                <option value="Surat Pengantar Pernikahan">Surat Pengantar Pernikahan</option>
                                <option value="Surat Pengantar KTP">Surat Pengantar KTP</option>
                                <option value="Surat Keterangan">Surat Keterangan</option>
                            </select>
                            <img src="{{ asset('assets/icons/arrow-up.svg') }}" alt="arrow-up" class="right-icon pointer-events-none">
                        </div>
                    </div>
                </div>
            </section>

            <template x-if="selectedDocument">
                <section>
                    <span class="text-secondary text-base font-bold" x-text="documents[selectedDocument].label"></span>
                    <span class="text-secondary text-base font-medium" x-text="documents[selectedDocument].desc"></span>
                </section>
            </template>

            <section x-show="selectedDocument !== ''">
                <hr class="h-1 mx-auto bg-secondary border-0 rounded">
            </section>

            <section x-show="selectedDocument !== ''">
                <div class="text-secondary text-base font-medium mb-5">Silahkan isi formulir dibawah ini!</div>

                <div class="flex flex-col gap-5">
                    <div class="flex gap-5 sm:flex-col">
                        <x-form.show-input-form :label="'Nama Lengkap'"  :name="'anu'" :value="$resident->nama" />
                        <div class="form-group sm:col-span-2">
                            <label class="text-label_light">Tanggal Pengajuan</label>
                            <input type="date" name="tglPengajuan" id="tglPengajuan" class="form-control appearance-none sm:col-span-2" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group gap-5">
                        <label for="nomor_hp" class="block text-base font-medium leading-6 text-secondary">Alasan Pengajuan</label>
                        <textarea name="keperluan" id="keperluan" cols="30" rows="10" class="resident-input" placeholder="Alasan Pengajuan"></textarea>
                    </div>
                </div>
            </section>

            <section class="flex justify-end mt-4" x-show="selectedDocument !== ''">
                <button type="button" class="btn-main" x-on:click="showConfirmationModal = true">Simpan Data</button>
            </section>
        </form>

        <!-- Modal -->
        <div x-show="showConfirmationModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-10">
            <div class="flex flex-col bg-white rounded-2xl p-10 gap-9">  
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
                    <button type="button" id="check-again-button" class="w-52 py-2 bg-secondary text-stone-50 font-semibold rounded-2xl flex justify-center items-center button-hover" x-on:click="showConfirmationModal = false">
                        Periksa Lagi
                    </button>
                    <button type="button" id="confirm-button" class="w-52 py-2 font-semibold text-secondary rounded-2xl border-2 border-secondary flex justify-center items-center button-hover" x-on:click="document.getElementById('residentForm').submit(); showConfirmationModal = false;">
                        Benar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB RIWAYAT -->
    <div x-show="openTab === 2">
        <div class="flex justify-between mb-9">
            <div class="relative w-[630px] mr-9">
                <input type="text" placeholder="Cari Nama" class="resident-search">
                <img src="{{ asset('assets/icons/search.svg') }}" alt="Search Icon" class="left-icon">
            </div>
            <div class="whitespace-nowrap flex items-center">
                <div class="relative w-[180px]">
                    <select class="resident-select cursor-pointer" onchange="sortHistory(this.value)">
                        <option value="default">Urutkan</option>
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                    <img src="{{ asset('assets/icons/filter.svg') }}" alt="Filter Icon" class="left-icon pointer-events-none">
                    <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Arrow Icon" class="right-icon pointer-events-none">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto rounded-xl">
            <table class="table-resident">
                <thead>
                    <tr>
                        <th>Nama Pengaju</th>
                        <th class="sm:hidden">Tipe Berkas</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Detail Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documentData['document']->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data</td>
                    </tr>
                    @else
                        @foreach($documentData['document'] as $record)
                            <tr>
                                <td>{{ $detailAccount->nama }}</td>
                                <td class="sm:hidden">{{ $record->jenis }}</td>
                                <td>{{ $record->created_at->format('d F Y') }}</td>
                                <td class="flex items-center">
                                    <div class="font-bold w-1/2 sm:hidden {{ 
                                        $record->status === 'Ditolak' || $record->status === 'Dibatalkan' ? 'text-red-600' : 
                                        ($record->status === 'Diterima' || $record->status === 'Bisa Diambil' ? 'text-secondary' : 
                                        ($record->status === 'Menunggu Verifikasi' || $record->status === 'Proses' ? 'text-main/50' : 'text-secondary')) }}">
                                        {{ $record->status }}
                                    </div>
                                    <button class="w-1/2 button-hover"
                                        x-on:click="showModal = true; 
                                        currentType = '{{ $record->jenis }}'
                                        currentStatus = '{{ $record->status }}';
                                        currentKeterangan = '{{ $record->keterangan_status ? $record->keterangan_status : 'Tidak ada keterangan tambahan' }}';">
                                        <x-icon.detail />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60">
        <div class="w-[33rem] flex flex-col bg-white p-10 rounded-2xl gap-9 text-secondary">
            <div class="flex flex-col items-center">
                <span class="text-xl font-bold mb-4">DETAIL STATUS VERIFIKASI</span>
                <div>
                    <span class="text-xl font-semibold">Status:</span>
                    <span x-text="currentStatus" :class="{
                        'text-main/50': currentStatus === 'Menunggu Verifikasi' || currentStatus === 'Proses', 
                        'text-red-600': currentStatus === 'Ditolak' || currentStatus === 'Dibatalkan', 
                        'text-secondary': currentStatus === 'Bisa Diambil' || currentStatus === 'Selesai'}" 
                        class="text-xl font-semibold"></span>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <div>
                    <div class="text-xl font-semibold mb-3">Tipe Berkas</div>
                    <span id="mySpan" class="flex items-center px-6 py-2 block w-full text-slate-500 overflow-hidden resize-none min-h-[40px] leading-[20px] bg-input-disabled border-none rounded-2xl pointer-events-none" role="textbox" contenteditable x-text="currentType"></span>
                </div>
                <div>
                    <div class="text-xl font-semibold mb-3">Keterangan</div>
                    <span id="mySpan" class="px-6 py-2 block w-full text-slate-500 overflow-hidden resize-none min-h-[40px] leading-[20px] bg-input-disabled border-none rounded-2xl pointer-events-none" role="textbox" contenteditable x-text="currentKeterangan"></span>
                </div>
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
</div>

<script>
    function sortHistory(option) {
        const tbody = document.querySelector('.table-resident tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        switch(option) {
            case 'newest':
                rows.sort((a, b) => new Date(getCellValue(b, 2)) - new Date(getCellValue(a, 2)));
                break;
            case 'oldest':
                rows.sort((a, b) => new Date(getCellValue(a, 2)) - new Date(getCellValue(b, 2)));
                break;
            default:
                break;
        }

        tbody.innerHTML = ''; // Clear the existing table rows
        rows.forEach(row => tbody.appendChild(row)); // Append sorted rows to tbody
    }

    function getCellValue(row, index) {
        return row.children[index].textContent.trim();
    }

    function searchName() {
        const input = document.querySelector('.resident-search');
        const filter = input.value.toUpperCase();
        const rows = document.querySelectorAll('.table-resident tbody tr');

        rows.forEach(row => {
            const nameCell = row.children[0];
            if (nameCell) {
                const txtValue = nameCell.textContent || nameCell.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    }

    document.querySelector('.resident-search').addEventListener('input', searchName);
</script>
@endsection
