@extends('layouts.user')
@section('title')
Iuran RW
@endsection
@section('content-user')
    <div class="resident-header">Iuran RW</div>

    <!-- TAB -->
    <div x-data="{ 
        showModal: false,
        showKeterangan: false,
        currentStatus: '',
        currentNominal: '',
        currentDate: ''
    }" class="flex flex-col gap-9">
        <section class="flex justify-between">
            <div class="link-option_parrent">
                <a href="{{ route('resident.data-pembayaran.index', ['typeDocument' => 'pembayaran']) }}"
                   class="link-option {{ $typeDocument == 'pembayaran' ? 'link-option_active' : false }}">
                    Pembayaran
                </a>
                <a href="{{ route('resident.data-pembayaran.index', ['typeDocument' => 'riwayat']) }}"
                   class="link-option {{ $typeDocument == 'riwayat' ? 'link-option_active' : false }}">
                    Riwayat
                </a>
            </div>
            <button class="px-11 py-3 bg-secondary font-semibold text-stone-50 rounded-2xl whitespace-nowrap button-hover sm:hidden" @click="showModal = true">Lakukan Pembayaran</button>
            <button class="px-4 py-3 bg-secondary font-semibold text-stone-50 rounded-2xl whitespace-nowrap md:hidden" @click="showModal = true">
                <img src="{{ asset('assets/icons/manajemen-dana.svg')}}" alt="">
            </button>
        </section>

        @switch($typeDocument)
            @case('pembayaran')
                <!-- FILTER -->
                <div class="relative md:w-1/4">
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
                                                {{ isset($fundData['garbage_fund'][$index]) ? $fundData['garbage_fund'][$index]->status : 'Not Found' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="left-header">Iuran Kematian</td>
                                        @foreach ($months as $index => $month)
                                            <td>
                                                {{ isset($fundData['death_fund'][$index]) ? $fundData['death_fund'][$index]->status : 'Not Found' }}
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
            @break
            @case('riwayat')
                {{-- Filter --}}
                <div class="flex justify-between">
                    <div class="relative w-[630px] mr-9">
                        <input type="text" placeholder="Cari Nama" class="resident-search">
                        <img src="{{ asset('assets/icons/search.svg') }}" alt="Search Icon" class="left-icon">
                    </div>
                    <div class="relative basis-1/5">
                        <select class="resident-select cursor-pointer" onchange="sortHistory(this.value)">
                            <option value="default">Urutkan</option>
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="alphabetical">A-Z</option>
                            <option value="reverse_alphabetical">Z-A</option>
                        </select>
                        <img src="{{ asset('assets/icons/filter.svg') }}" alt="Filter Icon" class="left-icon pointer-events-none">
                        <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Arrow Icon" class="right-icon pointer-events-none">
                    </div>
                </div>
                {{-- Table --}}
                <div class="overflow-x-auto rounded-xl">
                    <table class="table-parent w-full">
                        <thead>
                            <tr>
                                <th>Nama Pembayar</th>
                                <th>Tipe</th>
                                <th class="sm:hidden">Nominal</th>
                                <th class="sm:hidden">Jumlah Bulan</th>
                                <th class="sm:hidden">Tanggal Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($history->isEmpty())
                                <tr class="hover:bg-fourth transition-all ease-linear">
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach($history as $payment)
                                <tr class="hover:bg-fourth transition-all ease-linear">
                                    <td>{{ $payment->resident->nama }}</td>
                                    <td>{{ $payment->jenis }}</td>
                                    <td class="sm:hidden">{{ 'Rp. ' . number_format($payment->jumlah, 0, ',', '.') }}</td>
                                    <td class="sm:hidden">{{ $payment->jumlah / 10000 }}</td>
                                    <td class="sm:hidden">{{ \Carbon\Carbon::parse($payment->created_at)->format('d F Y') }}</td>
                                    <td>
                                        <div class="font-bold sm:hidden {{
                                            $payment->status == 'Ditolak' ? 'text-red-600' : ($payment->status == 'Terverifikasi' ? 'text-secondary' : ($payment->status == 'Belum Terverifikasi' ? 'text-main/50' : 'text-secondary')) }}">
                                            {{ $payment->status }}
                                        </div>
                                        <button 
                                            class="md:hidden"
                                            x-on:click="
                                                showKeterangan = true;
                                                currentStatus = '{{ $payment->status }}';
                                                currentNominal = '{{ $payment->jumlah ?? '' }}';
                                                currentDate = '{{ \Carbon\Carbon::parse($payment->created_at)->format('d F Y') }}'
                                            ">
                                            <x-icon.detail />
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @break
            @default
        @endswitch
        
        <!-- Modal Keterangan -->
        <div x-show="showKeterangan" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60" x-cloak>
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
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50" x-cloak>
            <div class="bg-white rounded-2xl p-10 w-[33rem]">
                <form id="payment-form" action="{{ route('resident.data-pembayaran.store') }}" method="post" enctype="multipart/form-data">
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
                        <span id="error-jenis" class="text-red-500"></span>
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
                        <span id="error-metode" class="text-red-500"></span>
                    </div>
                    <div class="flex flex-col mb-9">
                        <label class="text-secondary text-xl font-semibold mb-2">Nominal</label>
                        <input type="text" id="jumlah" name="jumlah" class="resident-input" inputmode="numeric" pattern="[0-9]*" placeholder="Masukkan Nominal" oninput="validateMultipleOfTenThousand(this);">
                        <div id="nominal-error" class="text-secondary text-right block">* Nominal harus kelipatan 10.000</div>
                        <span id="error-jumlah" class="text-red-500"></span>
                    </div>
                    <div class="flex flex-col w-full">
                        <div id="dropzone" class="relative flex flex-col items-center justify-center w-full h-64 border-secondary border-2 border-dashed rounded-2xl cursor-pointer hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img src="{{ asset('assets/icons/image-upload.svg') }}" alt="upload image" class="mb-3">
                                <p class="font-medium text-secondary">Upload Bukti Pembayaran</p>
                            </div>
                            <input name="urlBuktiPembayaran" id="urlBuktiPembayaran" type="file" class="hidden" accept="image/*">
                            <img id="preview-image" class="hidden absolute inset-0 object-cover w-full h-full rounded-2xl" alt="Uploaded Image">
                        </div>
                        <span id="error-urlBuktiPembayaran" class="text-red-500"></span>
                    </div>                  
        
                    <div class="mt-9 flex space-x-5">
                        <button class="btn-secondary button-hover" @click.prevent="showModal = false">Batal</button>
                        <button type="submit" class="btn-main button-hover">Konfirmasi</button>
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
        
        function sortHistory(option) {
            const tbody = document.querySelector('.history-body');
            let rows = Array.from(tbody.querySelectorAll('tr'));

            switch(option) {
                case 'newest':
                    rows.sort((a, b) => new Date(getCellValue(b, 4)) - new Date(getCellValue(a, 4)));
                    break;
                case 'oldest':
                    rows.sort((a, b) => new Date(getCellValue(a, 4)) - new Date(getCellValue(b, 4)));
                    break;
                case 'alphabetical':
                    rows.sort((a, b) => getCellValue(a, 0).localeCompare(getCellValue(b, 0)));
                    break;
                case 'reverse_alphabetical': 
                    rows.sort((a, b) => getCellValue(b, 0).localeCompare(getCellValue(a, 0)));
                    break;
                default:
                    break;
            }

            tbody.innerHTML = '';
            rows.forEach(row => {
                tbody.appendChild(row);
            });
        }

        function getCellValue(row, index) {
            return row.children[index].textContent.trim();
        }

        function searchName() {
            const input = document.querySelector('.resident-search');
            const filter = input.value.toUpperCase();
            const rows = document.querySelectorAll('.history-body tr');

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
    <script>
        $(document).ready(function() {
            $('#payment-form').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#payment-form')[0].reset();
                        window.location.href = '{{ route("resident.data-pembayaran.index", ["typeDocument" => "riwayat"]) }}';
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseJSON);
                        let response = xhr.responseJSON;
                        
                        $('#payment-form span').text('');
                        
                        if (response && response.errors) {
                            let errors = response.errors;
                            for (let field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    let errorMessage = errors[field][0];
                                    $('#error-' + field).text(errorMessage);
                                }
                            }
                        } else {
                            alert('An error occurred while processing the payment.');
                        }
                    }
                });
            });
        });
    </script>
    
@endsection
