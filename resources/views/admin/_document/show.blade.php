@extends('layouts.admin')
@section('content')
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('admin.data-dokumen.index') }}">
            <span>
                <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z"
                        fill="#225157" />
                </svg>
            </span>
        </a>
        <h1 class="h1-semibold">Detail Dokumen</h1>
    </div>
    <main class="bg-white py-9 px-24 rounded-2xl flex flex-col gap-9">
        <form class="grid grid-cols-2 grid-rows-4 gap-4" method="POST" action="{{ route('admin.data-dokumen.validateDocument', ['document' => $document->id_dokumen, 'status']) }}">
            @csrf
            @method('PUT')
            <div class="form-group col-span-2">
                <label for="nama" class="text-label_light">Jenis Dokumen</label>
                <input type="text" name="typeDocument" id="nama" class="form-control" disabled
                    value="{{ $document->jenis }}">
            </div>
            <div class="form-group">
                <label for="nama" class="text-label_light">Nama Lengkap</label>
                <input type="text" name="name" id="nama" class="form-control" disabled
                    value="{{ $document->penduduk->nama }}">
            </div>
            <div class="form-group">
                <label for="nama" class="text-label_light">Tanggal Pengajuan</label>
                <input type="text" name="date" id="nama" class="form-control" disabled
                    value="{{ $document->created_at->format('d/m/Y') }}">
            </div>
            <div class="form-group row-span-2">
                <label for="nama" class="text-label_light">Deskripsi</label>
                <textarea type="text" name="description" id="nama" class="form-control min-h-[10rem] text-left " disabled>{{ $document->keperluan }}</textarea>
            </div>
        </form>
    </main>
@endsection
