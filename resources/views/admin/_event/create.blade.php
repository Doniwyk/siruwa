@extends('layouts.admin')
@section('content')
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('admin.manajemen-berita.index') }}">
            <x-icon.back />
        </a>
        <h1 class="h1-semibold">Tulis Agenda</h1>
    </div>
    <form action="{{ route('admin.manajemen-acara.store') }}" enctype="multipart/form-data" method="POST"
        class="flex flex-col gap-6 items-end" id="add_news_form">
        @csrf
        @method('POST')
        <section class="sm:grid-rows-4 grid grid-rows-2 grid-cols-4 gap-6 w-full">
            <div class="sm:row-span-3 md:row-span-2 sm:col-span-4 md:col-span-1  relative " id="file-1">
                <input type="file" name="image" id="image" class="hidden">
                <label for="image" id="file-1-preview" class="dropzone absolute w-full h-full flex-center flex-col ">
                    <div>
                        <span class="font-semibold flex-col flex-center text-main">
                            <x-icon.galery />
                            Upload Gambar
                        </span>
                    </div>
                </label>
            </div>
            <div class="form-group col-span-3 sm:col-span-4 md:col-span-3">
                <label for="judul" class="text-main font-semibold">Judul Agenda</label>
                <input type="text" id ="judul" name ="judul" class="px-6 py-2 rounded-2xl outline-none"
                    placeholder="Tuliskan Judul Berita" />
            </div>
            <section class="flex sm:flex-col col-span-3 sm:col-span-4 md:col-span-3 gap-3">
                <div class="form-group ">
                    <label for="penulis" class="text-main font-semibold">Penulis</label>
                    <input type="text" id ="penulis" name ="penulis"
                        class="px-6 py-2 rounded-2xl outline-none bg-[#DDE9EA] text-main" value="{{ $account->nama }}"
                        readonly />
                </div>
                <div class="form-group ">
                    <label for="penulis" class="text-main font-semibold">Tanggal Agenda</label>
                    <input type="date" id ="tanggal" name ="tanggal" class="px-6 py-2 rounded-2xl outline-none" />
                </div>

            </section>
        </section>
        <section class="flex flex-col gap-3 w-full">
            <label for="description" class="text-main font-semibold">Isi Artikel</label>
            <textarea id="editor" name="isi" class="ck-editor__editable ck-editor__editable_inline"></textarea>
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
