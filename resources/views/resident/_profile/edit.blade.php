@extends('layouts.user')
@section('content-user')

<div class="resident-header">{{ $title }}</div>
<div class="bg-white p-9 rounded-2xl flex mb-6">
    <form action="" class="flex w-full space-x-9">
        <!-- Foto Profil -->
        <section class="shrink-0 flex flex-col" x-data="imageHandler()">
            <span class="mb-6 block text-2xl font-semibold text-secondary">Foto Profil</span>
            <div class="relative w-[21rem] cursor-pointer" @click="$refs.profileImageUpload.click()">
                <input type="file" x-ref="profileImageUpload" class="hidden" accept="image/*" @change="loadFile($event)" name="urlProfile">
                <img id="profile-image" class="w-[21rem] h-[16rem] rounded-xl absolute" :src="croppedImageUrl || '{{ $account->urlProfile }}'" alt="Profil" /> <!-- Profil -->
                <span class="w-[21rem] h-[16rem] group bg-black opacity-50 rounded-xl absolute"></span> <!-- Background Black 50%-->
                <span class="w-[21rem] h-[16rem] group absolute flex flex-col justify-center items-center gap-2"> <!-- Upload Icon -->
                    <img class="block w-12 opacity-100" src="{{ asset('assets/icons/upload-profile.svg') }}" alt="Upload" /> 
                    <span class="text-white font-medium">Upload Foto Profil</span> 
                </span>
            </div>
        </section>

        <!-- Identitas Diri -->
        <section class="w-full flex flex-col">
            <span class="mb-6 block text-2xl font-semibold text-secondary">Identitas Diri</span>
    
            <div class="grid grid-rows-3 grid-flow-col gap-x-9 gap-y-5 mb-6">
                <x-form.show-input-form :label="'Nama Lengkap'"  :name="'nama'" :value="$resident->nama" />
                <x-form.show-input-form :label="'Role'"  :name="'role'" :value="$account->role" />
                <x-form.show-input-form :label="'Alamat Lengkap'"  :name="'alamat'" :value="$resident->alamat" />
                <x-form.text-input-form label="Username" name="username" :value="$account->username" />
                <x-form.text-input-form label="Email" name="email" :value="$account->email" />
                <x-form.text-input-form label="No. Telepon" name="noHp" :value="$account->noHp" />
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="btn-main">Simpan Perubahan</button>
            </div>
        </section>
    </form>
</div>

<div class="bg-white p-9 rounded-2xl mb-6">
    <span class="mb-6 block text-2xl font-semibold text-secondary">Ubah Password</span>
    <form action="{{ route('admin.profil.changePassword') }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT"> <!-- Manually adding the method override -->

        <div class="grid grid-cols-3 grid-flow-row gap-x-9 gap-y-5 mb-6">
            <x-form.text-input-form type="password" label="Password Lama" name="current_password" />
            <x-form.text-input-form type="password" label="Password Baru" name="new_password" />
            <x-form.text-input-form type="password" label="Konfirmasi Password" name="new_password_confirmation" />
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn-main">Simpan Perubahan</button>
        </div>
    </form>
</div>

<!-- HIDUP CHAT GPT AKWOKWOKWOK -->
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
</script>

@endsection
