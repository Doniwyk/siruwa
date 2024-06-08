<div class="form-group">
    <label for="{{ $name }}" class="text-label_light">{{ $label }}</label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control" disabled
        placeholder="{{ $label }}"
        value=
        @if (is_bool($value))
            "{{ $value == 1 ? 'Iya' : 'Tidak' }}"
        @else
            "{{ $value }}"
        @endif
    >
</div>