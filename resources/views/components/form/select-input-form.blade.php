<!-- resources/views/components/form/select-input-form.blade.php -->

<div class="form-group relative">
  <label for="{{ $name }}" class="text-label_light">{{ $label }}</label>
  <select name="{{ $name }}" id="{{ $name }}" class="form-control-input appearance-none" required>
      {{ $slot }}
  </select>
  <img src="{{ asset('assets/icons/arrow.svg') }}" alt="Dropdown Icon" class="absolute right-4 w-4 h-4 pointer-events-none top-[45px]">
</div>  