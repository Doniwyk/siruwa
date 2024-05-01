<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiUwU</title>
    @vite('resources/css/app.css')
</head>

<body class="">
    <div class="z-10 fixed bg-nav w-full px-20 py-4 items-center gap-6 inline-flex justify-end padding margin-10">
        <span class="text-center text-stone-50 text-3xl font-extrabold font-['Baloo 2']">>///<</span>
        <div class="w-screen h-14 text-center gap-8 flex justify-end items-center">
            <span class="text-white text-sm font-medium font-['Anek Tamil']">KEPENGURUSAN</span>
            <span class="text-white text-sm font-medium font-['Anek Tamil']">AGENDA</span>
            <span class="text-white text-sm font-medium font-['Anek Tamil']">BERITA</span>
            <span class="text-white text-sm font-medium font-['Anek Tamil']">MENU</span>
            <span class="text-white text-sm font-medium font-['Anek Tamil']">BERANDA</span>
        </div>

                <!-- MyUwU login -->
                <div class="bg-white rounded-2xl flex-center gap-8 flex-auto">
                    <div class="flex-center gap-4 inline-flex py-2 px-8">
                        <span class="text-center text-teal-900 text-sm font-medium font-['Anek Tamil']">MyUwU</span>
                        <img class="w-11 h-11 rounded-full" src="https://via.placeholder.com/44x44" />
                    </div>
                </div>
    </div>

    <!-- Beranda -->
    <section class="bg_beranda flex justify-center content-center p-72 w-full h-screen">
        <div class="flex flex-col justify-start items-center gap-16 w-3/4">
            <div class="flex flex-col gap-10">
                <span class="text-center text-bg-nav text-8xl font-extrabold font-['Anek Tamil'] leading-10">SIUwU</span>
                <span class="text-center text-bg-nav text-4xl font-semibold font-['Anek Tamil'] leading-10">Sistem Informasi Kawaiiiii</span>
            </div>
            <p class="text-center text-bg0nav text-2xl font-medium font-['Anek Tamil'] leading-9">Selamat datang di SIUwU, jelajahi aplikasi web mutakhir untuk mengatur segala hal di dunia.</p>
        </div>
    </section>

    <!-- Menu -->
    <section class="bg-nav flex justify-center content-center p-72 w-full h-96">
        <div class="w-96 px-16 flex-col justify-start items-center gap-11 inline-flex">
            <span class="self-stretch text-center text-white text-5xl font-semibold font-['Anek Tamil']">Menu</span>
            <img src="{{ asset('public/bg_beranda.jpg') }}" alt="">
        </div>
    </section>

    <section class="bg-bg_color flex justify-center content-center p-72 w-full h-screen">
    <div class="w-96 h-96 flex-col justify-start items-start gap-3 inline-flex">
  <div class="w-96 justify-between items-center inline-flex">
    <div class="text-cyan-900 text-5xl font-semibold font-['Anek Tamil'] leading-10">Berita</div>
    <div class="px-8 py-3 bg-cyan-900 rounded-2xl flex-col justify-start items-end gap-2.5 inline-flex">
      <div class="self-stretch justify-start items-center gap-8 inline-flex w-72">
        <div class="text-white text-2xl font-medium font-['Anek Tamil'] leading-9">Lebih Banyak</div>
        <div class="w-6 h-6 flex-center flex">
          <div class="w-6 h-6 relative">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-96 h-96 relative">
    <div class="w-96 h-96 left-[650.86px] top-0 absolute">
      <div class="w-96 h-72 pl-6 pr-5 pt-28 pb-5 left-0 top-0 absolute rounded-2xl flex-center inline-flex">
        <div class="w-96 self-stretch p-6 bg-black bg-opacity-50 rounded-2xl flex-col justify-end items-start gap-2.5 inline-flex">
          <div class="justify-start items-center gap-2 inline-flex">
            <div class="w-4 h-4 flex-center flex">
              <div class="w-4 h-4 relative">
              </div>
            </div>
            <div class="text-stone-100 text-xl font-medium font-['Anek Tamil']">March, 15 2024</div>
          </div>
          <div class="self-stretch text-justify text-stone-100 text-xl font-semibold font-['Anek Tamil']">Sejumlah mahasiswa Politeknik Negeri Malang mengunjungi Desa Seumberejo untuk mewujudkan digitalisasi Indonesia.</div>
        </div>
      </div>
      <div class="w-96 h-72 pl-6 pr-5 pt-28 pb-5 left-0 top-[300.99px] absolute rounded-2xl flex-center inline-flex">
        <div class="w-96 self-stretch p-6 bg-black bg-opacity-50 rounded-2xl flex-col justify-end items-start gap-2.5 inline-flex">
          <div class="justify-start items-center gap-2 inline-flex">
            <div class="w-4 h-4 flex-center flex">
              <div class="w-4 h-4 relative">
              </div>
            </div>
            <div class="text-stone-100 text-base font-medium font-['Anek Tamil']">March, 16 2024</div>
          </div>
          <div class="self-stretch text-justify text-stone-100 text-xl font-semibold font-['Anek Tamil']">Kementerian Komunikasi dan Informatika mengatakan perusahaan yang bergerak di bidang game harus berbadan...</div>
        </div>
      </div>
    </div>
    <div class="w-96 h-96 p-6 left-0 top-0 absolute rounded-2xl flex-col justify-end items-center gap-2.5 inline-flex">
      <div class="self-stretch h-36 p-6 bg-black bg-opacity-50 rounded-2xl flex-col justify-end items-start gap-2.5 flex">
        <div class="justify-start items-center gap-2 inline-flex">
          <div class="w-4 h-4 flex-center flex">
            <div class="w-4 h-4 relative">
            </div>
          </div>
          <div class="text-stone-100 text-base font-medium font-['Anek Tamil']">March, 14 2024</div>
        </div>
        <div class="self-stretch text-justify text-stone-100 text-xl font-semibold font-['Anek Tamil']">Politeknik Negeri Malang terjerat kasus dugaan korupsi pengadaan tanah senilai 40M, 2 direktur diperiksa.</div>
      </div>
    </div>
  </div>
</div>
    </section>
</body>

</html>
