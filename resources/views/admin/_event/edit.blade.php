@extends('layouts.admin')
@section('head_script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endsection
@section('content')
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('admin.manajemen-berita.index') }}">
            <x-icon.back />
        </a>
        <h1 class="h1-semibold">Edit Event</h1>
    </div>

    <form action="{{ route('admin.manajemen-acara.update', ['event' => $event->id_agenda]) }}" enctype="multipart/form-data"
        class="flex flex-col gap-6 items-end" id="add_news_form" method="POST">
        @csrf
        @method('PUT')
        <section class="sm:grid-rows-4 grid grid-rows-2 grid-cols-4 gap-6 w-full">
            <div class="sm:row-span-3 md:row-span-2 sm:col-span-4 md:col-span-1  relative " id="file-1">
                <input type="file" name="gambar" id="image" class="hidden" accept=".png, .jpg">
                <label for="image" id="file-1-preview" class="dropzone absolute w-full h-full flex-center flex-col">
                    <img src="{{ $event->url_gambar }}" alt="image" class="object-contain h-full" id="imagePreview">
                </label>
            </div>
            <div class="form-group col-span-3 sm:col-span-4 md:col-span-3">
                <label for="judul" class="text-main font-semibold">Judul Acara</label>
                <input type="text" id ="judul" name ="judul" class="px-6 py-2 rounded-2xl outline-none"
                    placeholder="Tuliskan Judul Berita" value="{{ $event->judul }}" />
            </div>
            <section class="flex sm:flex-col col-span-3 sm:col-span-4 md:col-span-3 gap-3">
                <div class="form-group ">
                    <label for="penulis" class="text-main font-semibold">Penulis</label>
                    <input type="text" id ="penulis" name ="penulis" class="hidden" value="{{ $account->nama }}" />
                    <input type="text" id ="penulis" name ="penulis"
                        class="px-6 py-2 rounded-2xl outline-none bg-[#DDE9EA] text-main" value="{{ $account->nama }}"
                        readonly />
                </div>
                <div class="form-group ">
                    <label for="penulis" class="text-main font-semibold">Tanggal Acara</label>
                    <input type="date" id ="tanggal" name ="tanggal" class="px-6 py-2 rounded-2xl outline-none"
                        value="{{ date('Y-m-d', strtotime($event->tanggal)) }}" />
                </div>

            </section>
        </section>
        <section class="flex flex-col gap-3 w-full">
            <label for="description" class="text-main font-semibold">Isi Artikel</label>
            <textarea id="editor" name="isi" class="ck-editor__editable ck-editor__editable_inline">{{ $event->isi }}</textarea>
        </section>
        <button type="submit" id="submit-all" class="w-[15rem] h-[3rem] bg-main text-white rounded-2xl font-semibold">
            Upload </button>
    </form>
@endsection
@section('script')
    <script>
        // inisiasi classic editor (CKE5)
        ClassicEditor.create(document.querySelector('#editor'))
        previewBeforeUpload('file-1')
    </script>
@endsection
