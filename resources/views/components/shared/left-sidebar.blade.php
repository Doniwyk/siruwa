<nav class="left-sidebar">
    <ul class="flex flex-col justify-between gap-4 text-white">
        @foreach (config('constants') as $item)
            @php
                $isActivePage = $page == $item['route'][0] || $page == $item['route'][1] || $page == $item['route'][2];
                $route = 'admin.' . $item['route'][0] . '.index';
            @endphp
            <li>
                {{-- id pada tag a kyk e bakal diganti id user sg log in --}}
                <a href="{{ route($route) }}" @class(['nav-menu', 'bg-white text-main font-bold' => $isActivePage])>
                    <img src="{{ asset($item['imgURL']) }}" alt="{{ $item['label'] }}" @class([ 'invert-black' => $isActivePage])>
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach

    </ul>
    <div>
        <button @class(['flex', 'gap-4', 'px-3', 'py-4', 'w-full'])>
            <img src="{{ asset('assets/icons/logout.svg') }}" alt="">
            <label for="">Keluar</label>
        </button>
        </d>
</nav>
