<div class="form-group">
    <label for="nama" class="text-label_light">{{ $label }}</label>
    <input type="text" name="{{ $prevName }}" id="{{ $prevName }}" class="form-control" disabled
        placeholder="{{ $label }}" 
        value=
        @if (is_string($prevValue))
            "{{ $prevValue }}"
        @else
            "{{ $prevValue == 1 ? 'Iya' : 'Tidak' }}"
        @endif
        >

    @if ($label != 'No. Registrasi' && $label != 'No. KTP/NIK')
        <input type="text" name="{{ $reqName }}" id="{{ $reqName }}" class="form-control border-2 border-input-border" disabled
            placeholder="{{ $label }}" 
            value=
            @if (is_string($reqValue))
                "{{ $reqValue }}"
            @else
                "{{ $reqValue == 1 ? 'Iya' : 'Tidak' }}"
            @endif>
    @endif
</div>

