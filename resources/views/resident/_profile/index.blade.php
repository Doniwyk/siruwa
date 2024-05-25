@extends('layouts.user')
@section('content-user')

<div class="resident-header">{{ $title }}</div>
<div class="bg-white p-9 rounded-2xl flex space-x-9 mb-6">
    <section class="shrink-0 flex flex-col">
        <span class="mb-6 text-2xl font-semibold text-secondary">Foto Profil</span>
        <img src="https://via.placeholder.com/336x258" class="h-[258px] w-[336px] rounded-xl" alt="">
    </section>
    <section class="w-full flex flex-col">
        <span class="mb-6 text-2xl font-semibold text-secondary">Identitas Diri</span>
        <form action="" class="grid grid-cols-2 grid-flow-row gap-x-9 gap-y-5">
            <div class="form-group">
                <label for="nama" class="text-label_light">Username</label>
                <input type="text" name="" id="" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="nama" class="text-label_light">Nama Lengkap</label>
                <input type="text" name="" id="" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="nama" class="text-label_light">Role</label>
                <input type="text" name="" id="" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="nama" class="text-label_light">Email</label>
                <input type="text" name="" id="" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="nama" class="text-label_light">Alamat</label>
                <input type="text" name="" id="" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="nama" class="text-label_light">No. Telepon</label>
                <input type="text" name="" id="" class="form-control" disabled>
            </div>
        </form>
    </section>
</div>
<div class="flex justify-end">
    <button class="w-60 bg-secondary text-stone-50 font-semibold py-3 rounded-2xl">Edit Profil</button>
</div>
@endsection
