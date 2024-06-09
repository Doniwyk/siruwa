@extends('layouts.admin')
{{-- @dd($history) --}}
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
    <div class="absolute min-h-full min-w-full flex justify-center items-center hidden bg-black/50  z-50"
        id="riwayat-payment-modal_parent">
        <div class="sm:w-[25rem] md:w-[32.5rem] p-10 rounded-2xl bg-white center z-50 overflow-hidden flex flex-col gap-9 items-center"
            id="riwayat-payment-modal">
            <h1 class="text-xl font-bold text-main text-center">Detail Status Pembayaran</h1>
            <span class="font-semibold">
                <span class="text-main">Status: </span>
                <span id="riwayat-status"></span>
            </span>
            <fieldset class="flex flex-col gap-9 w-full">
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex justify-between items-center w-full">
                        <label for="riwayat-metode_pembayaran" class="sm:text-sm text-nowrap text-secondary pr-4">Metode Pembayaran</label>
                        <input type="text" name="riwayat-metode_pembayaran" id="riwayat-metode_pembayaran"
                            class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline shrink bg-input-disabled text-text-input-disabled"
                            value="" disabled>
                    </div>
                    <div class="flex justify-between mt-4 items-center w-full">
                        <label for="riwayat-jumlah_pembayaran" class="sm:text-sm text-nowrap text-secondary pr-5">Konfirmasi Nominal</label>
                        <input type="text" name="riwayat-jumlah-pembayaran" id="riwayat-jumlah_pembayaran"
                            class="w-full py-2 px-4 outline-none rounded-2xl border-2 border-outline bg-input-disabled text-text-input-disabled"
                            value="" disabled>
                    </div>
                </div>
                <div id="riwayat-bukti_pembayaran" class="h-[15rem] flex-center w-full">
                    <div class="animate-pulse w-full h-full bg-slate-500 rounded-2xl">
                        <img src="" alt="Bukti Pembayaran" class="h-full w-full bg-white object-contain">
                    </div>
                </div>
            </fieldset>
            <button class=" bg-main text-white px-[5.5rem] py-2 rounded-3xl flex-1" name="action"
                value="terima">Baik</button>
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
                        <th class="sm:text-sm md:text-base">Nama</th>
                        <th class="sm:hidden lg:table-cell">Nomor KK</th>
                        <th class="sm:hidden lg:table-cell">Tgl Permintaan</th>
                        <th class="sm:text-sm md:text-base">No. Telepon</th>
                        <th class="sm:text-sm md:text-base">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($fundData['getSubmission']->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($fundData['getSubmission'] as $dataPembayaran)
                            <tr>
                                <td class="sm:text-sm md:text-base">{{ $dataPembayaran->resident->nama }}</td>
                                <td class="sm:hidden lg:table-cell">{{ $dataPembayaran->nomor_kk }}</td>
                                <td class="sm:hidden lg:table-cell">{{ $dataPembayaran->created_at }}</td>
                                <td class="sm:text-sm md:text-base">{{ $dataPembayaran->akun->noHp }}</td>
                                <td class="sm:text-sm md:text-base">
                                    <button class="w-[25px] h-[25px] flex-center" id="button-{{ $i }}"
                                        onclick="getDataPembayaran({{ $dataPembayaran->id_pembayaran }})">
                                        <x-icon.detail />
                                    </button>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
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
                        <th class="sm:text-sm md:text-base">Nama</th>
                        <th class="sm:hidden lg:table-cell">Nomor KK</th>
                        <th class="sm:hidden lg:table-cell">Tgl Permintaan</th>
                        <th class="sm:text-sm md:text-base">No. Telepon</th>
                        <th class="sm:text-sm md:text-base">Detail</th>
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
                                <td class="sm:text-sm md:text-base font-medium">{{ $dataRiwayat->resident->nama }}</td>
                                <td class="sm:hidden lg:table-cell font-medium">{{ $dataRiwayat->nomor_kk }}</td>
                                <td class="sm:hidden lg:table-cell font-medium">{{ $dataRiwayat->created_at }}</td>
                                <td class="sm:text-sm md:text-base font-medium">{{ $dataRiwayat->admin->noHp }}</td>
                                <td
                                    class=" flex items-center justify-between gap-4 sm:text-sm md:text-base {{ $dataRiwayat->status == 'Ditolak' ? 'text-red-600' : 'text-main' }} font-semibold">
                                    <span>{{ $dataRiwayat->status }}</span>
                                    <button onclick="showRiwayatPembayaranModal({{$dataRiwayat->id_pembayaran}})">
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
        let image = $('.animate-pulse img');
        let imageUrl = image.attr('src');
        let hasLoaded = localStorage.getItem('imageLoaded');

        if (!hasLoaded) {
            image.on('load', function() {
                $('.animate-pulse').addClass('bg-white');
                localStorage.setItem('imageLoaded', true);
                $('.animate-pulse').addClass('bg-white');
            });
        } else {
            $('.animate-pulse').removeClass('animate-pulse');
            $('.animate-pulse').removeClass('animate-pulse');
        }

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
                                    `
                                        <td
                                            class=" flex items-center justify between gap-4 sm:text-sm md:text-base ${fundData.status == 'Ditolak' ? 'text-red-600' : 'text-main'} font-semibold">
                                            <span>${ fundData.status }</span>
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
