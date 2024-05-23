@extends('layouts.admin')
@section('content')
<div class="header-edit flex-start gap-1">
    <a href="{{ route('admin.manajemen-berita.index') }}">
        <x-icon.back />
    </a>
    <h1 class="h1-semibold">Verifikasi Dokumen</h1>
</div>
<form action="/upload" method="post" enctype="multipart/form-data">
    <input type="file" name="gambar" accept="image/*">
    <button type="submit">Upload</button>
</form>
@endsection