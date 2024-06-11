<div class="form-group">
    <label for="nama" class="text-label_light">{{ $label }}</label>
    <input type="text" name="{{ $prevName }}" id="{{ $prevName }}" class="form-control" disabled
        placeholder="{{ $label }}" 
        value=
        @if (is_bool($prevValue))
            "{{$prevValue ? 'Iya' : 'Tidak'}}"
        @elseif(is_double($prevValue))
            "{{ number_format($prevValue, 0, ',', '.') }}"
        @else
            "{{$prevValue}}"
        @endif
        >

    @if ($label != 'No. Registrasi' && $label != 'No. KTP/NIK')
        <input type="text" name="{{ $reqName }}" id="{{ $reqName }}" class="form-control border-0 ring-2 ring-inset ring-input-border" disabled
            placeholder="{{ $label }}" 
            value=
            @if (is_bool($reqValue))
                "{{$reqValue ? 'Iya' : 'Tidak'}}"
            @elseif(is_double($reqValue))
                "{{ number_format($reqValue, 0, ',', '.') }}"
            @else
                "{{$reqValue}}"
            @endif
            >
    @endif
</div>

