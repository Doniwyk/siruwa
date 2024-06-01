@extends('layouts.admin')
@section('modal')
    <div class="absolute min-h-full min-w-full flex-center bg-black/50 hidden z-50" id="payment-modal_parent">
        <div class="p-10 rounded-2xl bg-white center z-50 overflow-hidden" id="payment-modal">
            <form class="flex flex-col gap-9" method="POST">
                @csrf
                @method('PUT')
                <input type="text" class="hidden" value="{{$adminId}}" name="id_admin">
                <h1 class="text-xl font-bold text-main text-center">Konfirmasi Pembayaran</h1>
                <div id="image-preview" class="h-[11.75rem] flex-center">
                    <img src="" alt="Bukti Pembayaran" class="h-full bg-white">
                </div>
                <fieldset>
                    <div class="flex gap-4 justify-between items-center">
                        <label for="metode_display bg-main">Metode Pembayaran</label>
                        <input type="text" name="metode" id="metode" value="" class="hidden">
                        <input type="text" name="metode_display" id="metode_display"
                            class="w-[17.25rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline" value=""
                            disabled>
                    </div>
                    <div class="flex gap-4 justify-between mt-4 items-center">
                        <label for="jumlah_display ">Konfirmasi Nominal</label>
                        <input type="text" name="jumlah" id="jumlah" value="" class="hidden">
                        <input type="text" name="jumlah_display" id="jumlah_display"
                            class="w-[17.25rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline" value=""
                            disabled>
                    </div>
                </fieldset>
                <div class="wrapper flex gap-5">
                    <button class="mt-5 bg-red-600 text-white px-4 py-2 rounded-3xl flex-1" type="submit" name="action"
                        value="tolak"> Tolak</button>
                    <button type="submit" class="mt-5 bg-main text-white px-4 py-2 rounded-3xl flex-1" name="action"
                        value="terima"> Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <div class="summary-card_fund ">
        <x-card :label="'Dana Kematian'" :value="$fundData['deathFundTotal']" />
        <x-card :label="'Dana Sampah'" :value="$fundData['garbageFundTotal']" />
        <x-card :label="'Tunggakan'" :type="'danger'" :value="$fundData['tunggakan']" />
    </div>
    <section id="tab-slider" class="flex">
        <div class="link-option_parrent">
            <a href="{{ route('admin.data-pembayaran.index', ['typeDocument' => 'pembayaran']) }}"
                @class([
                    'link-option',
                    'link-option_active' => $typeDocument == 'pembayaran',
                ])>Pembayaran</a>
            <a href="{{ route('admin.data-pembayaran.index', ['typeDocument' => 'riwayat']) }}"
                @class([
                    'link-option',
                    'link-option_active' => $typeDocument == 'riwayat',
                ])>Riwayat</a>
        </div>
    </section>
    <x-filter />
    @switch($typeDocument)
        @case('pembayaran')
            <table class="table-parent">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor KK</th>
                        <th class="sm:hidden lg:table-cell">Tgl Permintaan</th>
                        <th >No. Telepon</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($fundData['getSubmission'] as $data)
                        <tr>
                            <td>{{ $data->resident->nama }}</td>
                            <td>{{ $data->nomor_kk }}</td>
                            <td class="sm:hidden lg:table-cell">{{ $data->created_at }}</td>
                            <td>{{ $data->admin->noHp }}</td>
                            <td>
                                <button class="w-[25px] h-[25px] flex-center" id="button-{{ $i }}"
                                    onclick="getDataPembayaran({{ $data->id_pembayaran }})">
                                    <x-icon.detail />
                                </button>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $fundData['getSubmission']->appends(request()->except('validatedPage'))->links() }}
            </div>
        @break

        @case('riwayat')
            <table class="table-parent">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor KK</th>
                        <th class="sm:hidden lg:table-cell">Tgl Permintaan</th>
                        <th>No. Telepon</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($history as $data)
                        <tr>
                            <td>{{ $data->resident->nama }}</td>
                            <td>{{ $data->nomor_kk }}</td>
                            <td class="sm:hidden lg:table-cell">{{ $data->created_at }}</td>
                            <td>{{ $data->admin->noHp }}</td>
                            <td class="font-semibold {{ $data->status == 'Ditolak' ? 'text-red-600' : 'text-main' }}">
                                {{ $data->status }}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $history->appends(request()->except('submissionPage'))->links() }}
            </div>
        @break
    @endswitch
@endsection
