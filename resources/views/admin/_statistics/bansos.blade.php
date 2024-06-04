@extends('layouts.admin')
@section('content')
<div class="header-edit flex-start gap-1">
    <a href="{{ route('admin.statistic.index') }}">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z" fill="#225157" />
            </svg>
        </span>
    </a>
    <h1 class="h1-semibold">{{ $title }}</h1>
</div> 

<div class="link-option_parrent">
    <a href="{{ route('admin.statistic.bansos', ['typeDocument' => 'fuzzy']) }}" @class([
        'link-option',
        'link-option_active' => $typeDocument == 'fuzzy',
    ])>
        Metode Fuzzy
    </a>
    <a href="{{ route('admin.statistic.bansos', ['typeDocument' => 'saw']) }}" @class([
        'link-option',
        'link-option_active' => $typeDocument == 'saw',
    ])>
        Metode SAW
    </a>
</div>

<div class="flex">
    <span class="text-main text-2xl font-semibold">Hasil Perhitungan</span>
</div>

@switch($typeDocument)
    @case('fuzzy')
        <table class="table-parent">
            <thead>
            <tr>
                    <th>Prioritas</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $index => $data)
                    <tr class="hover:bg-fourth transition-all ease-linear">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data['name'] }}</td>
                        <td>No HP</td>
                        <td>{{ $data['score'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @break

    @case('saw')
        <table class="table-parent">
            <thead>
                <tr class="hover:bg-fourth transition-all ease-linear">
                    <th>Prioritas</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $index => $data)
                    <tr class="hover:bg-fourth transition-all ease-linear">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data['name'] }}</td>
                        <td>No HP</td>
                        <td>{{ $data['score'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @break

    @default
@endswitch
@endsection
