@extends('layouts.admin')
@section('title')
Manajemen Dokumen
@endsection
@section('modal')
    <div class="absolute min-h-full min-w-full flex items-center justify-center bg-black/50 z-50 hidden" id="document-modal_parent">
        <div class="absolute p-10 rounded-2xl  bg-white center" id="document-modal">
            <form class="flex flex-col gap-7" method="POST">
                @csrf
                @method('PUT')
                <h1 class="text-xl font-bold text-main">Catatan</h1>
                <textarea name="keterangan_status" id="keterangan_status"
                    class="h-[10rem] w-[22rem] border-2 p-2 border-outline outline-none rounded-2xl" required
                    placeholder="Masukkan catatan"></textarea>
                <button type="submit" class="text-white px-4 py-2 rounded-md font-semibold" type="submit"
                    name="status">Test</button>
            </form>
        </div>
    </div>
@endsection
@section('content')
    <h1 class="h1-semibold">Manajemen Dokumen</h1>
    <section id="tab-slider" class="flex">
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
            <a href="{{ route('admin.data-dokumen.index', ['typeDocument' => 'canBeTaken']) }}"
                @class([
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
    </section>
    @switch($typeDocument)
        @case('pengajuan')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th class="sm:text-sm md:text-base">Nama Pengaju</th>
                        <th class="sm:text-sm md:text-base">Tipe Berkas</th>
                        <th class="sm:text-sm md:text-base sm:hidden md:table-cell">Tgl Pengajuan</th>
                        <th class="sm:text-sm md:text-base sm:hidden md:table-cell">No. Registrasi</th>
                        <th class="sm:text-sm md:text-base">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($documents as $document)
                            <tr class="hover:bg-fourth transition-all ease-linear">
                                <td class="hidden">{{ $document->id_dokumen }}</td>
                                <td class="sm:text-sm md:text-base">{{ $document->penduduk->nama }}</td>
                                <td class="sm:text-sm md:text-base">{{ $document->jenis }}</td>
                                <td class="sm:text-sm md:text-base sm:hidden md:table-cell">{{ $document->created_at }}</td>
                                <td class="sm:text-sm md:text-base sm:hidden md:table-cell">{{ $document->id_dokumen }}</td>
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
                        <th class="sm:text-sm md:text-base">Nama Pengaju</th>
                        <th class="sm:text-sm md:text-base">Tipe Berkas</th>
                        <th class="sm:text-sm md:text-base sm:hidden md:table-cell">Tgl Pengajuan</th>
                        <th class="sm:text-sm md:text-base sm:hidden md:table-cell">No. Registrasi</th>
                        <th class="sm:text-sm md:text-base">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($documents as $document)
                            <tr class="hover:bg-fourth transition-all ease-linear">
                                <td class="hidden">{{ $document->id_dokumen }}</td>
                                <td class="sm:text-sm md:text-base">{{ $document->penduduk->nama }}</td>
                                <td class="sm:text-sm md:text-base sm:hidden md:table-cell">{{ $document->jenis }}</td>
                                <td class="sm:text-sm md:text-base sm:hidden md:table-cell">{{ $document->created_at }}</td>
                                <td class="sm:text-sm md:text-base">{{ $document->id_dokumen }}</td>
                                <td class="flex-start">
                                    <button class="mr-4"
                                        onclick="showPopupToContinueDocumentProccess({{ $document->id_dokumen }}, 'batalkan')"">
                                        <x-icon.cancel />
                                    </button>
                                    <button onclick="showPopupToContinueDocumentProccess({{ $document->id_dokumen }}, 'lanjut')">
                                        <x-icon.next />
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
        @break

        @case('canBeTaken')
            <table class="table-parent" id="table-parent">
                <thead>
                    <tr>
                        <th class="sm:text-sm md:text-base">Nama Pengaju</th>
                        <th class="sm:text-sm md:text-base">Tipe Berkas</th>
                        <th class="sm:text-sm md:text-base sm:hidden md:table-cell">Tgl Pengajuan</th>
                        <th class="sm:text-sm md:text-base sm:hidden md:table-cell">No. Registrasi</th>
                        <th class="sm:text-sm md:text-base">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($documents as $document)
                            <tr class="hover:bg-fourth transition-all ease-linear">
                                <td class="hidden">{{ $document->id_dokumen }}</td>
                                <td class="sm:text-sm md:text-base">{{ $document->penduduk->nama }}</td>
                                <td class="sm:text-sm md:text-base">{{ $document->jenis }}</td>
                                <td class="sm:text-sm md:text-base sm:hidden md:table-cell">{{ $document->created_at }}</td>
                                <td class="sm:text-sm md:text-base sm:hidden md:table-cell">{{ $document->id_dokumen }}</td>
                                <td class="flex-start">
                                    <form
                                        action="{{ route('admin.data-dokumen.changeIntoSelesai', ['document' => $document->id_dokumen]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="keterangan_status" class="hidden"
                                            value="{{ $document->keterangan_status }}">
                                        <button type="input"
                                            class="button-hover sm:px-5 sm:py-1 sm:text-sm md:text-base sm:font-base md:px-8 md:py-2 bg-main rounded-3xl text-white"
                                            type="submit" name="status" value="Selesai">Selesai</button>
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
                        <th class="sm:text-sm md:text-base">Nama Pengaju</th>
                        <th class="sm:text-sm md:text-base">Tipe Berkas</th>
                        <th class="sm:text-sm md:text-base sm:hidden md:table-cell">Tgl Pengajuan</th>
                        <th class="sm:text-sm md:text-base sm:hidden md:table-cell">No. Registrasi</th>
                        <th class="sm:text-sm md:text-base">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($documents->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No data found</td>
                        </tr>
                    @else
                        @foreach ($documents as $document)
                            <tr class="hover:bg-fourth transition-all ease-linear">
                                <td class="hidden">{{ $document->id_dokumen }}</td>
                                <td class="sm:text-sm md:text-base">{{ $document->penduduk->nama }}</td>
                                <td class="sm:text-sm md:text-base">{{ $document->jenis }}</td>
                                <td class="sm:text-sm md:text-base sm:hidden md:table-cell">{{ $document->created_at }}</td>
                                <td class="sm:text-sm md:text-base sm:hidden md:table-cell">{{ $document->id_dokumen }}</td>
                                <td
                                    class="sm:text-sm md:text-base  font-bold {{ $document->status == 'Dibatalkan' ? 'text-red-600' : 'text-main' }}">
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
