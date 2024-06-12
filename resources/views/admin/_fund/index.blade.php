@extends('layouts.admin')
@section('title')
    Manajemen Dana
@endsection
@section('modal')
    <div class="absolute min-h-full min-w-full flex justify-center items-center bg-black/50 hidden z-50"
        id="payment-modal_parent">
        <div class="sm:w-[25rem] p-10 rounded-2xl bg-white center z-50 overflow-hidden" id="payment-modal">
            <form class="flex flex-col gap-9" method="POST">
                @csrf
                @method('PUT')
                <input type="text" class="hidden" value="{{ $adminId }}" name="id_admin">
                <h1 class="text-xl font-bold text-main text-center">Konfirmasi Pembayaran</h1>
                <div id="image-preview" class="h-[11.75rem] flex-center">
                    <div class="animate-pulse min-w-[16rem] h-full bg-slate-500 rounded-2xl">
                        <img src="" alt="Bukti Pembayaran" class="h-full w-full bg-white">
                    </div>
                </div>
                <fieldset>
                    <div class="flex gap-4 justify-between items-center w-full">
                        <label for="metode_display" class="sm:text-sm">Metode Pembayaran</label>
                        <input type="text" name="metode" id="metode" value="" class="hidden">
                        <input type="text" name="metode_display" id="metode_display"
                            class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline" value=""
                            disabled>
                    </div>
                    <div class="flex gap-4 justify-between mt-4 items-center w-full">
                        <label for="jumlah_display" class="sm:text-sm">Konfirmasi Nominal</label>
                        <input type="text" name="jumlah" id="jumlah" value="" class="hidden">
                        <input type="text" name="jumlah_display" id="jumlah_display"
                            class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline" value=""
                            disabled>
                    </div>
                </fieldset>
                <div class="wrapper flex gap-2">
                    <button class=" bg-red-600 text-white px-4 py-2 rounded-3xl flex-1" type="submit" name="action"
                        value="tolak"> Tolak</button>
                    <button type="submit" class=" bg-main text-white px-4 py-2 rounded-3xl flex-1" name="action"
                        value="terima"> Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('modal_riwayat')
    <div class="absolute min-h-full min-w-full flex justify-center hidden items-center bg-black/50  z-50"
        id="riwayat-payment-modal_parent">
        <div class="sm:w-[27rem] md:w-[32.5rem] sm:p-5 md:p-10 rounded-2xl bg-white center z-50 overflow-hidden flex flex-col sm:gap-2 md:gap-9 items-center"
            id="riwayat-payment-modal">
            <h1 class="sm:text-lg md:text-xl font-semibold text-main text-center">Detail Status Pembayaran</h1>
            <span class="font-semibold sm:text-lg md:text-xl">
                <span class="text-main">Status: </span>
                <span id="riwayat-status"></span>
            </span>
            <fieldset class="flex flex-col gap-9 w-full">
                <div class="flex flex-col md:gap-4 w-full">
                    <div class="flex justify-between items-center w-full">
                        <label for="riwayat-metode_pembayaran" class="sm:text-sm text-nowrap text-secondary pr-4">Metode
                            Pembayaran</label>
                        <input type="text" name="riwayat-metode_pembayaran" id="riwayat-metode_pembayaran"
                            class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline shrink bg-input-disabled text-text-input-disabled"
                            value="" disabled>
                    </div>
                    <div class="flex justify-between mt-4 items-center w-full">
                        <label for="riwayat-jumlah_pembayaran" class="sm:text-sm text-nowrap text-secondary pr-5">Konfirmasi
                            Nominal</label>
                        <input type="text" name="riwayat-jumlah-pembayaran" id="riwayat-jumlah_pembayaran"
                            class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline bg-input-disabled text-text-input-disabled"
                            value="" disabled>
                    </div>
                </div>
                <div id="riwayat-bukti_pembayaran" class="h-[15rem] flex-center w-full">
                        <div class="animate-pulse flex items-center justify-center w-full h-full bg-gray-300 sm:w-96 dark:bg-gray-700 rounded-2xl">
                            <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                            </svg>
                        </div>
                        <img src="" alt="Bukti Pembayaran" class="h-full w-full object-contain hidden rounded-2xl">
                </div>
            </fieldset>
            <button class="sm:mt-2 bg-main text-white px-[5.5rem] py-3 rounded-3xl flex-1 button-hover" name="action" value="terima"
                onclick="closePopup('#riwayat-payment-modal_parent')">Baik</button>
        </div>
    </div>
@endsection
@section('content')
    <h1 class="h1-semibold">Manajemen Dana</h1>
    <div class="summary-card_fund ">
        <x-shared.fund-card :type="'totalDana'" :moneyTotal="$financialData['saldo']" />
        <x-shared.fund-card :type="'tunggakan'" :moneyTotal="$fundData['tunggakan']" />

    </div>

    <section id="tab-slider" class="flex">
        <div class="link-option_parrent sm:flex-between">
            <a href="{{ route('admin.data-pembayaran.index', ['typeDocument' => 'pembayaran']) }}"
                class="link-option {{ $typeDocument == 'pembayaran' ? 'link-option_active' : '' }}">Pembayaran</a>
            <a href="{{ route('admin.data-pembayaran.index', ['typeDocument' => 'riwayatPembayaran']) }}"
                class="link-option {{ $typeDocument == 'riwayatPembayaran' ? 'link-option_active' : '' }}">Riwayat</a>
        </div>
    </section>
    <x-filter :typeDocument=$typeDocument :search="$search" :order="$order" />
    @switch($typeDocument)
        @case('pembayaran')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th >Nama</th>
                        <th class="sm:hidden lg:table-cell">Nomor KK</th>
                        <th class="sm:hidden lg:table-cell">Tgl Permintaan</th>
                        <th >No. Telepon</th>
                        <th >Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($fundData['getSubmission']->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($fundData['getSubmission'] as $dataPembayaran)
                            <tr>
                                <td >{{ $dataPembayaran->resident->nama }}</td>
                                <td class="sm:hidden lg:table-cell">{{ $dataPembayaran->nomor_kk }}</td>
                                <td class="sm:hidden lg:table-cell">{{ $dataPembayaran->created_at }}</td>
                                <td >{{ $dataPembayaran->akun->noHp }}</td>
                                <td >
                                    <button class="w-[25px] h-[25px] flex-center"
                                        onclick="showPopupPembayaran({{ $dataPembayaran->id_pembayaran }})">
                                        <x-icon.detail />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div id="pagination">
                {{ $fundData['getSubmission']->appends(request()->except('validatedPage'))->links() }}
            </div>
        @break

        @case('riwayatPembayaran')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th >Nama</th>
                        <th class="sm:hidden lg:table-cell">Nomor KK</th>
                        <th class="sm:hidden lg:table-cell">Tgl Permintaan</th>
                        <th >No. Telepon</th>
                        <th >Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($history->isEmpty())
                        <tr>
                            <td class="text-center w-full">No data found</td>
                        </tr>
                    @else
                        @foreach ($history as $dataRiwayat)
                            <tr>
                                <td class=" font-medium">{{ $dataRiwayat->resident->nama }}</td>
                                <td class="sm:hidden lg:table-cell font-medium">{{ $dataRiwayat->nomor_kk }}</td>
                                <td class="sm:hidden lg:table-cell font-medium">{{ $dataRiwayat->created_at }}</td>
                                <td class=" font-medium">{{ $dataRiwayat->admin->noHp }}</td>
                                <td
                                    class=" flex items-center gap-4  {{ $dataRiwayat->status == 'Ditolak' ? 'text-red-600' : 'text-main' }} font-semibold">
                                    <span class="w-[5rem]">{{ $dataRiwayat->status }}</span>
                                    <button onclick="showRiwayatPembayaranModal({{ $dataRiwayat->id_pembayaran }})">
                                        <x-icon.detail />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div id="pagination">
                {{ $history->appends(request()->except('submissionPage'))->links() }}
            </div>
        @break
    @endswitch
@endsection
@section('script')
    <script>

        function fetchPaymentData(typeDocument = '', search = '', order = 'asc', page = 1) {
            $.ajax({
                url: '{{ route('admin.data-pembayaran.index') }}',
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
                                            onclick="showPopupPembayaran(${fundData.id_pembayaran})">
                                            <x-icon.detail />
                                        </button>
                                        </td>`
                                break;
                            case 'riwayatPembayaran':
                                lastColumn =
                                    `
                                        <td
                                            class=" flex items-center gap-4  ${fundData.status == 'Ditolak' ? 'text-red-600' : 'text-main'} font-semibold">
                                            <span class="w-[6rem]">${ fundData.status }</span>
                                            <button onclick="showRiwayatPembayaranModal(${fundData.id_pembayaran})">
                                                <x-icon.detail />
                                            </button>
                                        </td>
                                    `
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
