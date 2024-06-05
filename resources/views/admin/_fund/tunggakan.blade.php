@extends('layouts.admin')



@section('content')
<div class="header-edit flex-start gap-1">
    <a href="{{ route('admin.data-penduduk.index') }}">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z" fill="#225157" />
            </svg>
        </span>
    </a>
    <h1 class="h1-semibold">{{ $title }}</h1>
</div>

<main>
    <table class="table-resident">
        <thead>
            <tr>
                <th class="sm:hidden">Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Total Tunggakan Kematian</th>
                <th>Total Tunggakan Sampah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataTunggakan as $tunggakan)
                <tr>
                    <td class="sm:hidden">{{ $tunggakan->nomor_kk }}</td>
                    <td>{{ $tunggakan->head_of_family }}</td>
                    <td>{{ $tunggakan->total_tunggakan_kematian}}</td>
                    <td>{{ $tunggakan->total_tunggakan_sampah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <h2>Tunggakan Sampah</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Total Tunggakan Kematian</th>
                <th>total Tunggakan Sampah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataTunggakan['sampah'] as $tunggakan)
                <tr>
                    <td>{{ $tunggakan->nomor_kk }}</td>
                    <td>{{ $tunggakan->head_of_family }}</td>
                    <td>{{ $tunggakan->total_tunggakan_kematian }}</td>
                    <td>{{ $tunggakan->total_tunggakan_sampah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</main>
@endsection
