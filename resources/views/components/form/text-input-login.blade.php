<!-- resources/views/components/form/text-input-form.blade.php -->
@props(['type' => 'text', 'label', 'name', 'value' => ''])

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
            value="{{ old($name, $value) }}" 
            class="form-control-input {{ $type === 'date' ? 'cursor-pointer' : '' }}" 
            @if ($type === 'date') onclick="this.showPicker()" @endif
        >

        @if ($type === 'password')
            <img 
                src="{{ asset('assets/icons/eye.svg') }}" 
                alt="Show Password" 
                class="right-icon cursor-pointer"
                @click="showPassword = !showPassword" 
                x-bind:src="showPassword ? '{{ asset('assets/icons/eye-slash.svg') }}' : '{{ asset('assets/icons/eye.svg') }}'">
        @endif
    </div>
</div>
