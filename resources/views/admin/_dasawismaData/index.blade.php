@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <div class="link-option_parrent">
        <a href="{{ route('admin.data-penduduk.index', ['typeDocument' => 'daftar-penduduk']) }}"
            @class([
                'link-option',
                'link-option_active' => $typeDocument == 'daftar-penduduk',
            ])>
            Daftar Penduduk
        </a>
        <a href="{{ route('admin.data-penduduk.index', ['typeDocument' => 'pengajuan']) }}" @class([
            'link-option',
            'link-option_active' => $typeDocument == 'pengajuan',
        ])>
            Pengajuan
        </a>
        <a href="{{ route('admin.data-penduduk.index', ['typeDocument' => 'riwayat']) }}" @class([
            'link-option',
            'link-option_active' => $typeDocument == 'riwayat',
        ])>
            Riwayat
        </a>
    </div>

    <x-filter :typeDocument=$typeDocument :search="$search" :order="$order" />


    @switch($typeDocument)
        @case('daftar-penduduk')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Tgl Lahir</th>
                        <th>No. Registrasi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residents as $resident)
                        <tr class="hover:bg-fourth transition-all ease-linear cursor-pointer">
                            <td class="hidden">{{ $resident->id_penduduk }}</td>
                            <td>{{ $resident->nama }}</td>
                            <td>{{ $resident->nik }}</td>
                            <td>{{ $resident->tgl_lahir }}</td>
                            <td>{{ $resident->no_reg }}</td>
                            <td class="flex-start">
                                <a class="flex-center"
                                    href="{{ route('admin.data-penduduk.show', ['resident' => $resident->id_penduduk]) }}">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 7.75V14.5" stroke="#225157" stroke-width="2" stroke-linecap="round" />
                                        <circle cx="13" cy="17.875" r="1" fill="#51526C" stroke="#225157"
                                            stroke-width="0.25" />
                                        <path
                                            d="M24.0246 13.0001C24.0246 6.91116 19.0885 1.9751 12.9996 1.9751C6.91067 1.9751 1.97461 6.91116 1.97461 13.0001C1.97461 19.089 6.91067 24.0251 12.9996 24.0251C19.0885 24.0251 24.0246 19.089 24.0246 13.0001Z"
                                            stroke="#225157" stroke-width="2" stroke-miterlimit="10" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="py-4" id="pagination">
                {{ $residents->links() }}
            </div>
        @break

        @case('pengajuan')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Tgl Lahir</th>
                        <th>No. Registrasi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residents as $resident)
                            <tr>
                                <td class="hidden">{{ $resident->id_penduduk }}</td>
                                <td>{{ $resident->nama }}</td>
                                <td>{{ $resident->nik }}</td>
                                <td>{{ $resident->tgl_lahir }}</td>
                                <td>{{ $resident->no_reg }}</td>
                                <td>
                                    <a class="flex-start"
                                        href="{{ route('admin.data-penduduk.edit', ['resident' => $resident['id_penduduk']]) }}">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 7.75V14.5" stroke="#225157" stroke-width="2" stroke-linecap="round" />
                                            <circle cx="13" cy="17.875" r="1" fill="#51526C" stroke="#225157"
                                                stroke-width="0.25" />
                                            <path
                                                d="M24.0246 13.0001C24.0246 6.91116 19.0885 1.9751 12.9996 1.9751C6.91067 1.9751 1.97461 6.91116 1.97461 13.0001C1.97461 19.089 6.91067 24.0251 12.9996 24.0251C19.0885 24.0251 24.0246 19.089 24.0246 13.0001Z"
                                                stroke="#225157" stroke-width="2" stroke-miterlimit="10" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="py-4" id="pagination">
                {{ $residents->links() }}
            </div>
        @break

        @case('riwayat')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Tgl Lahir</th>
                        <th>No. Registrasi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residents as $resident)
                            <tr>
                                <td class="hidden">{{ $resident->id_penduduk }}</td>
                                <td>{{ $resident->nama }}</td>
                                <td>{{ $resident->nik }}</td>
                                <td>{{ $resident->tgl_lahir }}</td>
                                <td>{{ $resident->no_reg }}</td>
                                <td class="font-bold {{$resident->status == 'Ditolak' ? 'text-red-600' : 'text-main'}}">{{ $resident->status }}</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="py-4" id="pagination">
                {{ $residents->links() }}
            </div>
        @break

        @default
    @endswitch
@endsection
