@extends('layouts.admin')
@section('title')
    Tambah Berita
@endsection
@section('head_script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endsection
@section('content')
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('admin.manajemen-berita.index') }}">
            <x-icon.back />
        </a>
        <h1 class="h1-semibold">Tulis Berita</h1>
    </div>
    <form action="{{ route('admin.manajemen-berita.store') }}" enctype="multipart/form-data" method="POST"
        class="flex flex-col gap-10 items-end" id="add_news_form">
        @csrf
        @method('POST')
        <section class="sm:grid-rows-5 grid grid-rows-2 grid-cols-4 gap-6 w-full">
            <div class="sm:row-span-3 md:row-span-2 sm:col-span-4 md:col-span-1  relative">
                <div id="file-1" class="relative h-full mb-1">
                <input type="file" name="image" id="image" class="hidden" accept=".png, .jpg">
                <label for="image" id="file-1-preview" class="dropzone absolute w-full h-full flex-center flex-col">
                    <div>
                        <span class="font-semibold flex-col flex-center text-main ">
                            <x-icon.galery />
                            Upload Gambar
                        </span>
                    </div>
                </label>
                </div>
                <div id="error-image" class=" text-red-600 font-medium"></div>
            </div>
            <div class="form-group sm:col-span-4 md:col-span-3">
                <label for="judul" class="text-main font-semibold">Judul Berita <span id="error-judul" class=" text-red-600 font-medium"></span></label>
                <input type="text" id ="judul" name ="judul" class="px-6 py-2 rounded-2xl outline-none"
                    placeholder="Tuliskan Judul Berita" />
            </div>
            <div class="form-group sm:col-span-4 md:col-span-3">
                <label for="penulis" class="text-main font-semibold">Penulis</label>
                <input type="text" id ="penulis" name ="penulis" class="hidden" value="{{ $account->nama }}" />
                <input type="text" id ="penulis" name ="penulis"
                    class="px-6 py-2 rounded-2xl outline-none bg-[#DDE9EA] text-main" value="{{ $account->nama }}"
                    disabled />
            </div>
        </section>
        <section class="flex flex-col gap-3 w-full">
            <label for="description" class="text-main font-semibold">Isi Artikel <span id="error-isi" class=" text-red-600 font-medium"></span></label> 
            <textarea id="editor" name="editor" class="ck-editor__editable ck-editor__editable_inline"></textarea>
        </section>
        <section class="flex gap-3">
            <button name="action" value="draft" type="submit" id="submit-all"
                class="w-[15rem] h-[3rem] bg-white text-secondary rounded-2xl font-semibold border border-inset border-secondary">
                Draft </button>
            <button name="action" value="upload" type="submit" id="submit-all"
                class="w-[15rem] h-[3rem] bg-main text-white rounded-2xl font-semibold">
                Upload </button>
        </section>
    </form>
@endsection
@section('script')
    <script>
        // inisiasi classic editor (CKE5)
        let newsEditor;
        ClassicEditor.create(document.querySelector('#editor'))
        .then((newEditor)=>{
            newsEditor = newEditor;
        })
        previewBeforeUpload('file-1')

        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();

                const loader = $('#loader-modal_parent')
                const alerts = $('form .text-red-600.font-medium')

                const token = document.querySelector('input[name="_token"]').value;
                const titleInput = document.getElementById('judul').value;
                const descriptionInput = newsEditor.getData();
                const fileInput = document.getElementById('image');
                const file = fileInput.files[0];

                loader.removeClass('hidden')
                $.each(alerts, function(index, alert) {
                    $(alert).text('');
                });

                const formData = new FormData();
                formData.append('_token', token);
                formData.append('judul', titleInput);
                formData.append('isi', descriptionInput);
                formData.append('image', file);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.manajemen-berita.store') }}",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        loader.addClass('hidden')
                        if (response.success) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(response) {
                        loader.addClass('hidden')
                        const {errors} = response.responseJSON
                        $.each(errors, function(key, value) {
                            $('#error-' + key).html(`
                                <svg width="10" height="10" viewBox="-1 -1 8 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline">
                                    <path d="M4.85202 0.853897C5.04724 0.658676 5.04724 0.341637 4.85202 0.146416C4.6568 -0.0488052 4.33976 -0.0488052 4.14454 0.146416L2.5 1.79252L0.853897 0.147977C0.658676 -0.0472435 0.341637 -0.0472435 0.146416 0.147977C-0.0488052 0.343198 -0.0488052 0.660237 0.146416 0.855458L1.79252 2.5L0.147978 4.1461C-0.0472434 4.34132 -0.0472434 4.65836 0.147978 4.85358C0.343199 5.04881 0.660237 5.04881 0.855458 4.85358L2.5 3.20748L4.1461 4.85202C4.34132 5.04724 4.65836 5.04724 4.85358 4.85202C5.04881 4.6568 5.04881 4.33976 4.85358 4.14454L3.20748 2.5L4.85202 0.853897Z" fill="#D01C1C"/>
                                </svg><span>${value[0]}</span>
                            `);
                        });
                    }
                });
            });
        });
    </script>
@endsection
