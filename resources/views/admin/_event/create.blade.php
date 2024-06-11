@extends('layouts.admin')
@section('head_script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endsection
@section('content')
    <div class="header-edit flex-start gap-1">
        <a href="{{ route('admin.manajemen-berita.index') }}">
            <x-icon.back />
        </a>
        <h1 class="h1-semibold">Tulis Agenda</h1>
    </div>
    <form action="{{ route('admin.manajemen-acara.store') }}" enctype="multipart/form-data" method="POST"
        class="flex flex-col gap-10 items-end" id="add_news_form">
        @csrf
        @method('POST')
        <section class="sm:grid-rows-4 grid grid-rows-2 grid-cols-4 gap-6 w-full">
            <div class="sm:row-span-3 md:row-span-2 sm:col-span-4 md:col-span-1  relative">
                <div id="file-1" class="relative h-full mb-1">
                    <input type="file" name="image" id="image" class="hidden" accept=".png, .jpg">
                    <label for="image" id="file-1-preview" class="dropzone absolute w-full h-full flex-center flex-col ">
                        <div>
                            <span class="font-semibold flex-col flex-center text-main">
                                <x-icon.galery />
                                Upload Gambar
                            </span>
                        </div>
                    </label>
                </div>
                <div id="error-image" class=" text-red-600 font-medium"></div>
            </div>
            <div class="form-group col-span-3 sm:col-span-4 md:col-span-3">
                <label for="judul" class="text-main font-semibold">Judul Agenda</label>
                <input type="text" id ="judul" name ="judul" class="px-6 py-2 rounded-2xl outline-none"
                    placeholder="Tuliskan Judul Berita" />
                <div id="error-judul" class=" text-red-600 font-medium"></div>

            </div>
            <section class="flex sm:flex-col col-span-3 sm:col-span-4 md:col-span-3 gap-3">
                <div class="form-group ">
                    <label for="penulis" class="text-main font-semibold">Penulis</label>
                    <input type="text" id ="penulis" name ="penulis"
                        class="px-6 py-2 rounded-2xl outline-none bg-[#DDE9EA] text-main" value="{{ $account->nama }}"
                        readonly />
                <div id="error-penulis" class=" text-red-600 font-medium"></div>

                </div>
                <div class="form-group ">
                    <label for="penulis" class="text-main font-semibold">Tanggal Agenda</label>
                    <input type="date" id ="tanggal" name ="tanggal" class="px-6 py-2 rounded-2xl outline-none" />
                <div id="error-tanggal" class=" text-red-600 font-medium"></div>

                </div>

            </section>
        </section>
        <section class="flex flex-col gap-3 w-full">
            <label for="description" class="text-main font-semibold">Isi Artikel</label>
            <textarea id="editor" name="isi" class="ck-editor__editable ck-editor__editable_inline"></textarea>
            <div id="error-isi" class=" text-red-600 font-medium"></div>
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
        let eventEditor;
        ClassicEditor.create(document.querySelector('#editor'))
        .then((newEditor)=>{
            eventEditor = newEditor;
        });
        previewBeforeUpload('file-1');

        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();

                const loader = $('#loader-modal_parent')
                const alerts = $('form .text-red-600.font-medium')

                const token = document.querySelector('input[name="_token"]').value;
                const titleInput = document.getElementById('judul').value;
                const descriptionInput = eventEditor.getData();
                const dateInput = document.getElementById('tanggal').value;
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
                formData.append('tanggal', dateInput);
                formData.append('image', file);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.manajemen-acara.store') }}",
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
                            $('#error-' + key).text(value[0]);
                        });
                    }
                });
            });
        });
    </script>
@endsection
