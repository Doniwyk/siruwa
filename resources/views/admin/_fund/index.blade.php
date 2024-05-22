@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <div class="summary-card_fund">
        <x-card :label="'Dana Kematian'" :value="9000000" />
        <x-card :label="'Dana Sampah'" :value="9000000" />
        <x-card :label="'Tunggakan'" :type="'danger'" :value="9000000" />
    </div>
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
    <x-filter />
    @switch($typeDocument)
        @case('pembayaran')
            <table class="table-parent">
                <thead>
                    <tr>
                        <th>Nomor KK</th>
                        <th>Tgl Permintaan</th>
                        <th>No. Telepon</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fundData as $data)
                        <tr>
                            <td>{{ $data->nomor_kk }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->admin->noHp }}</td>
                            <td>
                                <button class="w-[25px] h-[25px] flex-center" onclick="showPopup('#payment-card')">
                                    <x-icon.detail />
                                </button>
                            </td>
                            <td class="w-full h-full flex-center bg-black/50 absolute top-0 left-0 hidden" id="modal-parent">
                                <x-shared.confirmation-payment-card :formId="'payment-card'" :fundData="$data" :statusValue="$data->status" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @break

        @case('riwayat')
        @break

        @default
    @endswitch
@endsection
