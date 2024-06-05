@extends('layouts.user')
@section('content-user')

<div class="resident-header">{{ $title }}</div>
<div class="bg-white rounded-2xl flex flex-col p-9 gap-6">
    <div class="flex sm:flex-col lg:flex-row md:gap-9 w-full">
        <section class="shrink-0 h-[21rem] flex flex-col relative items-center">
            <span class="resident-profile-subheader w-full">Foto Profil</span>
            <span class="rounded-2xl">
                <img src="{{ $account->urlProfile }}" class="h-[16rem] lg:w-[21rem] sm:w-full md:rounded-xl sm:rounded-xl object-contain" alt="Profil">   

            </span>
        </section>
        <section class="basis-3/4 flex flex-col">
            <span class="mb-6 text-2xl font-semibold text-secondary">Identitas Diri</span>
            <form class="grid gap-x-9 gap-y-5 sm:grid-cols-1 sm:grid-rows-6 lg:grid-cols-2 lg:grid-rows-2">
                <x-form.show-input-form :label="'Nama Lengkap'"  :name="'anu'" :value="$detailAccount->nama" />
                <x-form.show-input-form :label="'Username'"  :name="'nama'" :value="$account->username" />
                <x-form.show-input-form :label="'Role'"  :name="'reqRegistrasi'" :value="$account->role" />
                <x-form.show-input-form :label="'Email'"  :name="'email'" :value="$account->email" />
                <x-form.show-input-form :label="'Alamat Lengkap'"  :name="'reqAlamat'" :value="$detailAccount->alamat" />
                <x-form.show-input-form :label="'No. Telepon'"  :name="'reqRegistrasi'" :value="$account->noHp" />
            </form>
        </section>
    </div>
    <div class="flex justify-end ">
        <a href="{{ route('resident.profil.edit') }}" class="btn-main text-white button-hover">Edit Profil</a>
    </div>
</div>
@endsection
