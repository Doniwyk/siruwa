<div @class(['card', 'danger' => $type == 'danger'])>
    <header class="flex gap-3">
        @switch($label)
            @case('Dana Kematian')
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.66602 18.8335H18.3327" stroke="#225157" stroke-width="2" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M14.1667 2.1665H5.83333C3.33333 2.1665 2.5 3.65817 2.5 5.49984V18.8332H17.5V5.49984C17.5 3.65817 16.6667 2.1665 14.1667 2.1665Z"
                        stroke="#225157" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M6 8L14 8" stroke="#225157" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M8.33398 10.5H11.6673" stroke="#225157" stroke-width="2" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            @break

            @case('Dana Sampah')
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.834 5.48356C15.059 5.20856 12.2673 5.06689 9.48398 5.06689C7.83398 5.06689 6.18398 5.15023 4.53398 5.31689L2.83398 5.48356"
                        stroke="#225157" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M7.41797 4.6415L7.6013 3.54984C7.73464 2.75817 7.83464 2.1665 9.24297 2.1665H11.4263C12.8346 2.1665 12.943 2.7915 13.068 3.55817L13.2513 4.6415"
                        stroke="#225157" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M16.0417 8.1167L15.5 16.5084C15.4083 17.8167 15.3333 18.8334 13.0083 18.8334H7.65833C5.33333 18.8334 5.25833 17.8167 5.16667 16.5084L4.625 8.1167"
                        stroke="#225157" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8.94141 14.25H11.7164" stroke="#225157" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M8.25 10.9165H12.4167" stroke="#225157" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            @break

            @default
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19 5.49984V7.5165C19 8.83317 18.1667 9.6665 16.85 9.6665H14V3.8415C14 2.9165 14.7583 2.1665 15.6833 2.1665C16.5917 2.17484 17.425 2.5415 18.025 3.1415C18.625 3.74984 19 4.58317 19 5.49984Z"
                        stroke="#4C2323" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M2.33203 6.33317V17.9998C2.33203 18.6915 3.11536 19.0832 3.66536 18.6665L5.09036 17.5998C5.4237 17.3498 5.89036 17.3832 6.19036 17.6832L7.5737 19.0748C7.8987 19.3998 8.43203 19.3998 8.75703 19.0748L10.157 17.6748C10.4487 17.3832 10.9154 17.3498 11.2404 17.5998L12.6654 18.6665C13.2154 19.0748 13.9987 18.6832 13.9987 17.9998V3.83317C13.9987 2.9165 14.7487 2.1665 15.6654 2.1665H6.4987H5.66536C3.16536 2.1665 2.33203 3.65817 2.33203 5.49984V6.33317Z"
                        stroke="#4C2323" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M5.875 8.8335H10.4583" stroke="#4C2323" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
        @endswitch
        <h4>{{ $label }}</h4>
    </header>
    <label class="text-fund">Rp 900.000</label>
</div>
