@extends('layouts.user')
@section('title')
Profil
@endsection
@section('content-user')
<div class="h1-semibold">Profil</div>
<div class="bg-white p-9 rounded-2xl flex flex-col gap-6">
    <div class="flex sm:flex-col md:flex-row w-full gap-9">
        <section class="shrink-0 md:w-[21rem] md:h-[16rem] flex flex-col">
            <span class="resident-profile-subheader ">Foto Profil</span>
            <img src="{{ $account->urlProfile }}" class="h-[16rem] md:w-[21rem] sm:w-full rounded-xl object-contain" alt="Profil">   
        </section>
        <section class="w-full flex flex-col">
            <span class="mb-6 text-2xl font-semibold text-main">Identitas Diri</span>
            <form class="grid gap-x-9 gap-y-4 sm:grid-cols-1 sm:grid-rows-6 lg:grid-cols-2 lg:grid-rows-2">
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
