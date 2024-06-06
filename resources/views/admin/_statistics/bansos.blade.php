@extends('layouts.admin')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.3/dist/cdn.min.js" defer></script>
<div id="1" class="header-edit flex-start gap-1">
    <a href="{{ route('admin.statistic.index') }}">
        <span>
            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.6672 23.0165L17.9505 26.2999L23.3005 31.6499C24.4339 32.7665 26.3672 31.9665 26.3672 30.3665L26.3672 19.9832L26.3672 10.6332C26.3672 9.03321 24.4339 8.23321 23.3005 9.36654L14.6672 17.9999C13.2839 19.3665 13.2839 21.6332 14.6672 23.0165Z" fill="#225157" />
            </svg>
        </span>
    </a>
    <h1 class="h1-semibold">{{ $title }}</h1>
</div> 

<div class="link-option_parrent w-max">
    <a href="{{ route('admin.statistic.bansos', ['typeDocument' => 'fuzzy', 'limit' => $limit]) }}" @class([
        'link-option',
        'link-option_active' => $typeDocument == 'fuzzy',
    ])>
        Metode Fuzzy
    </a>
    <a href="{{ route('admin.statistic.bansos', ['typeDocument' => 'saw', 'limit' => $limit]) }}" @class([
        'link-option',
        'link-option_active' => $typeDocument == 'saw',
    ])>
        Metode SAW
    </a>
    <a href="{{ route('admin.statistic.bansos', ['typeDocument' => 'combined', 'limit' => $limit]) }}" @class([
        'link-option',
        'link-option_active' => $typeDocument == 'combined',
    ])>
        Metode SAW + Fuzzy
    </a>
</div>

<!-- hasil perhitungan dan sorting -->
<div class="flex flex-row justify-between" x-data="popupData()">
    <div class="flex flex-row gap-4 items-center">
        <span class="text-2xl font-semibold text-main">Hasil Perhitungan</span>
        <button @click="showPopup = true; setPopupContent('{{ $typeDocument }}')">
            <x-icon.detail />
        </button>
    </div>
    <form method="GET" action="{{ route('admin.statistic.bansos', ['typeDocument' => $typeDocument]) }}" id="limitForm">
        <label class="text-sm font-medium text-main" for="limit">Data yang ditampilkan</label>
        <select class="custom-select" name="limit" id="limit" onchange="document.getElementById('limitForm').submit()">
            <option value="5" @if($limit == 5) selected @endif>5</option>
            <option value="15" @if($limit == 15) selected @endif>15</option>
            <option value="30" @if($limit == 30) selected @endif>30</option>
            <option value="-1" @if($limit == -1) selected @endif>Tampilkan Semua</option>
        </select>
    </form>    

    <!-- Popup -->
    <div x-show="showPopup" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white p-8 rounded-lg shadow-lg relative" id="document-modal">
            <h2 class="text-center text-xl font-semibold mb-4 text-main" x-text="popupTitle"></h2>
            <div class="max-w-96">
                <span class="text-base text-main" x-text="popupContent"></span>
                <br></br>
                <p class="text-base text-main">Kriteria : Gaji, pajak bumi, biaya listrik, biaya air, pajak kendaraan, dan jumlah tanggungan</p>
            </div>
            <div class="flex-center mt-4">
                <button @click="showPopup = false" class="button-main text-white">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@switch($typeDocument)
    @case('fuzzy')
    @case('saw')
    @case('combined')
        <table class="table-parent">
            <thead>
                <tr>
                    <th>Prioritas</th>
                    <th>Nama</th>
                    <th>No Hp</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($limitedResults as $index => $result)
                    <tr class="hover:bg-fourth transition-all ease-linear">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result['name'] }}</td>
                        <td>{{ $result['nomor_hp'] }}</td>
                        <td>{{ $result['score'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @break
    @default
        <p>Type document tidak valid</p>
@endswitch
@endsection

<script>
function popupData() {
    return {
        showPopup: false,
        popupTitle: '',
        popupContent: '',
        setPopupContent(typeDocument) {
            switch (typeDocument) {
                case 'fuzzy':
                    this.popupTitle = 'Metode Fuzzy';
                    this.popupContent = 'Fuzzy adalah logika kabur yang digunakan untuk menentukan suatu nilai berdasarkan himpunan fuzzy.';
                    break;
                case 'saw':
                    this.popupTitle = 'Metode SAW';
                    this.popupContent = 'SAW adalah perhitungan sederhana yang digunakan untuk menentukan suatu nilai berdasarkan bobot dan kriteria tertentu.';
                    break;
                case 'combined':
                    this.popupTitle = 'Metode SAW + Fuzzy';
                    this.popupContent = 'Metode SAW + Fuzzy menggabungkan perhitungan sederhana dari SAW dengan logika kabur dari Fuzzy untuk menentukan suatu nilai.';
                    break;
                default:
                    this.popupTitle = 'Detail Perhitungan';
                    this.popupContent = 'Informasi tidak tersedia.';
                    break;
            }
        }
    };
}
</script>
