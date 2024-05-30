@extends('layouts.user')
@section('content-user')

<div class="resident-header">{{ $title }}</div>
<div class="bg-white p-9 rounded-2xl flex flex-col mb-6">
    <div class="flex space-x-9 w-full mb-6 ">
        <!-- FOTO PROFIL -->
        <section class="shrink-0 flex flex-col">
            <span class="resident-profile-subheader">Foto Profil</span>
            <img src="{{ $account->urlProfile }}" class="h-[16rem] w-[21rem] rounded-xl" alt="Profil">   
        </section>
        <!-- IDENTITAS DIRI -->
        <section class="w-full flex flex-col">
            <span class="mb-6 text-2xl font-semibold text-secondary">Identitas Diri</span>
            <form class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
                <x-form.show-input-form :label="'Nama Lengkap'"  :name="'anu'" :value="$detailAccount->nama" />
                <x-form.show-input-form :label="'Username'"  :name="'nama'" :value="$account->username" />
                <x-form.show-input-form :label="'Role'"  :name="'reqRegistrasi'" :value="$account->role" />
                <x-form.show-input-form :label="'Email'"  :name="'email'" :value="$account->email" />
                <x-form.show-input-form :label="'Alamat Lengkap'"  :name="'reqAlamat'" :value="$detailAccount->alamat" />
                <x-form.show-input-form :label="'No. Telepon'"  :name="'reqRegistrasi'" :value="$account->noHp" />
            </form>
        </section>
    </div>
    <div class="flex justify-end">
        <a href="{{ route('resident.profil.edit') }}" class="btn-main">Edit Profil</a>
    </div>
</div>
@endsection
