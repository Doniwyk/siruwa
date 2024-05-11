@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <div class="button-option_parrent">
        <button class="button-option button-option_active" onclick="activeButton(this)">Daftar Penduduk</button>
        <button class="button-option " onclick="activeButton(this)">Pengajuan</button>
        <button class="button-option " onclick="activeButton(this)">Riwayat</button>
    </div>
    <x-filter />
    <div id="daftar-penduduk">
        <table class="table-parent">
            <thead>
                <tr>
                    <th>Nama Pengaju</th>
                    <th>NIK</th>
                    <th>Tgl Permintaan</th>
                    <th>No. Telepon</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($residents as $resident)
                    <tr>
                        <td>{{ $resident['nama'] }}</td>
                        <td>{{ $resident['nik'] }}</td>
                        <td>{{ $resident['tgl_lahir'] }}</td>
                        <td>{{ $resident['noHp'] }}</td>
                        <td>
                            <button class="flex-center">
                                <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 7.75V14.5" stroke="#225157" stroke-width="2" stroke-linecap="round" />
                                    <circle cx="13" cy="17.875" r="1" fill="#51526C" stroke="#225157"
                                        stroke-width="0.25" />
                                    <path
                                        d="M24.0246 13.0001C24.0246 6.91116 19.0885 1.9751 12.9996 1.9751C6.91067 1.9751 1.97461 6.91116 1.97461 13.0001C1.97461 19.089 6.91067 24.0251 12.9996 24.0251C19.0885 24.0251 24.0246 19.089 24.0246 13.0001Z"
                                        stroke="#225157" stroke-width="2" stroke-miterlimit="10" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="py-4">
            {{ $residents->links() }}
        </div>
    </div>
    <div id="pengajuan">
        <table class="table-parent">
            <thead>
                <tr>
                    <th>Nama Pengaju</th>
                    <th>NIK</th>
                    <th>Tgl Permintaan</th>
                    <th>No. Telepon</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div id="riwayat"></div>
@endsection
