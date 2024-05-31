@extends('layouts.admin')
@section('content')
<h1 class="h1-semibold">Data Penduduk</h1>
<div class="profile_parent">
    <div class="profile_hero relative">
        <img src="{{ asset('assets/img/profile.png') }}" alt="logo" class=" rounded-full">
        <div class="edit rounded-full bg-white h-[41px] w-[41px] flex flex-center absolute right-4 bottom-0">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.5408 4.71647C21.1907 2.36643 18.8891 2.30586 16.4785 4.71647L15.0128 6.18222C14.8916 6.30336 14.8432 6.49718 14.8916 6.66677C15.8123 9.87688 18.3803 12.445 21.5905 13.3656C21.6389 13.3777 21.6874 13.3898 21.7358 13.3898C21.8691 13.3898 21.9902 13.3414 22.0871 13.2445L23.5408 11.7787C24.74 10.5916 25.3215 9.44079 25.3215 8.27788C25.3336 7.07863 24.7521 5.91572 23.5408 4.71647Z" fill="#0F4C52" />
                <path d="M19.4095 14.4679C19.0582 14.2983 18.719 14.1287 18.392 13.9349C18.1255 13.7774 17.8711 13.6078 17.6167 13.4261C17.4108 13.2928 17.1685 13.099 16.9383 12.9052C16.9141 12.8931 16.8293 12.8204 16.7324 12.7235C16.3327 12.3843 15.8845 11.9482 15.4847 11.4637C15.4484 11.4395 15.3878 11.3547 15.303 11.2456C15.1819 11.1003 14.9759 10.858 14.7942 10.5794C14.6489 10.3977 14.4793 10.1312 14.3218 9.86468C14.128 9.53761 13.9584 9.21054 13.7888 8.87136C13.7392 8.76509 13.6927 8.65986 13.6487 8.55597C13.5066 8.22028 13.071 8.12336 12.8133 8.38112L5.75745 15.437C5.59997 15.5944 5.45461 15.8973 5.41827 16.1032L4.76413 20.7427C4.643 21.5665 4.87316 22.3417 5.38193 22.8626C5.81802 23.2866 6.4237 23.5167 7.07784 23.5167C7.2232 23.5167 7.36857 23.5046 7.51393 23.4804L12.1656 22.8263C12.3836 22.7899 12.6865 22.6446 12.8318 22.4871L19.8805 15.4384C20.14 15.1789 20.0417 14.7345 19.7031 14.5929C19.6073 14.5529 19.5098 14.5113 19.4095 14.4679Z" fill="#0F4C52" />
            </svg>
        </div>
    </div>
    <div class="profile-desc">
        <h4 class="text-2xl font-bold">{{$account->username}}</h4>
        <h3 class="text-3xl font-bold tracking-wider pb-1">{{ $detailAccount->nama }}</h3>
        <label for="">{{ $detailAccount->nik }}</label>
        <label for="">{{ $account->email }}</label>
        <label for="">{{ $account->noHp }}</label>
    </div>
</div>
<div class="p-8 bg-white flex flex-col ">
    <form action="{{ route('admin.profil.update')}}" method="POST" class="user-information bg-white flex flex-col gap-5">
        @csrf
        @method('PUT')
        <h3 class="text-main font-bold text-2xl">Informasi Pengguna</h3>
        <div class="wrapper grid grid-rows-2 grid-cols-2 gap-x-9 gap-y-5">
            <x-shared.input :label="'Username'" :type="'text'" :name="'username'" :id="'username'" :placeholder="'Username'" :value="$account->username" />
            <x-shared.input :label="'Email'" :type="'email'" :name="'email'" :id="'email'" :placeholder="'Email'" :value="$account->email" />
            <x-shared.input :label="'No. Hp'" :type="'text'" :name="'noHp'" :id="'noHp'" :placeholder="'No. Hp'" :value="$account->noHp" />
        </div>
        <div class="action flex justify-end">
            <button class="bg-main text-white py-3 px-[3.5rem] rounded-2xl font-semibold">Simpan Perubahan</button>
        </div>
    </form>
    <form action="{{ route('admin.profil.changePassword') }}" method="POST" action="" class="user-information bg-white flex flex-col gap-5">
        @csrf
        <h3 class="text-main font-bold text-2xl">Ganti Kata Sandi</h3>
        <div class="wrapper grid grid-rows-2 grid-cols-2 gap-x-9 gap-y-5">
            <x-shared.input :label="'Kata Sandi Lama'" :type="'password'" :name="'current_password'" :id="'current_password'" :placeholder="'Kata Sandi Lama'" />
            <x-shared.input :label="'Kata Sandi Baru'" :type="'password'" :name="'new_password'" :id="'new_password'" :placeholder="'Kata Sandi Baru'" />
            <x-shared.input :label="'Konfirmasi Kata Sandi Baru'" :type="'password'" :name="'new_password_confirmation'" :id="'new_password_confirmation'" :placeholder="'Konfirmasi Kata Sandi Baru'" />
        </div>
        <div class="action flex justify-end">
            <button class="bg-main text-white py-3 px-[3.5rem] rounded-2xl font-semibold">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection