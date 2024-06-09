{{-- @dd($account) --}}
<div class="topbar">

    <div class="main-logo flex-center ">
        <div class="sm:hidden md:block">
            <div class="text-white text-2xl font-bold flex-center gap-9">
                <x-icon.siruwa-logo-white/>
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
