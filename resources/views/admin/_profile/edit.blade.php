@extends('layouts.admin')
@section('title')
Edit Profil
@endsection
@section('modal')
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-10 hidden" id="success-modal">
        <div class="flex flex-col bg-white rounded-2xl p-10 gap-9">
            <div class="flex flex-col items-center justify-center gap-4">
                <svg width="64" height="65" viewBox="0 0 64 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M32 64.5C40.4869 64.5 48.6263 61.1286 54.6274 55.1274C60.6286 49.1263 64 40.9869 64 32.5C64 24.0131 60.6286 15.8737 54.6274 9.87258C48.6263 3.87142 40.4869 0.5 32 0.5C23.5131 0.5 15.3737 3.87142 9.37258 9.87258C3.37142 15.8737 0 24.0131 0 32.5C0 40.9869 3.37142 49.1263 9.37258 55.1274C15.3737 61.1286 23.5131 64.5 32 64.5ZM46.125 26.625L30.125 42.625C28.95 43.8 27.05 43.8 25.8875 42.625L17.8875 34.625C16.7125 33.45 16.7125 31.55 17.8875 30.3875C19.0625 29.225 20.9625 29.2125 22.125 30.3875L28 36.2625L41.875 22.375C43.05 21.2 44.95 21.2 46.1125 22.375C47.275 23.55 47.2875 25.45 46.1125 26.6125L46.125 26.625Z"
                        fill="#225157" />
                </svg>
                <div class="text-xl font-semibold text-secondary">
                    Perubahan Berhasil Disimpan
                </div>
            </div>
            <div class="flex justify-center">
                <button type="button" id="close-modal-button"
                    class="w-52 bg-secondary text-stone-50 font-semibold py-3 rounded-2xl flex justify-center items-center"
                    onclick="closeModal(this)">
                    Baik
                </button>
            </div>
        </div>
    </div>
@endsection
@section('content')
    {{-- <div id="response-message"></div> --}}
    <div class="h1-semibold">Edit Profil</div>
    <div class="bg-white p-9 rounded-2xl flex mb-6">
        <form action="" class="flex sm:flex-col lg:flex-row gap-9 w-full " id="update-personal-data"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Foto Profil -->
            <fieldset class="shrink-0 h-[21rem] flex flex-col relative items-center " x-data="imageHandler()">
                <span class="mb-6 block text-2xl font-semibold text-secondary w-full">Foto Profil</span>
                <div class="relative w-[21rem] h-[16rem] cursor-pointer object-contain"
                    @click="$refs.profileImageUpload.click()">
                    <input type="file" x-ref="profileImageUpload" class="hidden" accept="image/*"
                        @change="loadFile($event)" name="urlProfile" id="urlProfile">
                    <img id="profile-image" class="w-full h-full rounded-xl absolute object-contain"
                        :src="croppedImageUrl || '{{ $account->urlProfile }}'" alt="Profil" />
                    <span class="w-full h-full group  opacity-50 rounded-xl absolute object-contain"></span>
                    <span
                        class="w-[21rem] h-[16rem] group absolute flex flex-col justify-center items-center gap-2 object-contain">
                        <img class="block w-12 opacity-100" src="{{ asset('assets/icons/upload-profile.svg') }}"
                            alt="Upload" />
                        <span class="text-white font-medium">Upload Foto Profil</span>
                    </span>
                </div>
            </fieldset>

            <!-- Identitas Diri -->
            <fieldset class="w-full flex flex-col">
                <span class="mb-6 block text-2xl font-semibold text-secondary">Identitas Diri</span>
                <div class="grid gap-x-9 gap-y-5 sm:grid-cols-1 sm:grid-rows-6 lg:grid-cols-2 lg:grid-rows-2">
                    <x-form.show-input-form :label="'Nama Lengkap'" :name="'nama'" :value="$resident->nama" />
                    <x-form.text-input-form label="Email" name="email" :value="$account->email" />
                    <x-form.show-input-form :label="'Alamat Lengkap'" :name="'alamat'" :value="$resident->alamat" />
                    <x-form.text-input-form label="Username" name="username" :value="$account->username" />
                    <x-form.show-input-form :label="'Role'" :name="'role'" :value="$account->role" />
                    <x-form.text-input-form label="No. Telepon" name="noHp" :value="$account->noHp" />
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn-main button-hover mt-6">Simpan Perubahan</button>
                </div>
            </fieldset>
        </form>

    </div>

    <div class="bg-white p-9 rounded-2xl mb-6">
        <span class="mb-6 block text-2xl font-semibold text-secondary">Ubah Password</span>
        <form action="" method="post" id="update-password" class="flex flex-col gap-9">
            @csrf
            @method('PUT')
            <div class="grid lg:grid-cols-3 lg:grid-flow-row gap-x-9 gap-y-5">
                <x-form.text-input-form type="password" label="Password Lama" name="current_password" />
                <x-form.text-input-form type="password" label="Password Baru" name="new_password" />
                <x-form.text-input-form type="password" label="Konfirmasi Password" name="new_password_confirmation" />
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn-main button-hover">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        function imageHandler() {
            return {
                croppedImageUrl: null,
                loadFile(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const img = new Image();
                            img.onload = () => {
                                const canvas = document.createElement('canvas');
                                canvas.width = 335;
                                canvas.height = 255;
                                const ctx = canvas.getContext('2d');

                                // Calculate cropping area
                                let offsetX = 0;
                                let offsetY = 0;
                                let cropWidth = img.width;
                                let cropHeight = img.height;

                                if (img.width > img.height) {
                                    cropWidth = img.height * (335 / 255);
                                    offsetX = (img.width - cropWidth) / 2;
                                } else {
                                    cropHeight = img.width * (255 / 335);
                                    offsetY = (img.height - cropHeight) / 2;
                                }

                                ctx.drawImage(img, offsetX, offsetY, cropWidth, cropHeight, 0, 0, 335,
                                    255);
                                this.croppedImageUrl = canvas.toDataURL('image/jpeg');
                            };
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            };
        }
        function closeModal(target) {
            const modal = document.querySelector('#success-modal');
            target.addEventListener('click', () => {
                modal.classList.add('hidden');
                location.reload()
            })
        }
        $(document).ready(function() {

            $('#update-personal-data').on('submit', function(event) {
                event.preventDefault();

                let form = $('#update-personal-data')[0];
                let formData = new FormData(form);

                $.ajax({
                    url: "{{ route('admin.profil.update') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        const modal = document.querySelector('#success-modal');
                        modal.classList.remove('hidden')
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseJSON);
                        let response = xhr.responseJSON;

                        $('#update-personal-data .error-message').text('');

                        if (response && response.errors) {
                            let errors = response.errors;
                            for (let field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    let errorMessage = errors[field][0];
                                    $('#error-' + field).text(errorMessage);
                                }
                            }
                        } else {
                            alert('An error occurred while updating the data.');
                        }
                    }
                });
            });

            $('#update-password').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.profil.changePassword') }}",
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        const modal = document.querySelector('#success-modal');
                        modal.classList.remove('hidden')

                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseJSON);
                        let response = xhr.responseJSON;
                        
                        $('#update-password .error-message').text('');
                        
                        if (response && response.errors) {
                            let errors = response.errors;
                            for (let field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    let errorMessage = errors[field][0];
                                    $('#error-' + field).text(errorMessage);
                                }
                            }
                        } else {
                            alert('An error occurred while updating the password.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
