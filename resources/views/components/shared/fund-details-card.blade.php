@php
    $jenis = $type == 'Pemasukan' ? 'Pemasukan' : 'Pengeluaran';
@endphp
<div class="card-details-fund">
    <div class="flex flex-col grow px-8 gap-4">
        <div class="text-base font-medium">Total {{$jenis}} Iuran Kematian</div>
        <div class="text-2xl font-semibold">Rp. {{ number_format($moneyTotalKematian, 0, ',', '.') }}</div>
    </div>
    <div class="flex flex-col border-l-2 border-slate-700 grow px-8 gap-4">
        <div class="text-base font-medium">Total {{$jenis}} Iuran Sampah</div>
        <div class="text-2xl font-semibold">Rp. {{ number_format($moneyTotalSampah, 0, ',', '.') }}</div>
    </div>
</div>