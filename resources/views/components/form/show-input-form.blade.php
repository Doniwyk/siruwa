<div class="form-group">
    <label for="nama" class="text-label_light">{{ $label }}</label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control" disabled
        placeholder="{{ $label }}"
        value=
        @if (is_string($value))
            "{{ $value }}"
        @else
            "{{ $value == 1 ? 'Iya' : 'Tidak' }}"
        @endif
    >
</div>
