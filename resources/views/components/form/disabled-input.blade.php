<div class="form-group">
    <label for="nama" class="text-label_light">{{ $label }}</label>
    <input type="text" name="{{ $prevName }}" id="{{ $prevName }}" class="form-control" disabled
        placeholder="{{ $label }}" value="{{ $prevValue }}">
    @if (($label != 'No. Registrasi') || ($label != 'No. KTP/NIK'))
        <input type="text" name="{{ $reqName }}" id="{{ $reqName }}" class="form-control" disabled
            placeholder="{{ $label }}" value="{{ $reqValue }}">
    @endif
</div>
