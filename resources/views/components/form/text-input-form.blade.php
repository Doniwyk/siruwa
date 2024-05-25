<!-- gangerti kenopo type e gak ke pass dadi nulis neh akwokwok, seng iso benerno monggo-->
@php
$type = $type ?? 'text';
@endphp

<div class="form-group relative" x-data="{ showPassword: false }">
    <label for="{{ $name }}" class="text-label_light">{{ $label }}</label>
    <input :type="showPassword ? 'text' : '{{ $type }}'" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $label }}" value="{{ $value ?? '' }}" class="form-control-input">

    @if ($type === 'password')
        <img src="{{ asset('assets/icons/eye.svg') }}"
             alt="Show Password"
             class="absolute top-[42px] right-4 w-5 h-5 cursor-pointer"
             @click="showPassword = !showPassword"
             x-bind:src="showPassword ? '{{ asset('assets/icons/eye-slash.svg') }}' : '{{ asset('assets/icons/eye.svg') }}'">
    @endif
</div>
