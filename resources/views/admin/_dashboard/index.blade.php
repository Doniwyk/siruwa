@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Manajemen Dashboard</h1>
    <section class="flex flex-col gap-4">
        <div class="flex-between">
            <h3 class="sm:text-xl md:text-2xl font-semibold text-main">Statistik Desa</h3>
            <div>
                <button id="cancelEditDetailRw" class="hidden">
                    <x-icon.cancel/>
                </button>
                <button id="editDetailRw">
                    <x-icon.edit/>
                </button>
            </div>
        </div>
        <form class="flex flex-col items-end gap-9" id="rw-details" >
            <div class="w-full bg-main rounded-2xl flex flex-col items-center py-6 md:px-[3.5rem] sm:gap-5 md:gap-9">
                <h1 class="text-white font-semibold sm:text-2xl md:text-[32px]">Sumberjo dalam Angka</h1>

                <fieldset action="" class="w-full flex h-full  justify-center flex-wrap sm:gap-2 md:gap-10">
                    <div class="sm:w-full flex sm:flex-row md:flex-col sm:gap-1 md:gap-5 items-center sm:basis-1/2">
                        <span class="input_profile-rw" >{{ $residentTotal }}</span>
                        <label for="penduduk_total" class="label_profile-rw sm:text-base">Penduduk</label>
                    </div>
                    <div class="sm:w-full flex sm:flex-row md:flex-col sm:gap-1 md:gap-5 items-center sm:basis-1/2">
                        <input type="text" id="fasilitas-pendidikan_total" class="input_profile-rw"
                            value="{{ $rwData->fasilitas_pendidikan }}" disabled="disabled">
                        <label for="fasilitas-pendidikan_total" class="label_profile-rw sm:text-base">Fasilitas Pendidikan</label>
                    </div>
                    <div class="sm:w-full flex sm:flex-row md:flex-col sm:gap-1 md:gap-5 items-center sm:basis-1/2">
                        <input type="text" id="fasilitas-kesehatan_total" class="input_profile-rw"
                            value="{{ $rwData->fasilitas_kesehatan }}" disabled="disabled">
                        <label for="fasilitas-kesehatan_total"class="label_profile-rw sm:text-base">Fasilitas Kesehatan</label>
                    </div>
                    <div class="sm:w-full flex sm:flex-row md:flex-col sm:gap-1 md:gap-5 items-center sm:basis-1/2">
                        <input type="text" id="fasilitas-administrasi_total" class="input_profile-rw"
                            value="{{ $rwData->fasilitas_administrasi }}" disabled="disabled">
                        <label for="fasilitas-administrasi_total"class="label_profile-rw sm:text-base">Fasilitas Administrasi</label>
                    </div>
                </fieldset>

            </div>
            <button type="submit" class="button-main sm:text-sm hidden" id="button-save-details-rw">Simpan Perubahan</button>
        </form>
    </section>
    <section>
        <div class="flex-between">
            <h3 class="sm:text-xl md:text-2xl font-semibold text-main">Gambar Struktur Organisasi</h3>
            <div>
                <button id="cancelEditImageRw" class="hidden">
                    <x-icon.cancel/>
                </button>
                <button id="editImageRw">
                    <x-icon.edit/>
                </button>
            </div>
        </div>
        <div class="w-full h-[22rem] relative mt-4" id="file-1">
            <img src="{{$rwData->image}}" alt="image" class="w-full h-full object-contain" id="previewImageRwStructure">
            <form action="" class="hidden" id="formimageRwStructure">
                <input type="file" name="image" id="image" class="hidden">
                <label for="image" id="file-1-preview" class="dropzone absolute w-full h-full flex-center flex-col">
                    <div>
                        <span class="font-semibold flex-col flex-center text-main ">
                            <x-icon.galery />
                            Upload Gambar
                        </span>
                    </div>
                </label>
            </form>
        </div>
    </section>
@endsection
@section('script')
    <script>
        previewBeforeUpload('file-1');

        function disableForm(formId, disableButtonId, enableButtonId) {
            $(formId).find('input')
                .attr('disabled', 'disabled')
                .removeClass('enable-input_profile-rw');
            $(disableButtonId).addClass('hidden');
            $(enableButtonId).removeClass('hidden');
            $('#button-save-details-rw').addClass('hidden')
        }

        function enableForm(formId, disableButtonId, enableButtonId) {
            $(formId).find('input')
                .removeAttr('disabled')
                .addClass('enable-input_profile-rw');
            $(disableButtonId).removeClass('hidden');
            $(enableButtonId).addClass('hidden');
            $('#button-save-details-rw').removeClass('hidden')
        }

        $('#cancelEditDetailRw').click(function() {
            disableForm('#rw-details', '#cancelEditDetailRw', '#editDetailRw');
        });

        $('#editDetailRw').click(function() {
            enableForm('#rw-details', '#cancelEditDetailRw', '#editDetailRw');
        });

        $('#cancelEditImageRw').click(function() {
            $('#previewImageRwStructure').removeClass('hidden')
            $('#formimageRwStructure').addClass('hidden')
            $('#editImageRw').removeClass('hidden')
            $('#cancelEditImageRw').addClass('hidden')
        });
        
        $('#editImageRw').click(function() {
            $('#previewImageRwStructure').addClass('hidden')
            $('#formimageRwStructure').removeClass('hidden')
            $('#cancelEditImageRw').removeClass('hidden')
            $('#editImageRw').addClass('hidden')
        });
    </script>
@endsection
