<div @class(['card', 'danger' => $type == 'danger'])>
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
    <label class="text-fund">Rp 900.000</label>
</div>
