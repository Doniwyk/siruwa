@extends('layouts.admin')
@section('title')
    Manajemen Pengeluaran
@endsection
@section('modal')
    <div class="absolute min-h-full min-w-full flex justify-center items-center bg-black/50 hidden z-50"
        id="spending-payment-modal_parent">
        <div class="sm:w-[25rem] md:w-[32rem] sm:p-5 md:p-10 rounded-2xl  bg-white center z-50 overflow-hidden"
            id="spending-payment-modal">
            <form action="{{ route('admin.data-pembayaran.store') }}" method="POST" class="flex flex-col gap-4 items-center">
                @csrf
                @method('POST')
                <h4 class="text-center text-xl font-semibold">Tambah Data Pengeluaran</h4>
                <div class="flex flex-col items-start gap-4 w-full">
                    <label for="jumlah_pengeluaran" class="text-main font-medium">Masukkan Nominal</label>
                    <input type="text" placeholder="Masukkan Nominal" id="jumlah_pengeluaran" name="jumlah_pengeluaran"
                        class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline">
                </div>
                <div class="flex flex-col items-start gap-4 w-full">
                    <label for="jenis_pengeluaran" class="text-main font-medium">Jenis Iuran</label>
                    <div class="relative w-full">
                        <select id="jenis_pengeluaran" name="jenis_pengeluaran"
                            class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline ">
                            <option selected>Jenis Iuran</option>
                            <option value="Iuran Sampah">Iuran Sampah</option>
                            <option value="Iuran Kematian">Iuran Kematian</option>
                        </select>
                        <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Dropdown Icon"
                            class="right-icon pointer-events-none">

                    </div>

                </div>
                <div class="flex flex-col items-start gap-4 w-full">
                    <label for="tanggal_pengeluaran" class="text-main font-medium">Tanggal</label>
                    <input type="date" placeholder="Masukkan Nominal" id="tanggal_pengeluaran" name="tanggal_pengeluaran"
                        class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline hidden"value="{{ date('Y-m-d') }}">
                    <input type="date" placeholder="Masukkan Nominal" id="tanggal_pengeluaran"
                        class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-secondary" disabled
                        value="{{ date('Y-m-d') }}">
                </div>
                <div class="w-full flex flex-col items-start gap-4">
                    <label for="keterangan_pengeluaran" class="text-main font-medium">Keterangan</label>
                    <textarea name="keterangan_pengeluaran" id="keterangan_pengeluaran" placeholder="Masukkan Keterangan"
                        class="w-full h-[7.2rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline"></textarea>
                </div>
                <button type="submit" class="bg-main py-3 px-16 text-white font-medium rounded-2xl button-hover">Tambahkan
                    Data</button>
            </form>
        </div>
    </div>
@endsection
@section('modal_detail_pengeluaran')
    <div class="absolute min-h-full min-w-full flex justify-center items-center hidden bg-black/50  z-50"
        id="details-spending-payment-modal_parent">
        <div class="sm:w-[25rem] md:w-[32rem] sm:p-5 md:p-10 rounded-2xl  bg-white center z-50 overflow-hidden"
            id="details-spending-payment-modal">
            <section class="flex flex-col gap-4 items-center">
                <h4 class="text-center text-xl font-semibold text-secondary">Details Data Pengeluaran</h4>
                <div class="flex flex-col items-start gap-4 w-full">
                    <label for="jumlah_pengeluaran" class="text-main font-medium">Nominal</label>
                    <input type="text" placeholder="Masukkan Nominal" id="jumlah_pengeluaran" name="jumlah_pengeluaran"
                        class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline" disabled>
                </div>
                <div class="flex flex-col items-start gap-4 w-full">
                    <label for="jenis_pengeluaran" class="text-main font-medium">Jenis Iuran</label>
                    <input type="text" placeholder="Masukkan Jenis Pengeluaran" id="jenis_pengeluaran"
                        name="jenis_pengeluaran" class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline"
                        disabled>

                </div>
                <div class="flex flex-col items-start gap-4 w-full">
                    <label for="tanggal_pengeluaran" class="text-main font-medium">Tanggal</label>
                    <input type="date" placeholder="Masukkan Nominal" id="tanggal_pengeluaran"
                        class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-secondary" disabled value="">
                </div>
                <div class="w-full flex flex-col items-start gap-4">
                    <label for="keterangan_pengeluaran" class="text-main font-medium">Keterangan</label>
                    <textarea name="keterangan_pengeluaran" id="keterangan_pengeluaran" placeholder="Masukkan Keterangan"
                        class="w-full h-[7.2rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline"></textarea>
                </div>
            </section>
        </div>
    </div>
@endsection
{{-- @dd($financialData['garbageTransaction']) --}}
@section('content')
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('admin.data-pembayaran.index') }}">
            <span>
                <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z"
                        fill="#225157" />
                </svg>
            </span>
        </a>
        <h1 class="h1-semibold">Data Iuran</h1>
    </div>
    <div class="summary-card_fund ">
        <x-shared.fund-details-card :type="'Pemasukan'" :moneyTotalKematian="$financialData['deathFundIncome']" :moneyTotalSampah="$financialData['garbageFundIncome']" />
        <x-shared.fund-details-card :type="'Pengeluaran'" :moneyTotalKematian="$financialData['deathFundExpense']" :moneyTotalSampah="$financialData['garbageFundExpense']" />
    </div>

    <section id="tab-slider" class="flex justify-between">
        <div class="link-option_parrent sm:flex-between">
            <a href="{{ route('admin.data-pembayaran.add', ['typeDocument' => 'sampah']) }}"
                class="link-option {{ $typeDocument == 'sampah' ? 'link-option_active' : '' }}">Iuran Sampah</a>
            <a href="{{ route('admin.data-pembayaran.add', ['typeDocument' => 'kematian']) }}"
                class="link-option {{ $typeDocument == 'kematian' ? 'link-option_active' : '' }}">Iuran Kematian</a>
        </div>
        <button class="button-main px-6 py-3" onclick="showSpendingForm()">Tambah Data Pengeluaran</button>
    </section>
    @switch($typeDocument)
        @case('sampah')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th class="sm:text-sm md:text-base">Nominal</th>
                        <th class="sm:text-sm md:text-base">Tanggal Pemasukkan</th>
                        <th class="sm:text-sm md:text-base">Transaksi</th>
                        <th class="sm:text-sm md:text-base">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($financialData['garbageTransaction']->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($financialData['garbageTransaction'] as $dataRiwayatSampah)
                            @php
                                $isPembayaran = $dataRiwayatSampah->type == 'Pemasukan';
                            @endphp
                            <tr>
                                <td class="{{ $isPembayaran ? 'text-main' : 'text-red-600' }}">
                                    {{ $isPembayaran ? $dataRiwayatSampah->amount : "-$dataRiwayatSampah->amount" }}</td>
                                <td class="sm:text-sm md:text-base">{{ $dataRiwayatSampah->created_at }}</td>
                                <td class="font-semibold {{ $isPembayaran ? 'text-secondary' : 'text-red-600' }}">
                                    {{ $dataRiwayatSampah->type }}</td>
                                @if ($dataRiwayatSampah->type === 'Pengeluaran')
                                    <td>
                                        <button onclick="showFormSpendingPaymentHistory({{ $dataRiwayatSampah->id }})">
                                            <x-icon.detail />
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @break

        @case('kematian')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th class="sm:text-sm md:text-base">Nominal</th>
                        <th class="sm:text-sm md:text-base">Tanggal Pemasukkan</th>
                        <th class="sm:text-sm md:text-base">Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($financialData['deathTransaction']->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($financialData['deathTransaction'] as $dataRiwayatKematian)
                            @php
                                $isPembayaran = $dataRiwayatKematian->type == 'Pemasukan';
                            @endphp
                            <tr>
                                <td class="{{ $isPembayaran ? 'text-main' : 'text-red-600' }}">
                                    {{ $isPembayaran ? $dataRiwayatKematian->amount : "-$dataRiwayatKematian->amount" }}</td>
                                <td class="sm:text-sm md:text-base">{{ $dataRiwayatKematian->created_at }}</td>
                                <td class="font-semibold {{ $isPembayaran ? 'text-secondary' : 'text-red-600' }}">
                                    {{ $dataRiwayatKematian->type }}</td>
                                @if ($dataRiwayatKematian->type === 'Pengeluaran')
                                    <td>
                                        <button onclick="showFormSpendingPaymentHistory({{ $dataRiwayatKematian->id }})">
                                            <x-icon.detail />
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @break
    @endswitch
@endsection
@section('script')
    <script>
        function showSpendingForm() {
            const form = document.querySelector('#spending-payment-modal_parent')
            form.classList.toggle('hidden');

            form.addEventListener('click', ({
                target
            }) => {
                if (target == form) {
                    form.classList.add('hidden')
                }
            })

        }


        async function getSpendingFundData(id) {
            const url = `/admin/data-pembayaran/${id}/expense-history`;
            const response = await fetch(url);
            const {
                data
            } = await response.json();

            return data;
        }

        async function showFormSpendingPaymentHistory(id) {
            const modal_parent = document.querySelector(
                "#details-spending-payment-modal_parent"
            );
            const modal = modal_parent.querySelector("#details-spending-payment-modal");
            const nominalInput = modal.querySelector("#jumlah_pengeluaran");
            const jenisInput = modal.querySelector("#jenis_pengeluaran");
            const tanggalInput = modal.querySelector("#tanggal_pengeluaran");
            const keteranganInput = modal.querySelector("#keterangan_pengeluaran");

            const data = await getSpendingFundData(id);

            modal_parent.classList.remove("hidden");

            nominalInput.value = data.jumlah_pengeluaran;
            jenisInput.value = data.jenis_pengeluaran;
            tanggalInput.value = data.tanggal_pengeluaran.substring(0, 10);
            keteranganInput.value = data.keterangan_pengeluaran;

            modal_parent.addEventListener("click", ({
                target
            }) => {
                if (target == modal_parent) {
                    modal_parent.classList.add("hidden");
                }
            });
        }
    </script>
@endsection
