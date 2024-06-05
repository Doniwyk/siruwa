@extends('layouts.user')
@section('content-user')
    <div class="resident-header">Iuran RW</div>

    <!-- TAB -->
    <div x-data="{ 
        openTab: localStorage.getItem('openTab') ? parseInt(localStorage.getItem('openTab')) : 1,
        showModal: false,
        showKeterangan: false,
        currentStatus: '',
        currentNominal: '',
        currentDate: ''
    }">
        <div class="flex justify-between mb-9">
            <div class="flex bg-white max-w-72 p-2 rounded-2xl space-x-4">
                <button x-on:click="openTab = 1; localStorage.setItem('openTab', 1)" :class="{ 'bg-secondary text-white': openTab === 1 }"
                    class="resident-tab">Pembayaran</button>
                <button x-on:click="openTab = 2; localStorage.setItem('openTab', 2)" :class="{ 'bg-secondary text-white': openTab === 2 }"
                    class="resident-tab">Riwayat</button>
            </div>
            <button class="px-11 py-3 bg-secondary font-semibold text-stone-50 rounded-2xl whitespace-nowrap button-hover sm:hidden" @click="showModal = true">Lakukan Pembayaran</button>
            <button class="px-4 py-3 bg-secondary font-semibold text-stone-50 rounded-2xl whitespace-nowrap md:hidden" @click="showModal = true">
                <img src="{{ asset('assets/icons/manajemen-dana.svg')}}" alt="">
            </button>
        </div>

        <!-- TAB PEMBAYARAN -->
        <div x-show="openTab === 1">
            <!-- FILTER -->
            <div class="relative mb-9 md:w-1/4">
                <form method="GET" action="{{ route('resident.fund.index') }}">
                    <select name="year" id="year" class="resident-select" onchange="this.form.submit()">
                        <option value="">Filter Tahun</option>
                        @php
                            $currentYear = date('Y');
                            for ($i = 0; $i < 5; $i++) {
                                $year = $currentYear - $i;
                                echo "<option value='$year'" . (request('year') == $year ? ' selected' : '') . ">$year</option>";
                            }
                        @endphp
                    </select>
                    <img src="{{ asset('assets/icons/filter.svg') }}" alt="Filter Icon" class="left-icon">
                    <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Arrow Icon" class="right-icon">
                </form>
            </div>
            <!-- TABLE -->
            <div class="bg-white rounded-2xl md:p-3 ">
                <div class="overflow-x-auto rounded-xl">
                    <table class="sm:hidden">
                        <table class="sm:hidden">
                            <thead class="fund-header">
                                <tr>
                                    <th class="border-white border-r border-b">Bulan</th>
                                    @php
                                        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    @endphp
                                    @foreach ($months as $month)
                                        <th>{{ $month }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="fund-body">
                                <tr>
                                    <td class="left-header border-b">Iuran Sampah</td>
                                    @foreach ($months as $index => $month)
                                        <td>
                                            {{ isset($fundData['garbage_fund'][$index]) ? $fundData['garbage_fund'][$index]->status : 'Belum Lunas' }}
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="left-header">Iuran Kematian</td>
                                    @foreach ($months as $index => $month)
                                        <td>
                                            {{ isset($fundData['death_fund'][$index]) ? $fundData['death_fund'][$index]->status : 'Belum Lunas' }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    <table class="md:hidden table-fund">
                        <thead class="">
                            <tr>
                                <th>Bulan</th>
                                <th>Iuran Sampah</th>
                                <th>Iuran Kematian</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @php
                                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @foreach ($months as $index => $month)
                                <tr class="">
                                    <td class="bg-secondary text-white">{{ $month }}</td>
                                    <td>{{ $fundData['garbage_fund'][$index]->status ?? 'Belum Lunas' }}</td>
                                    <td>{{ $fundData['death_fund'][$index]->status ?? 'Belum Lunas' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                        <select name="" id="" class="resident-select cursor-pointer appearance-none">
                            <option value="">Filter Data</option>
                            <option value="P">Anu</option>
                        </select>
                        <img src="{{ asset('assets/icons/filter.svg') }}" alt="Filter Icon" class="left-icon pointer-events-none">
                        <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Arrow Icon" class="right-icon pointer-events-none">
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-left table-fixed">
                    <thead class="history-header">
                        <tr>
                            <th>Nama Pembayar</th>
                            <th>Tipe</th>
                            <th class="sm:hidden">Nominal</th>
                            <th class="sm:hidden">Jumlah Bulan</th>
                            <th class="sm:hidden">Tanggal Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="history-body">
                        @foreach($history as $payment)
                        <tr>
                            <td>{{ $payment->resident->nama }}</td>
                            <td>{{ $payment->jenis }}</td>
                            <td class="sm:hidden">{{ 'Rp. ' . number_format($payment->jumlah, 0, ',', '.') }}</td>
                            <td class="sm:hidden">{{ $payment->jumlah / 10000 }}</td>
                            <td class="sm:hidden">{{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('d F Y') }}</td>
                            <td>
                                <div class="sm:hidden">{{ $payment->status }}</div>
                                <button 
                                    class="md:hidden"
                                    x-on:click="
                                        showKeterangan = true;
                                        currentStatus = '{{ $payment->status }}';
                                        currentNominal = '{{ $payment->jumlah ?? '' }}';
                                        currentDate = '{{ \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('d F Y') }}'
                                    ">
                                    <x-icon.detail />
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        
        <!-- Modal Keterangan -->
        <div x-show="showKeterangan" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60">
            <div class="w-[33rem] flex flex-col bg-white p-10 rounded-2xl gap-9 text-secondary">
                <div class="flex flex-col items-center">
                    <span class="text-xl font-bold mb-4">DETAIL STATUS VERIFIKASI</span>
                    <div>
                        <span class="text-xl font-semibold">Status:</span>
                        <span x-text="currentStatus" :class="{'text-main/50': currentStatus === 'Menunggu Verifikasi', 'text-red-600': currentStatus === 'Ditolak', 'text-secondary': currentStatus === 'Diterima'}" class="text-xl font-semibold"></span>
                    </div>
                </div>
                <div>
                    <div class="text-xl font-semibold mb-3">Nominal</div>
                    <span id="mySpan" class="flex items-center px-6 py-2 block w-full text-slate-500 overflow-hidden resize-none min-h-[40px] leading-[20px] bg-input-disabled border-none rounded-2xl pointer-events-none" role="textbox" contenteditable x-text="currentNominal"></span>
                </div>
                <div>
                    <div class="text-xl font-semibold mb-3">Tanggal Pembayaran</div>
                    <span id="mySpan" class="flex items-center px-6 py-2 block w-full text-slate-500 overflow-hidden resize-none min-h-[40px] leading-[20px] bg-input-disabled border-none rounded-2xl pointer-events-none" role="textbox" contenteditable x-text="currentDate"></span>
                </div>
                <div class="flex items-center justify-center">
                    <button 
                        class="flex px-20 py-2 bg-secondary text-stone-50 rounded-2xl text-base font-semibold button-hover"
                        x-on:click="showKeterangan = false">
                        Baik
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Pembayaran -->
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50" style="display: none;">
            <div class="bg-white rounded-2xl p-10 w-[33rem]">
                <form action="{{ route('resident.data-pembayaran.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="flex flex-col mb-4">
                        <label class="text-secondary text-xl font-semibold mb-2">Jenis Iuran</label>
                        <div class="relative">
                            <select class="resident-input cursor-pointer" name="jenis">
                                <option value="">Pilih Jenis Pembayaran</option>
                                <option value="Iuran Sampah">Iuran Sampah</option>
                                <option value="Iuran Kematian">Iuran Kematian</option>
                            </select>
                            <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Dropdown Icon" class="right-icon pointer-events-none">
                        </div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="text-secondary text-xl font-semibold mb-2">Metode Pembayaran</label>
                        <div class="relative">
                            <select class="resident-input cursor-pointer" name="metode">
                                <option value="">Pilih Metode</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                            <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Dropdown Icon" class="right-icon pointer-events-none">
                        </div>
                    </div>
                    <div class="flex flex-col mb-9">
                        <label class="text-secondary text-xl font-semibold mb-2">Nominal</label>
                        <input type="text" id="jumlah" name="jumlah" class="resident-input" inputmode="numeric" pattern="[0-9]*" placeholder="Masukkan Nominal" oninput="validateMultipleOfTenThousand(this);">
                        <p id="nominal-error" class="text-red-500 text-sm mt-1 hidden">Nominal harus kelipatan 10,000.</p>
                    </div>
                    <div class="flex items-center justify-center w-full">
                        <div id="dropzone" class="relative flex flex-col items-center justify-center w-full h-64 border-secondary border-2 border-dashed rounded-2xl cursor-pointer hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img src="{{ asset('assets/icons/image-upload.svg') }}" alt="upload image" class="mb-3">
                                <p class="font-medium text-secondary">Upload Bukti Pembayaran</p>
                            </div>
                            <input name="urlBuktiPembayaran" id="urlBuktiPembayaran" type="file" class="hidden" accept="image/*">
                            <img id="preview-image" class="hidden absolute inset-0 object-cover w-full h-full rounded-2xl" alt="Uploaded Image">
                        </div>
                    </div>                  
                    
                    <div class="mt-9 flex space-x-5">
                        <button class="btn-secondary" @click.prevent="showModal = false">Batal</button>
                        <button type="submit" class="btn-main">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dropzone = document.getElementById('dropzone');
        const dropzoneFileInput = document.getElementById('urlBuktiPembayaran');
        const previewImage = document.getElementById('preview-image');

        ['dragover', 'dragenter'].forEach(event => {
            dropzone.addEventListener(event, function(e) {
                e.preventDefault();
                dropzone.classList.add('bg-gray-100');
            });
        });

        ['dragleave', 'drop'].forEach(event => {
            dropzone.addEventListener(event, function(e) {
                e.preventDefault();
                dropzone.classList.remove('bg-gray-100');
                if (e.type === 'drop') {
                    dropzoneFileInput.files = e.dataTransfer.files;
                    displayPreview(dropzoneFileInput.files[0]);
                }
            });
        });

        dropzone.addEventListener('click', () => dropzoneFileInput.click());

        dropzoneFileInput.addEventListener('change', function(e) {
            displayPreview(e.target.files[0]);
        });

        function displayPreview(file) {
            const reader = new FileReader();
            reader.onload = () => {
                previewImage.src = reader.result;
                previewImage.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        function formatNumber(input) {
            let value = input.value.replace(/\D/g, ''); 
            let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); 
            input.value = formatted;
        }

        function validateMultipleOfTenThousand(input) {
            const errorElement = document.getElementById('nominal-error');
            let value = input.value.replace(/\D/g, ''); 
            if (value % 10000 !== 0) {
                errorElement.classList.remove('hidden');
            } else {
                errorElement.classList.add('hidden');
            }
        }
    </script>  
@endsection
