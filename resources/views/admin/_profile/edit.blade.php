@extends('layouts.admin')
@section('content')
    {{-- <div id="response-message"></div> --}}
    <div class="h1-semibold">{{ $title }}</div>
    <div class="bg-white p-9 rounded-2xl flex mb-6">
        <form action="/your-endpoint" class="flex sm:flex-col lg:flex-row gap-9 w-full " id="update-personal-data"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Foto Profil -->
            <fieldset class="shrink-0 h-[21rem] flex flex-col relative items-center " x-data="imageHandler()">
                <span class="mb-6 block text-2xl font-semibold text-secondary w-full">Foto Profil</span>
                <div class="relative w-[21rem] h-[16rem] cursor-pointer bg-black/50 object-contain" @click="$refs.profileImageUpload.click()">
                    <input type="file" x-ref="profileImageUpload" class="hidden" accept="image/*"
                        @change="loadFile($event)" name="urlProfile" id="urlProfile">
                    <img id="profile-image" class="w-full h-full rounded-xl absolute object-contain bg-black/50"
                        :src="croppedImageUrl || '{{ $account->urlProfile }}'" alt="Profil" />
                    <span class="w-full h-full group  opacity-50 rounded-xl absolute object-contain"></span>
                    <span class="w-[21rem] h-[16rem] group absolute flex flex-col justify-center items-center gap-2 object-contain">
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
        <form action="" method="post" id="update-password" class="flex md:flex-col gap-9">
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

    <div class="position-fixed top-0 left-1/2 -translate-x-1/2 p-3 " style="z-index: 11">
        <div id="liveToast" class="toast hide bg-white " role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                <strong class="me-auto">Success</strong>
                <small> </small>
                <button type="button" class="btn-close font-semibold" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-main font-semibold">
                Account updated successfully
            </div>
        </div>
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

                                ctx.drawImage(img, offsetX, offsetY, cropWidth, cropHeight, 0, 0, 335, 255);
                                this.croppedImageUrl = canvas.toDataURL('image/jpeg');
                            };
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }
            };
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
                        let toastElList = [].slice.call(document.querySelectorAll(
                            '.toast'))
                        let toastList = toastElList.map(function(toastEl) {
                            return new bootstrap.Toast(toastEl)
                        })

                        toastList.forEach(toast => toast.show())

                        setTimeout(() => {
                            window.location.href = "/admin/profil"
                        }, 1000);

                    },
                    error: function(response) {
                        console.log(response);
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
                        console.log(response);
                        let toastElList = [].slice.call(document.querySelectorAll(
                            '.toast'))
                        let toastList = toastElList.map(function(toastEl) {
                            return new bootstrap.Toast(toastEl)
                        })
                        toastList.forEach(toast => toast.show())

                        setTimeout(() => {
                            window.location.href = "/admin/profil"
                        }, 1000);

                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            });
        });
    </script>
@endsection