@extends('layouts.user')
@section('content-user')
    <div class="resident-header">Iuran RW</div>

    <!-- TAB -->
    <div x-data="{ openTab: localStorage.getItem('openTab') ? parseInt(localStorage.getItem('openTab')) : 1, showModal: false }">
        <div class="resident-tab-parent">
            <button x-on:click="openTab = 1; localStorage.setItem('openTab', 1)" :class="{ 'bg-secondary text-white': openTab === 1 }"
                class="resident-tab">Pembayaran</button>
            <button x-on:click="openTab = 2; localStorage.setItem('openTab', 2)" :class="{ 'bg-secondary text-white': openTab === 2 }"
                class="resident-tab">Riwayat</button>
        </div>

        <!-- TAB PEMBAYARAN -->
        <div x-show="openTab === 1">
            <div class="flex justify-between mb-9">
                <!-- FILTER -->
                <div class="relative w-[330px] mr-9">
                    <select name="" id="" class="resident-select">
                        <option value="">Filter Tahun</option>
                        <option value="P">Anu</option>
                    </select>
                    <img src="{{ asset('assets/icons/filter.svg') }}" alt="Filter Icon" class="left-icon">
                    <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Arrow Icon" class="right-icon">
                </div>
                <!-- BUTTON PAYMENT -->
                <button class="button-pay" @click="showModal = true">Lakukan Pembayaran</button>
            </div>
            <!-- TABLE -->
            <div class="bg-white rounded-2xl p-3">
                <div class="overflow-x-auto rounded-xl">
                    <table>
                        <thead class="fund-header">
                            <tr>
                                <th class="border-white border-r border-b">Bulan</th>
                                <th>Januari</th>
                                <th>Februari</th>
                                <th>Maret</th>
                                <th>April</th>
                                <th>Mei</th>
                                <th>Juni</th>
                                <th>Juli</th>
                                <th>Agustus</th>
                                <th>September</th>
                                <th>Oktober</th>
                                <th>November</th>
                                <th>Desember</th>
                            </tr>
                        </thead>
                        <tbody class="fund-body">
                            <tr>
                                <td class="left-header border-b">Iuran Sampah</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                            </tr>
                            <tr>
                                <td class="left-header">Iuran Kematian</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                                <td>Lunas</td>
                            </tr>
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
                    <div class="relative w-[180px] mr-9">
                        <select name="" id="" class="resident-select">
                            <option value="">Filter Data</option>
                            <option value="P">Anu</option>
                        </select>
                        <img src="{{ asset('assets/icons/filter.svg') }}" alt="Filter Icon" class="left-icon">
                        <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Arrow Icon" class="right-icon">
                    </div>
                    <button class="button-pay" @click="showModal = true">Lakukan Pembayaran</button>
                </div>
            </div>

            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-left table-fixed">
                    <thead class="history-header">
                        <tr>
                            <th>Nama Pembayar</th>
                            <th>Tipe Pembayaran</th>
                            <th>Nominal</th>
                            <th>Tgl. Pembayaran</th>
                            <th>Bulan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="history-body">
                        <tr>
                            <td>Daffa Maulana Satria</td>
                            <td>Iuran Sampah</td>
                            <td>Rp. 900.000</td>
                            <td>Januari, 24 2024</td>
                            <td>Januari</td>
                            <td>Lunas</td>
                        </tr>
                        <tr>
                            <td>Daffa Maulana Satria</td>
                            <td>Iuran Sampah</td>
                            <td>Rp. 900.000</td>
                            <td>Januari, 24 2024</td>
                            <td>Januari</td>
                            <td>Lunas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50" style="display: none;">
            <div class="bg-white rounded-2xl p-10 w-[33rem]">
                <form action="">
                    <div class="flex flex-col mb-4">
                        <label class="text-secondary text-xl font-semibold mb-2">Jenis Iuran</label>
                        <div class="relative">
                            <select class="resident-input">
                                <option value="">Pilih Jenis Pembayaran</option>
                                <option value="sampah">Iuran Sampah</option>
                                <option value="kematian">Iuran Kematian</option>
                            </select>
                            <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Dropdown Icon" class="right-icon">
                        </div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label class="text-secondary text-xl font-semibold mb-2">Metode Pembayaran</label>
                        <div class="relative">
                            <select class="resident-input">
                                <option value="">Pilih Metode</option>
                                <option value="tunai">Tunai</option>
                                <option value="transfer">Transfer</option>
                            </select>
                            <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Dropdown Icon" class="right-icon">
                        </div>
                    </div>
                    <div class="flex flex-col mb-9">
                        <label class="text-secondary text-xl font-semibold mb-2">Nominal</label>
                        <input type="text" id="nominal" name="nominal" class="resident-input" inputmode="numeric" pattern="[0-9]*" placeholder="Masukkan Nominal" oninput="formatNumber(this)">
                    </div>
                    <div class="flex items-center justify-center w-full">
                        <div id="dropzone" class="relative flex flex-col items-center justify-center w-full h-64 border-secondary border-2 border-dashed rounded-2xl cursor-pointer hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img src="{{ asset('assets/icons/image-upload.svg') }}" alt="upload image" class="mb-3">
                                <p class="font-medium text-secondary">Upload Bukti Pembayaran</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" accept="image/*">
                            <img id="preview-image" class="hidden absolute inset-0 object-cover w-full h-full rounded-2xl" alt="Uploaded Image">
                        </div>
                    </div>
                    
                    <script>
                        const dropzone = document.getElementById('dropzone');
                        const dropzoneFileInput = document.getElementById('dropzone-file');
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
                            let value = input.value.replace(/\D/g, ''); // Remove non-digits
                            let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Add dot as thousand separator
                            input.value = formatted;
                        }
                    </script>                    
                    
                    <div class="mt-9 flex space-x-5">
                        <button class="py-2 font-semibold text-secondary rounded-2xl w-1/2 border-2 border-secondary" @click.prevent="showModal = false">Batal</button>
                        <button class="py-2 bg-secondary font-semibold text-white rounded-2xl w-1/2">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
