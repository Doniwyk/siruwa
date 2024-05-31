@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <section class="w-full flex-between">
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
            Pengajuan
        </a>
        <a href="{{ route('admin.data-penduduk.index', ['typeDocument' => 'riwayat']) }}" @class([ 'link-option' , 'link-option_active'=> $typeDocument == 'riwayat',
            ])>
            Riwayat
        </a>
    </div>
    <div class="add-wrapper">
        <a href="{{route('admin.data-penduduk.import')}}">
        <button class="flex-between gap-[10px] px-6 py-3 bg-white rounded-2xl font-semibold text-main">
            <x-icon.import />
            Import .csv
        </button>
        </a>
        <a href="{{ route('admin.data-penduduk.add') }}">
            <button class="flex-between gap-[10px] px-6 py-3 bg-main rounded-2xl font-semibold text-white">
                <x-icon.add-circle />
                Tambah Data
            </button>
            <a href="{{ route('admin.data-penduduk.add') }}">
                <button class="flex-between gap-[10px] px-6 py-3 bg-main rounded-2xl font-semibold text-white">
                    <x-icon.add-circle />
                    Tambah Data
                </button>
            </a>
        </div>
    </section>

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
                                    <x-icon.detail/>
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
                            <td>{{ $resident->penduduk->nama }}</td>
                            <td>{{ $resident->penduduk->nik }}</td>
                            <td>{{ $resident->penduduk->tgl_lahir }}</td>
                            <td>{{ $resident->penduduk->no_reg }}</td>
                            <td>
                                <a class="flex-start"
                                    href="{{ route('admin.data-penduduk.edit', ['resident' => $resident['id_penduduk']]) }}">
                                    <x-icon.detail/>
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
                            <td>{{ $resident->penduduk->nama }}</td>
                            <td>{{ $resident->penduduk->nik }}</td>
                            <td>{{ $resident->penduduk->tgl_lahir }}</td>
                            <td>{{ $resident->penduduk->no_reg }}</td>
                            <td class="font-bold {{ $resident->status == 'Ditolak' ? 'text-red-600' : 'text-main' }}">
                                {{ $resident->status }}
                            </td>
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

@section('script')
    <script>
        function fetchResidentData(typeDocument = '', search = '', order = 'asc', page = 1) {
            $.ajax({
                url: '{{ route('admin.data-penduduk.index') }}',
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
                        `${window.location.origin}/admin/data-penduduk?typeDocument=${typeDocument}&search=${search}&order=${order}&page=${page}`;
                    window.history.pushState({
                        path: initialLocation
                    }, '', initialLocation);

                    const residents = data.residents;

                    $('#table-parent tbody').empty();
                    $('#pagination').empty();

                    if (!residents.length) {
                        $('#table-parent tbody').append(
                            `<tr>
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>`
                        );
                        return;
                    }

                    $.each(residents, function(index, resident) {
                        let lastColumn;
                        switch (typeDocument) {
                            case 'daftar-penduduk':
                                lastColumn = `<td class="flex-start">
                                        <a class="flex-center" href=" data-penduduk/${resident.id_penduduk}/show">
                                            <x-icon.detail />
                                        </a>
                                        </td>`
                                break;
                            case 'pengajuan':
                                lastColumn = `<td>
                                    <a class="flex-start" href=" data-penduduk/${resident.id_penduduk}/edit">
                                        <x-icon.detail />
                                        </a>
                                        </td>`
                                break;
                            case 'riwayat':
                                lastColumn = `<td>${resident.status}</td>`
                                break;
                        }

                        $('#table-parent tbody').append(
                            `<tr>
                                <td>${resident.nama}</td>
                                <td>${resident.nik}</td>
                                <td>${resident.tgl_lahir}</td>
                                <td>${resident.no_reg}</td>
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
