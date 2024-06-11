{{-- @dd($account) --}}
<div class="topbar">

    <div class="main-logo flex-center ">
        <div class="sm:hidden md:block">
            <div class="text-white text-2xl font-bold flex-center gap-9">
                <svg width="36" height="46" viewBox="0 0 36 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1907_5363)">
                        <path
                            d="M1.71355 0.5C0.76841 0.5 0 1.27586 0 2.23017V36.8491C0 37.8034 0.76841 38.5793 1.71355 38.5793H11.9949C12.94 38.5793 13.7084 39.3552 13.7084 40.3095C13.7084 41.2638 12.94 42.0397 11.9949 42.0397H1.71355C0.76841 42.0397 0 42.8155 0 43.7698C0 44.7241 0.76841 45.5 1.71355 45.5H15.4297C16.3748 45.5 17.1432 44.7241 17.1432 43.7698V36.8491C17.1432 35.8948 16.3748 35.119 15.4297 35.119H5.14066C4.19552 35.119 3.42711 34.3431 3.42711 33.3888V5.69052C3.42711 4.73621 4.19552 3.96035 5.14066 3.96035H11.9949C12.94 3.96035 13.7084 4.73621 13.7084 5.69052V29.9207C13.7084 30.875 14.4768 31.6509 15.422 31.6509C16.3671 31.6509 17.1355 30.875 17.1355 29.9207V2.23017C17.1432 1.27586 16.3748 0.5 15.4297 0.5H1.71355Z"
                            fill="#F1F0E9" />
                        <path
                            d="M34.2871 0.5C35.2322 0.5 36.0006 1.27586 36.0006 2.23017V3.96034V35.1112V36.8414C36.0006 37.7957 35.2322 38.5715 34.2871 38.5715H24.0058C23.0606 38.5715 22.2922 39.3474 22.2922 40.3017C22.2922 41.256 23.0606 42.0319 24.0058 42.0319H34.2871C35.2322 42.0319 36.0006 42.8078 36.0006 43.7621C36.0006 44.7164 35.2322 45.4922 34.2871 45.4922H20.571C19.6258 45.4922 18.8574 44.7164 18.8574 43.7621V42.0319V38.5715V36.8414C18.8574 35.8871 19.6258 35.1112 20.571 35.1112H30.8523C31.7974 35.1112 32.5659 34.3353 32.5659 33.381V5.69052C32.5659 4.73621 31.7974 3.96034 30.8523 3.96034H23.9981C23.0529 3.96034 22.2845 4.73621 22.2845 5.69052V29.9207C22.2845 30.875 21.5161 31.6509 20.571 31.6509C19.6258 31.6509 18.8574 30.875 18.8574 29.9207V3.96034V2.23017C18.8574 1.27586 19.6258 0.5 20.571 0.5H34.2871Z"
                            fill="#F1F0E9" />
                    </g>
                    <defs>
                        <clipPath id="clip0_1907_5363">
                            <rect width="36" height="45" fill="white" transform="translate(0 0.5)" />
                        </clipPath>
                    </defs>
                </svg>
                <label for="">SIRUWA</label>
            </div>
        </div>
        <div id="hamburger" onclick="toggleSidebar()" class="sm:block md:hidden">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                <g id="SVGRepo_iconCarrier">
                    <path d="M4 18H10" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                    <path d="M4 12L16 12" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                    <path d="M4 6L20 6" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                </g>

            </svg>
        </div>
    </div>
    <a href="{{route('admin.profil.index')}}">
    <div class="h-full bg-white px-4 py-2  flex-center rounded-2xl gap-6">
            <label for="" class="font-semibold text-main">{{$account->penduduk->nama}}</label>
            <img src="{{$account->urlProfile}}" alt="profile" class="rounded-full h-[2.75rem] object-contain">
        </div>
    </a>
</div>