@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Manajemen Dokumen</h1>
    <div class="link-option_parrent">
        <a href="{{ route('admin.data-dokumen.index', ['typeDocument' => 'pengajuan']) }}" @class([
            'link-option',
            'link-option_active' => $typeDocument == 'pengajuan',
        ])>
            Pengajuan
        </a>
        <a href="{{ route('admin.data-dokumen.index', ['typeDocument' => 'ongoing']) }}" @class([
            'link-option',
            'link-option_active' => $typeDocument == 'ongoing',
        ])>
            Proses
        </a>
        <a href="{{ route('admin.data-dokumen.index', ['typeDocument' => 'canBeTaken']) }}" @class([
            'link-option',
            'link-option_active' => $typeDocument == 'canBeTaken',
        ])>
            Bisa Diambil
        </a>
        <a href="{{ route('admin.data-dokumen.index', ['typeDocument' => 'riwayat']) }}" @class([
            'link-option',
            'link-option_active' => $typeDocument == 'riwayat',
        ])>
            Riwayat
        </a>
    </div>
    @switch($typeDocument)
        @case('pengajuan')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Nama Pengaju</th>
                        <th>Tipe Berkas</th>
                        <th>Tgl Pengajuan</th>
                        <th>No. Telepon</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($documents as $document)
                            <tr class="hover:bg-fourth transition-all ease-linear cursor-pointer">
                                <td class="hidden">{{ $document->id_dokumen }}</td>
                                <td>{{ $document->penduduk->nama }}</td>
                                <td>{{ $document->jenis }}</td>
                                <td>{{ $document->created_at }}</td>
                                <td>{{ $document->no_reg }}</td>
                                <td class="flex-start">
                                    <a class="flex-center"
                                        href="{{ route('admin.data-dokumen.edit-data-dokumen', ['document' => $document->id_dokumen, 'typeDocument' => 'pengajuan']) }}">
                                        <x-icon.detail />
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @break

        @case('ongoing')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Nama Pengaju</th>
                        <th>Tipe Berkas</th>
                        <th>Tgl Pengajuan</th>
                        <th>No. Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($documents as $document)
                            <tr class="hover:bg-fourth transition-all ease-linear cursor-pointer">
                                <td class="hidden">{{ $document->id_dokumen }}</td>
                                <td>{{ $document->penduduk->nama }}</td>
                                <td>{{ $document->jenis }}</td>
                                <td>{{ $document->created_at }}</td>
                                <td>{{ $document->no_reg }}</td>
                                <td class="flex-start">
                                    <button class="w-10 h-10 bg-red-600" onclick="showPopup('#cancel-description')"></button>
                                    <button class="w-10 h-10 bg-main" onclick="showPopup('#approve-description')"></button>
                                </td>
                                <td class="w-full h-full flex-center bg-black/50 absolute top-0 left-0 hidden" id="modal-parent">
                                        <x-shared.action-description-form :document=$document :formId="'cancel-description'" :statusValue="'batalkan'" />
                                        <x-shared.action-description-form :document=$document :formId="'approve-description'" :statusValue="'lanjut'" />
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @break

        @case('canBeTaken')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Nama Pengaju</th>
                        <th>Tipe Berkas</th>
                        <th>Tgl Pengajuan</th>
                        <th>No. Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($documents as $document)
                            <tr class="hover:bg-fourth transition-all ease-linear cursor-pointer">
                                <td class="hidden">{{ $document->id_dokumen }}</td>
                                <td>{{ $document->penduduk->nama }}</td>
                                <td>{{ $document->jenis }}</td>
                                <td>{{ $document->created_at }}</td>
                                <td>{{ $document->no_reg }}</td>
                                <td class="flex-start">
                                    <form
                                        action="{{ route('admin.data-dokumen.changeIntoSelesai', ['document' => $document->id_dokumen]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="keterangan_status" class="hidden"
                                            value="{{ $document->keterangan_status }}">
                                        <button type="input" class="w-10 h-10 bg-main" type="submit" name="status"
                                            value="Selesai"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        @break

        @case('riwayat')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th>Nama Pengaju</th>
                        <th>Tipe Berkas</th>
                        <th>Tgl Pengajuan</th>
                        <th>No. Telepon</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($documents as $document)
                            <tr>
                                <td class="hidden">{{ $document->id_dokumen }}</td>
                                <td>{{ $document->penduduk->nama }}</td>
                                <td>{{ $document->jenis }}</td>
                                <td>{{ $document->created_at }}</td>
                                <td>{{ $document->no_reg }}</td>
                                <td class="font-bold {{ $document->status == 'Ditolak' ? 'text-red-600' : 'text-main' }}">
                                    {{ $document->status }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        @break

        @default
    @endswitch
@endsection
