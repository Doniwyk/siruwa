@extends('layouts.admin')
@section('title')
Data Tunggakan Iuran
@endsection
@section('content')
<div class="header-edit flex-start gap-1">
    <a href="{{ route('admin.data-pembayaran.index') }}">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z" fill="#225157" />
            </svg>
        </span>
    </a>
    <h1 class="h1-semibold">Data Tunggakan</h1>
</div>

<section class="w-full flex justify-between flex-wrap gap-8">
    <div class="link-option_parrent">
        <a href="{{ route('admin.data-pembayaran.tunggakan', ['typeDocument' => 'iuran-sampah']) }}"
            class="link-option {{ $typeDocument == 'iuran-sampah' ? 'link-option_active' : false }}">
            Iuran Sampah
        </a>
        <a href="{{ route('admin.data-pembayaran.tunggakan', ['typeDocument' => 'iuran-kematian']) }}"
            class="link-option {{ $typeDocument == 'iuran-kematian' ? 'link-option_active' : false }}">
            Iuran Kematian
        </a>
    </div>
</section>

<x-filter :typeDocument=$typeDocument :search="$search" :order="$order" />

@switch($typeDocument)
    @case('iuran-sampah')
        <table class="table-parent" id="table-parent">
            <thead>
                <tr>
                    <th class="">Nama Kepala Keluarga</th>
                    <th class="md:table-cell ">Nomor KK</th>
                    <th class="">Total Tunggakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTunggakan as $tunggakan)
                    <tr>
                        <td class="">{{ $tunggakan->head_of_family }}</td>
                        <td class="md:table-cell ">{{ $tunggakan->nomor_kk }}</td>
                        <td class="">Rp. {{ number_format($tunggakan->total_tunggakan_sampah * 10000, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @break
    @case('iuran-kematian')
        <table class="table-parent" id="table-parent">
            <thead>
                <tr>
                    <th class="">Nama Kepala Keluarga</th>
                    <th class="md:table-cell ">Nomor KK</th>
                    <th class="">Total Tunggakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTunggakan as $tunggakan)
                <tr>
                    <td class="">{{ $tunggakan->head_of_family }}</td>
                    <td class="md:table-cell ">{{ $tunggakan->nomor_kk }}</td>
                    <td class="">Rp. {{ number_format($tunggakan->total_tunggakan_kematian * 10000, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @break
    @default
@endswitch
<script>
    function fetchTunggakanData(typeDocument = '', search = '', order = 'asc') {
        $.ajax({
            url: '{{ route('admin.data-pembayaran.tunggakan') }}',
            type: 'GET',
            dataType: 'json',
            data: {
                typeDocument: typeDocument,
                search: search,
                order: order,
            },
            success: function(data) {
                console.log(data)
                const initialLocation =
                    `${window.location.origin}/admin/data-pembayaran/tunggakan?typeDocument=${typeDocument}&search=${search}&order=${order}`;
                window.history.pushState({
                    path: initialLocation
                }, '', initialLocation);

                const dataTunggakan = data.dataTunggakan;

                $('#table-parent tbody').empty();

                if (!dataTunggakan.length) {
                    $('#table-parent tbody').append(
                        `<tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>`
                    );
                    return;
                }

                $.each(dataTunggakan, function(index, dataTunggakan) {
                    $('#table-parent tbody').append(
                        `<tr>
                            <td class="">${dataTunggakan.head_of_family}</td>
                            <td class="">${dataTunggakan.nomor_kk}</td>
                            <td class="">Rp. ${(dataTunggakan.total_tunggakan_sampah * 10000).toLocaleString('id-ID')}</td>
                        </tr>`
                    )
                })
            },
            error: function(xhr, status, error) {
                console.error("Error: " + status + " " + error);
            }
        });
    }
</script>
@endsection
