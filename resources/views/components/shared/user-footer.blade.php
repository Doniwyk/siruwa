<div class="bg-secondary px-16 py-8 text-white">
    <div class="md:flex justify-between sm:flex sm:flex-col sm:gap-y-10">
        <div class="flex flex-col gap-4">
            <span><img src="{{ asset('assets/icons/logo-white.svg') }}" alt=""></span>
            <div>Desa Sumberejo, Kota Batu, Jawa Timur</div>
            <div class="flex gap-4">
                <img src="{{ asset('assets/icons/phone.svg') }}" class="w-6">
                <div class="text-2xl font-semibold">+6283845734645</div>
            </div>
        </div>
        <div class="flex flex-col gap-4 text-base font-medium">
            <span class="text-xl font-semibold">Halaman Utama</span>
            <a href="{{ route('index') }}#beranda"><span>Beranda</span></a>
            <a href="{{ route('index') }}#menu"><span>Menu</span></a>
            <a href="{{ route('index') }}#berita"><span>Berita</span></a>
            <a href="{{ route('index') }}#agenda"><span>Agenda</span></a>
            <a href="{{ route('index') }}#struktur"><span>Kepengurusan</span></a>
        </div>
        <div class="flex flex-col gap-4 text-base font-medium">
            <span class="text-xl font-semibold">Menu</span>
            <a href="{{ route('resident.profil.index') }}"><span>Profil</span></a>
            <a href="{{ route('resident.data-dasawisma.index') }}"><span>Data Penduduk</span></a>
            <a href="{{ route('resident.data-dokumen.index') }}"><span>Pengajuan Dokumen</span></a>
            <a href="{{ route('resident.data-pembayaran.index') }}"><span>Iuran</span></a>
        </div>
        <div class="flex flex-col gap-4 text-base font-medium">
            <span class="text-xl font-semibold">Aspirasi</span>
            <a href="https://forms.gle/a9Qn42ysUN5dZtNE7"><span>Form Aspirasi</span></a>
        </div>
    </div>
    <div class="text-xs font-normal md:mt-3 sm:mt-10">Copyright &copy; 2024 Siruwa - Politeknik Negeri malang</div>
</div>
