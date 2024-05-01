<div class="username flex flex-col gap-3 relative">
    <label for="" class="text-xl text-main">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="input-form"
        placeholder="{{ $placeholder }}" value="{{ $value }}">
    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"
        @class(['absolute', 'right-[1.5rem]', 'bottom-[9.5px]', 'hidden' => $type != 'password'])>
        <path
            d="M12.9823 10.4999C12.9823 12.1499 11.649 13.4833 9.99896 13.4833C8.34896 13.4833 7.01562 12.1499 7.01562 10.4999C7.01562 8.84993 8.34896 7.5166 9.99896 7.5166C11.649 7.5166 12.9823 8.84993 12.9823 10.4999Z"
            stroke="#97A7A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M9.99987 17.3918C12.9415 17.3918 15.6832 15.6584 17.5915 12.6584C18.3415 11.4834 18.3415 9.50843 17.5915 8.33343C15.6832 5.33343 12.9415 3.6001 9.99987 3.6001C7.0582 3.6001 4.31654 5.33343 2.4082 8.33343C1.6582 9.50843 1.6582 11.4834 2.4082 12.6584C4.31654 15.6584 7.0582 17.3918 9.99987 17.3918Z"
            stroke="#97A7A8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>

</div>
