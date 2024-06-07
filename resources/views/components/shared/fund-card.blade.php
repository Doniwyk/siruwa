<div class="card drop-shadow-xl gap-6">
    <div class="flex gap-3">
        @if ($type == 'totalDana')
            <x-icon.money-icon />
            <span>Total Dana Saat Ini</span>
            @else
            <x-icon.tunggakan />
            <span>Tunggakan</span>
        @endif
    </div>
    <div class="flex justify-between items-center">
        <span class="text-fund">Rp {{ number_format($moneyTotal, 0, ',', '.') }}</span>
        @if ($type == 'totalDana')
            <a href="{{route('admin.data-pembayaran.add')}}">
        @else
            <a href="{{route('admin.data-pembayaran.tunggakan')}}">
        @endif
            <button class="button-main rounded-full font-medium px-8">
                <span>Detail</span>
                <x-icon.open-tab />

            </button>
        </a>
    </div>
</div>
