@extends('layouts.admin')
@section('title')
Data Penduduk
@endsection
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <section class="w-full flex justify-between flex-wrap gap-8">
        <div class="link-option_parrent">
            <a href="{{ route('admin.data-penduduk.index', ['typeDocument' => 'daftar-penduduk']) }}"
                class="link-option {{ $typeDocument == 'daftar-penduduk' ? 'link-option_active' : false }}">
                Daftar Penduduk
            </a>
            <a href="{{ route('admin.data-penduduk.index', ['typeDocument' => 'pengajuan']) }}"
                class="link-option {{ $typeDocument == 'pengajuan' ? 'link-option_active' : false }}">
                Pengajuan
            </a>
            <a href="{{ route('admin.data-penduduk.index', ['typeDocument' => 'riwayat']) }}"
                class="link-option {{ $typeDocument == 'riwayat' ? 'link-option_active' : false }}">
                Riwayat
            </a>
        </div>

        <div class="sm:mobile_add-wrapper relative inline-block md:hidden">
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="button-main !px-5" type="button"> ...
            </button>
        </div>

        <!-- Dropdown menu -->
        <div id="dropdown" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="{{route('admin.data-penduduk.add')}}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tambah Penduduk</a>
                </li>
                <li>
                    <a href="{{route('admin.data-penduduk.import')}}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Import .CSV</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export .Pdf</a>
                </li>
            </ul>
        </div>

        <div class="md:web_add-wrapper sm:hidden">
            <a href="{{ route('admin.data-penduduk.export') }}">
                <button class="button-white h-full">
                    <x-icon.export />
                    <label for="" class="sm:hidden md:inline cursor-pointer">
                        Export .Pdf
                    </label>
                </button>
            </a>
            <a href="{{ route('admin.data-penduduk.import') }}">
                <button class="button-white h-full">
                    <x-icon.import />
                    <label for="" class="sm:hidden md:inline cursor-pointer">
                        Import .csv
                    </label>
                </button>
            </a>
            <a href="{{ route('admin.data-penduduk.add') }}">
                <button class="flex-between gap-[10px] px-6 py-3 bg-main rounded-xl font-semibold text-white button-hover">
                    <x-icon.add-circle />
                    <label for="" class="sm:hidden md:inline cursor-pointer">
                        Tambah Data
                    </label>
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
                        <th >Nama Lengkap</th>
                        <th >NIK</th>
                        <th class=" sm:hidden md:table-cell">Tgl Lahir</th>
                        <th class="sm:hidden  md:table-cell">No. Registrasi</th>
                        <th >Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residents as $resident)
                        <tr class="hover:bg-fourth transition-all ease-linear">
                            <td class="hidden">{{ $resident->id_penduduk }}</td>
                            <td >{{ $resident->nama }}</td>
                            <td >{{ $resident->nik }}</td>
                            <td class=" sm:hidden md:table-cell">{{ $resident->tgl_lahir }}</td>
                            <td class=" sm:hidden md:table-cell">{{ $resident->id_penduduk }}</td>
                            <td class="flex-start">
                                <a class="flex-center"
                                    href="{{ route('admin.data-penduduk.show', ['resident' => $resident->id_penduduk]) }}">
                                    <x-icon.detail />
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
                        <th >Nama Lengkap</th>
                        <th >NIK</th>
                        <th class=" sm:hidden md:table-cell">Tgl Lahir</th>
                        <th class=" sm:hidden md:table-cell">No. Registrasi</th>
                        <th >Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residents as $resident)
                        <tr>
                            <td class="hidden">{{ $resident->id_penduduk }}</td>
                            <td >{{ $resident->penduduk->nama }}</td>
                            <td >{{ $resident->penduduk->nik }}</td>
                            <td class=" sm:hidden md:table-cell">{{ $resident->penduduk->tgl_lahir }}</td>
                            <td class=" sm:hidden md:table-cell">{{ $resident->penduduk->id_penduduk }}</td>
                            <td>
                                <a class="flex-start buton-hover"
                                    href="{{ route('admin.data-penduduk.edit', ['resident' => $resident['id_penduduk']]) }}">
                                    <x-icon.detail />
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
                        <th >Nama Lengkap</th>
                        <th >NIK</th>
                        <th class=" sm:hidden md:table-cell">Tgl Lahir</th>
                        <th class=" sm:hidden md:table-cell">No. Registrasi</th>
                        <th >Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residents as $resident)
                        <tr>
                            <td class="hidden">{{ $resident->id_penduduk }}</td>
                            <td >{{ $resident->penduduk->nama }}</td>
                            <td >{{ $resident->penduduk->nik }}</td>
                            <td class=" sm:hidden md:table-cell">{{ $resident->penduduk->tgl_lahir }}</td>
                            <td class=" sm:hidden md:table-cell">{{ $resident->penduduk->id_penduduk }}</td>
                            <td
                                class="font-bold sm: {{ $resident->status == 'Ditolak' ? 'text-red-600' : 'text-main' }}">
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
                                lastColumn = `<td class="flex-start ">
                                        <a class="flex-center" href=" data-penduduk/${resident.id_penduduk}/show">
                                            <x-icon.detail />
                                        </a>
                                        </td>`
                                break;
                            case 'pengajuan':
                                lastColumn = `<td >
                                    <a class="flex-start" href=" data-penduduk/${resident.id_penduduk}/edit">
                                        <x-icon.detail />
                                        </a>
                                        </td>`
                                break;
                            case 'riwayat':
                                lastColumn =
                                    `<td class="font-bold  ${resident.status == 'Ditolak' ? 'text-red-600' : 'text-main'}">${resident.status}</td>`
                                break;
                        }

                        $('#table-parent tbody').append(
                            `<tr>
                                <td >${resident.penduduk?.nama || resident.nama}</td>
                                <td >${resident.nik}</td>
                                <td class=" sm:hidden md:table-cell">${resident.tgl_lahir}</td>
                                <td class=" sm:hidden md:table-cell">${resident.id_penduduk}</td>
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
