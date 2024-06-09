<!-- gangerti kenopo type e gak ke pass dadi nulis neh akwokwok, seng iso benerno monggo--> 
@php
$type = $type ?? 'text';
@endphp

<div>
    <label for="{{ $name }}" class="text-label_light mb-2 block">{{ $label }}</label>
    <div class="form-group relative" x-data="{ showPassword: false }">
        <input 
            :type="showPassword ? 'text' : '{{ $type }}'" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            placeholder="{{ $label }}" 
            value="{{ $value ?? '' }}" 
            class="form-control-input {{ $type === 'date' ? 'cursor-pointer' : '' }}" 
            @if ($type === 'date') onclick="this.showPicker()" @endif
        >
        {{$name}}
        <div id="error-{{$name}}" class="text-red-600 font-medium"></div>

        @if ($type === 'password')
            <img 
                src="{{ asset('assets/icons/eye.svg') }}" 
                alt="Show Password" 
                class="right-icon cursor-pointer"
                @click="showPassword = !showPassword" 
                x-bind:src="showPassword ? '{{ asset('assets/icons/eye-slash.svg') }}' : '{{ asset('assets/icons/eye.svg') }}'">
        @endif
    </div>
    <div class="error-message text-red-500 text-sm mt-1" id="error-{{ $name }}"></div>
</div>
