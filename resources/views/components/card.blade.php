@if($label === 'Tunggakan')
    <a href="{{ route('admin.data-pembayaran.tunggakan') }}" class="card button-hover">
@else
    <div class="card">
@endif
    <header class="flex gap-3">
        @switch($label)
            @case('Dana Kematian')
                <x-icon.dana-kematian />
            @break

            @case('Dana Sampah')
                <x-icon.dana-sampah />
            @break

            @default
                <x-icon.tunggakan />
        @endswitch
        <h4>{{ $label }}</h4>
    </header>
    <span class="text-fund">Rp {{ number_format($value, 0, ',', '.') }}</span>
@if($label === 'Tunggakan')
    </a>
@else
    </div>
@endif