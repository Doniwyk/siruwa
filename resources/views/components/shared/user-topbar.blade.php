<nav class="bg-secondary text-white">
    <div class="md:px-16 sm:px-5 md:flex items-center gap-6">
        <!-- LOGO -->
        <div class="md:py-4 sm:py-2 flex items-center justify-between w-full">
            <a href="{{ route('index') }}" class="flex items-center gap-4">
                <img src="{{ asset('assets/icons/logo-white.svg') }}" alt="logo" class="md:w-8 sm:w-7">
                <span class="text-2xl font-semibold sm:hidden">SIRUWA</span>
            </a>
            <!-- MENU ICON -->
            <div class="md:hidden md:flex items-center">
                <button type="button" class="mobile-menu-button flex items-center">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(-1);">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
        
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
        
                        <g id="SVGRepo_iconCarrier">
                            <path d="M4 18H10" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                            <path d="M4 12L16 12" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                            <path d="M4 6L20 6" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                        </g>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- MENU -->
        <div class="sm:overflow-hidden sm:max-h-0 transition-[max-height] duration-500 ease-in-out md:items-center sm:hidden md:flex sm:flex sm:flex-col-reverse sm:gap-3 gap-3 navigation-menu">
            <a href="{{ route('logout') }}" class="text-white hover:text-gray-100 text-right md:hidden sm:pb-3">LOGOUT</a>
            <a href="{{ route('index') }}#struktur" class="text-white hover:text-gray-100 text-right">KEPENGURUSAN</a>
            <a href="{{ route('index') }}#agenda" class="text-white hover:text-gray-100 text-right">AGENDA</a>
            <a href="{{ route('index') }}#berita" class="text-white hover:text-gray-100 text-right">BERITA</a>
            <a href="{{ route('index') }}#menu" class="text-white hover:text-gray-100 text-right">MENU</a>
            <a href="{{ route('index') }}#beranda" class="text-white hover:text-gray-100 text-right">BERANDA</a>
            <a href="{{ route('logout') }}" class="text-white hover:text-gray-100 text-right sm:hidden sm:pb-3">LOGOUT</a>
            <a href="#" class="sm:hidden profile-link">
                <span class="flex justify-center items-center bg-white rounded-2xl px-8 py-2 gap-3">
                    <div class="text-secondary username"></div>
                    <img class="rounded-full w-9 h-9 urlProfile" src="">
                </span>
            </a>
        </div>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.navigation-menu');

    mobileMenuButton.addEventListener('click', () => {
        if (mobileMenu.classList.contains('sm:hidden')) {
            mobileMenu.classList.remove('sm:hidden');
            mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
        } else {
            mobileMenu.style.maxHeight = '0';
            mobileMenu.addEventListener('transitionend', () => {
                mobileMenu.classList.add('sm:hidden');
            }, { once: true });
        }
    });

    // Fetch profile data and update the top bar
    fetch('/profile/info')
        .then(response => response.json())
        .then(data => {
            if (data.username && data.urlProfile) {
                document.querySelector('.profile-link .username').textContent = data.username;
                document.querySelector('.profile-link .urlProfile').src = data.urlProfile;
            }
        })
        .catch(error => console.error('Error fetching profile data:', error));
});
</script>
