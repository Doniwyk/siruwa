<div>
  <label for="{{ $name }}" class="text-label_light mb-2 block">{{ $label }}</label>
  <div class="form-group relative">
      <select 
          name="{{ $name }}" 
          id="{{ $name }}" 
          class="form-control-input appearance-none cursor-pointer" 
          required>
          {{ $slot }}
      </select>
      <img src="{{ asset('assets/icons/arrow.svg') }}" 
          alt="Dropdown Icon" 
          class="right-icon pointer-events-none">
  </div>  
</div>
