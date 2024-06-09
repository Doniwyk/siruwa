@extends('layouts.admin')
@section('title')
Manajemen Pengeluaran Dana
@endsection
@section('modal')
    <div class="absolute min-h-full min-w-full flex justify-center items-center bg-black/50 hidden z-50" id="spending-payment-modal_parent">
        <div class="sm:w-[25rem] md:w-[32rem] p-10 rounded-2xl  bg-white center z-50 overflow-hidden" id="spending-payment-modal">
            <form action="{{route('admin.data-pembayaran.store')}}" method="POST" class="flex flex-col gap-4 items-center">
                @csrf
                @method('POST')
                    <h4 class="text-center text-xl font-semibold">Tambah Data Pengeluaran</h4>
                    <div class="flex flex-col items-start gap-4">
                        <label for="jumlah_pengeluaran" class="text-main font-medium">Masukkan Nominal</label>
                        <input type="text" placeholder="Masukkan Nominal" id="jumlah_pengeluaran" name="jumlah_pengeluaran"
                            class="w-[27.25rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline">
                    </div>
                    <div class="flex flex-col items-start gap-4">
                        <label for="jenis_pengeluaran" class="text-main font-medium">Jenis Iuran</label>
                        <select id="jenis_pengeluaran" name="jenis_pengeluaran"
                            class="w-[27.25rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline ">
                            <option selected>Jenis Iuran</option>
                            <option value="Iuran Sampah">Iuran Sampah</option>
                            <option value="Iuran Kematian">Iuran Kematian</option>
                        </select>
    
                    </div>
                    <div class="flex flex-col items-start gap-4">
                        <label for="tanggal" class="text-main font-medium">Masukkan Nominal</label>
                        <input type="date" placeholder="Masukkan Nominal" id="tanggal" name="tanggal"
                            class="w-[27.25rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline">
                    </div>
                    <div class="w-full flex flex-col items-start gap-4">
                        <label for="keterangan" class="text-main font-medium">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" class="w-full h-[7.2rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline"></textarea>
                    </div>
                <button type="submit" class="bg-main py-3 px-16 text-white font-medium rounded-2xl">Tambahkan Data</button>
            </form>
        </div>
    </div>
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
        <h1 class="h1-semibold">Data Iuran</h1>
    </div>
    <div class="summary-card_fund ">
        <x-shared.fund-details-card :moneyTotalKematian="$financialData['deathFundIncome']" :moneyTotalSampah="$financialData['garbageFundIncome']" />
        <x-shared.fund-details-card :moneyTotalKematian="$financialData['deathFundExpense']" :moneyTotalSampah="$financialData['garbageFundExpense']" />
    </div>

    <section id="tab-slider" class="flex justify-between">
        <div class="link-option_parrent sm:flex-between">
            <a href="{{ route('admin.data-pembayaran.add', ['typeDocument' => 'pembayaran']) }}"
                class="link-option {{ $typeDocument == 'pembayaran' ? 'link-option_active' : '' }}">Pembayaran</a>
            <a href="{{ route('admin.data-pembayaran.add', ['typeDocument' => 'riwayatPembayaran']) }}"
                class="link-option {{ $typeDocument == 'riwayatPembayaran' ? 'link-option_active' : '' }}">Riwayat</a>
        </div>
        <button class="button-main px-6 py-3" onclick="showFormSpendingPaymentForm()">Tambah Data Pengeluaran</button>
    </section>
    <x-filter :typeDocument=$typeDocument :search="$search" :order="$order" />
    @switch($typeDocument)
        @case('pembayaran')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th class="sm:text-sm md:text-base">Nominal</th>
                        <th class="sm:hidden lg:table-cell">Tanggal Pemasukkan</th>
                        <th class="sm:text-sm md:text-base">Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($financialData['deathTransaction']->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($financialData['deathTransaction'] as $dataPembayaran)
                            <tr>
                                <td class="sm:hidden lg:table-cell">{{ $dataPembayaran->amount }}</td>
                                <td class="sm:text-sm md:text-base">{{ $dataPembayaran->created_at }}</td>
                                <td class="sm:hidden lg:table-cell">{{ $dataPembayaran->type }}</td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div id="pagination">
                {{-- {{ $fundData['getSubmission']->appends(request()->except('validatedPage'))->links() }} --}}
            </div>
        @break

        @case('riwayatPembayaran')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th class="sm:text-sm md:text-base">Nominal</th>
                        <th class="sm:hidden lg:table-cell">Tanggal Pemasukkan</th>
                        <th class="sm:text-sm md:text-base">Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($financialData['garbageTransaction']->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($financialData['garbageTransaction'] as $dataRiwayat)
                            @php
                                $isPembayaran = $dataRiwayat->type == 'Pemasukan';
                            @endphp
                            <tr>
                                <td class="sm:hidden lg:table-cell {{ $isPembayaran ? 'text-main' : 'text-red-600' }}">
                                    {{ $isPembayaran ? $dataRiwayat->amount : "-$dataRiwayat->amount" }}</td>
                                <td class="sm:text-sm md:text-base">{{ $dataRiwayat->created_at }}</td>
                                <td
                                    class="sm:hidden lg:table-cell font-semibold {{ $isPembayaran ? 'text-main' : 'text-red-600' }}">
                                    {{ $dataRiwayat->type }}</td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div id="pagination">
                {{-- {{ $history->appends(request()->except('submissionPage'))->links() }} --}}
            </div>
        @break
    @endswitch
@endsection
@section('script')
    <script>
        function showFormSpendingPaymentForm() {
            const form = document.querySelector('#spending-payment-modal_parent')
            form.classList.toggle('hidden');
        }
        function fetchPaymentData(typeDocument = '', search = '', order = 'asc', page = 1) {
            $.ajax({
                url: '{{ route('admin.data-pembayaran.add') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    typeDocument: typeDocument,
                    search: search,
                    order: order,
                    page: page
                },
                success: function(data) {
                    const initialLocation =
                        `${window.location.origin}/admin/data-pembayaran?typeDocument=${typeDocument}&search=${search}&order=${order}&page=${page}`;
                    window.history.pushState({
                        path: initialLocation
                    }, '', initialLocation);

                    const fundDatas = data.fundData
                    console.log(fundDatas);

                    $('#table-parent tbody').empty();
                    $('#pagination').empty();

                    if (!fundDatas.length) {
                        $('#table-parent tbody').append(
                            `<tr>
            <td colspan="5" class="text-center">No data found</td>
        </tr>`
                        );
                        return;
                    }
                    let index = 0;
                    $.each(fundDatas, function(index, fundData) {
                        const datetime = fundData.created_at;
                        const dateString = datetime.slice(0, 10);
                        index++;
                        let lastColumn;
                        switch (typeDocument) {
                            case 'pembayaran':
                                lastColumn = `<td class="flex-start">
            <button class="w-[25px] h-[25px] flex-center" id="button-${index}"
                onclick="getDataPembayaran(${fundData.id_pembayaran})">
                <x-icon.detail />
            </button>
        </td>`
                                break;
                            case 'riwayatPembayaran':
                                lastColumn =
                                    `<td class="font-semibold ${ fundData.status == 'Ditolak' ? 'text-red-600' : 'text-main'}">${fundData.status}</td>`
                                break;
                        }

                        $('#table-parent tbody').append(
                            `<tr>
            <td>${ fundData.resident.nama }</td>
            <td class="sm:hidden lg:table-cell">${ fundData.nomor_kk }</td>
            <td class="sm:hidden lg:table-cell">${ dateString }</td>
            <td>${ fundData.admin.noHp }</td>
            ${lastColumn}
        </tr>`

                        )
                    })
                    $('#pagination').append(data.paginationHtml); // Update HTML paginasi
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                }
            });
        }
    </script>
@endsection
