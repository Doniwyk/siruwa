<nav class=" left-sidebar sm:mobile_left-sidebar md:web_left-sidebar" id="left-sidebar">
    <ul class="flex flex-col justify-between sm:gap-1 md:gap-4 text-white">
        @foreach (config('constants') as $item)
            @php
                $isActivePage = $page == $item['route'];
                $route = 'admin.' . $item['route'] . '.index';
            @endphp
            <li>
                {{-- id pada tag a kyk e bakal diganti id user sg log in --}}
                <a href="{{ route($route) }}">
                    <button @class(['nav-menu', 'bg-white text-main font-bold' => $isActivePage]) onclick="showLoader()">
                        <img src="{{ asset($item['imgURL']) }}" alt="{{ $item['label'] }}" @class(['invert-black' => $isActivePage])>
                        {{ $item['label'] }}
                    </button>
                </a>
            </li>
        @endforeach

    </ul>
    <div>
        <a class=" hover:bg-white nav-menu cursor-pointer" href="{{ route('logout') }}">
            <img src="{{ asset('assets/icons/logout.svg') }}" alt="">
            <label for="">Keluar</label>
        </a>
    </div>
</nav>
@section('sidebar')
    <script>
        function showLoader() {
            loader.removeClass('hidden')
        }

        function toggleSidebar() {
            const sidebar = document.querySelector('#left-sidebar');
            const content = document.querySelector('#content');


            if (sidebar.style.left === '0px') {
                sidebar.style.left = '-20rem';
                content.classList.remove('blur-sm');
            } else {
                sidebar.style.left = '0';
                content.classList.add('blur-sm');
            }
        }
    </script>
@endsection
