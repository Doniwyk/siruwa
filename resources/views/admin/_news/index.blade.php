@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Data Penduduk</h1>
    <div class="summary-card_news">
        <div class="summary-card card-total">
            <div class=" border-b border-r">
                <label for="">500</label>
                <label for="">Berita Diunggah</label>
            </div>
            <div class=" border-b border-l">
                <label for="">2</label>
                <label for="">Berita Diunggah</label>
            </div>
            <div class=" border-t border-r">
                <label for="">5</label>
                <label for="">Berita Diunggah</label>
            </div>
            <div class=" border-t border-l">
                <label for="">3</label>
                <label for="">Berita Diunggah</label>
            </div>

        </div>
        <div class="summary-card card-top flex flex-col gap-5">
            <h4 class="text-xl text-main font-semibold">Berita teratas</h4>
            <div class="news flex gap-5">
                <img src="{{ asset('assets/img/news-img.png') }}" alt="img">
                <div class="desc">
                    <label for="">Maret, 14 2024 | 600 kali dilihat | 50 komentar</label>
                    <p class="desc-news">Politeknik Negeri Malang terjerat kasus dugaan korupsi pengadaan tanah senilai 40
                        M, dua dir...</p>
                </div>
            </div>
            <div class="news flex gap-5">
                <img src="{{ asset('assets/img/news-img.png') }}" alt="img">
                <div class="desc">
                    <label for="">Maret, 14 2024 | 600 kali dilihat | 50 komentar</label>
                    <p class="desc-news">Politeknik Negeri Malang terjerat kasus dugaan korupsi pengadaan tanah senilai 40
                        M, dua dir...</p>
                </div>
            </div>
        </div>
    </div>
    <div class="add-news flex justify-end">
        <button class="h-[3rem] w-[15rem] bg-main text-white rounded-2xl flex-center gap-3">
            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10.4993 18.3332C15.0827 18.3332 18.8327 14.5832 18.8327 9.99984C18.8327 5.4165 15.0827 1.6665 10.4993 1.6665C5.91602 1.6665 2.16602 5.4165 2.16602 9.99984C2.16602 14.5832 5.91602 18.3332 10.4993 18.3332Z"
                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7.16602 9.99902H13.8327" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10.5 13.3327V6.66602" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <label for="">Buat Berita</label>
        </button>
    </div>
    <x-filter />
    <table class="table-parent">
        <thead>
            <tr>
                <th>Judul Berita</th>
                <th>Detail Berita</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-base font-medium">
            @foreach ($news as $n)
                <tr>
                    <td>
                        <div class="flex gap-5 text-main">
                            <img src="{{ $n['url_gambar'] }}" alt="logo" class="w-[8.2rem] h-20 rounded-2xl">
                            <p class="desc-news">
                                {{ $n['judul'] }}
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="grid grid-rows-2 grid-cols-2 gap-4">
                            <div class="details">
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.2505 13.8166C12.1958 13.8236 13.1058 13.4709 13.8042 12.836C16.111 10.8185 14.8765 6.76927 11.8361 6.38833C10.7497 -0.200457 1.24744 2.29679 3.49779 8.56813"
                                        stroke="#225157" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M4.66916 8.85724C4.29528 8.66677 3.87907 8.56801 3.46286 8.57506C0.175521 8.80785 0.182575 13.5907 3.46286 13.8235"
                                        stroke="#225157" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M10.6934 6.68474C11.0602 6.50132 11.4552 6.40256 11.8644 6.39551"
                                        stroke="#225157" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M7.27197 15.2275V10.4058M7.27197 10.4058L5.67773 12M7.27197 10.4058L8.86621 12"
                                        stroke="#225157" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <label for="">Maret, 14 2024</label>
                            </div>
                            <div class="details">
                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.74023 9.67523L5.29023 10.8752C5.49023 11.0752 5.94023 11.1752 6.24023 11.1752H8.14023C8.74023 11.1752 9.39023 10.7252 9.54023 10.1252L10.7402 6.47523C10.9902 5.77523 10.5402 5.17523 9.79023 5.17523H7.79023C7.49023 5.17523 7.24023 4.92523 7.29023 4.57523L7.54023 2.97523C7.64023 2.52523 7.34023 2.02523 6.89023 1.87523C6.49023 1.72523 5.99023 1.92523 5.79023 2.22523L3.74023 5.27523"
                                        stroke="#225157" stroke-miterlimit="10" />
                                    <path
                                        d="M1.18945 9.6752V4.7752C1.18945 4.0752 1.48945 3.8252 2.18945 3.8252H2.68945C3.38945 3.8252 3.68945 4.0752 3.68945 4.7752V9.6752C3.68945 10.3752 3.38945 10.6252 2.68945 10.6252H2.18945C1.48945 10.6252 1.18945 10.3752 1.18945 9.6752Z"
                                        stroke="#225157" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <label for="">600 disukai</label>
                            </div>
                            <div class="details">
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.3866 8.49995C10.3866 9.81995 9.31995 10.8866 7.99995 10.8866C6.67995 10.8866 5.61328 9.81995 5.61328 8.49995C5.61328 7.17995 6.67995 6.11328 7.99995 6.11328C9.31995 6.11328 10.3866 7.17995 10.3866 8.49995Z"
                                        stroke="#225157" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M7.9999 14.0133C10.3532 14.0133 12.5466 12.6266 14.0732 10.2266C14.6732 9.28665 14.6732 7.70665 14.0732 6.76665C12.5466 4.36665 10.3532 2.97998 7.9999 2.97998C5.64656 2.97998 3.45323 4.36665 1.92656 6.76665C1.32656 7.70665 1.32656 9.28665 1.92656 10.2266C3.45323 12.6266 5.64656 14.0133 7.9999 14.0133Z"
                                        stroke="#225157" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <label for="">600 dilihat</label>
                            </div>
                            <div class="details">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.49997 12C6.14695 12 5.81439 11.8214 5.57905 11.5102L4.81161 10.4898C4.79626 10.4694 4.73486 10.4439 4.70928 10.4388H4.45347C2.31999 10.4388 1 9.86224 1 6.9949V4.44388C1 2.18878 2.19209 1 4.45347 1H8.54647C10.8079 1 11.9999 2.18878 11.9999 4.44388V6.9949C11.9999 9.25 10.8079 10.4388 8.54647 10.4388H8.29066C8.24973 10.4388 8.21392 10.4592 8.18834 10.4898L7.4209 11.5102C7.18555 11.8214 6.85299 12 6.49997 12ZM4.45347 1.76531C2.62185 1.76531 1.76744 2.61735 1.76744 4.44388V6.9949C1.76744 9.30102 2.56046 9.67347 4.45347 9.67347H4.70928C4.97021 9.67347 5.26695 9.82143 5.42556 10.0306L6.193 11.051C6.37207 11.2857 6.62788 11.2857 6.80695 11.051L7.57439 10.0306C7.74322 9.80612 8.00927 9.67347 8.29066 9.67347H8.54647C10.3781 9.67347 11.2325 8.82143 11.2325 6.9949V4.44388C11.2325 2.61735 10.3781 1.76531 8.54647 1.76531H4.45347Z"
                                        fill="#225157" stroke="#225157" stroke-width="0.5" />
                                    <path
                                        d="M6.49991 6.48476C6.2134 6.48476 5.98828 6.25517 5.98828 5.97456C5.98828 5.69395 6.21851 5.46436 6.49991 5.46436C6.7813 5.46436 7.01153 5.69395 7.01153 5.97456C7.01153 6.25517 6.78642 6.48476 6.49991 6.48476Z"
                                        fill="#225157" stroke="#225157" stroke-width="0.5" />
                                    <path
                                        d="M8.54678 6.48476C8.26027 6.48476 8.03516 6.25517 8.03516 5.97456C8.03516 5.69395 8.26539 5.46436 8.54678 5.46436C8.82818 5.46436 9.05841 5.69395 9.05841 5.97456C9.05841 6.25517 8.83329 6.48476 8.54678 6.48476Z"
                                        fill="#225157" stroke="#225157" stroke-width="0.5" />
                                    <path
                                        d="M4.45303 6.48476C4.16652 6.48476 3.94141 6.25517 3.94141 5.97456C3.94141 5.69395 4.17164 5.46436 4.45303 5.46436C4.73443 5.46436 4.96466 5.69395 4.96466 5.97456C4.96466 6.25517 4.73954 6.48476 4.45303 6.48476Z"
                                        fill="#225157" stroke="#225157" stroke-width="0.5" />
                                </svg>
                                <label for="">20 komentar</label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="action flex gap-6">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.5 22H3.5C3.09 22 2.75 21.66 2.75 21.25C2.75 20.84 3.09 20.5 3.5 20.5H21.5C21.91 20.5 22.25 20.84 22.25 21.25C22.25 21.66 21.91 22 21.5 22Z"
                                    fill="#225157" />
                                <path
                                    d="M19.5206 3.48016C17.5806 1.54016 15.6806 1.49016 13.6906 3.48016L12.4806 4.69016C12.3806 4.79016 12.3406 4.95016 12.3806 5.09016C13.1406 7.74016 15.2606 9.86016 17.9106 10.6202C17.9506 10.6302 17.9906 10.6402 18.0306 10.6402C18.1406 10.6402 18.2406 10.6002 18.3206 10.5202L19.5206 9.31016C20.5106 8.33016 20.9906 7.38016 20.9906 6.42016C21.0006 5.43016 20.5206 4.47016 19.5206 3.48016Z"
                                    fill="#225157" />
                                <path
                                    d="M16.1103 11.5298C15.8203 11.3898 15.5403 11.2498 15.2703 11.0898C15.0503 10.9598 14.8403 10.8198 14.6303 10.6698C14.4603 10.5598 14.2603 10.3998 14.0703 10.2398C14.0503 10.2298 13.9803 10.1698 13.9003 10.0898C13.5703 9.8098 13.2003 9.4498 12.8703 9.0498C12.8403 9.0298 12.7903 8.9598 12.7203 8.8698C12.6203 8.7498 12.4503 8.5498 12.3003 8.3198C12.1803 8.1698 12.0403 7.9498 11.9103 7.7298C11.7503 7.4598 11.6103 7.1898 11.4703 6.9098C11.4491 6.86441 11.4286 6.81924 11.4088 6.77434C11.2612 6.44102 10.8265 6.34358 10.5688 6.60133L4.84032 12.3298C4.71032 12.4598 4.59032 12.7098 4.56032 12.8798L4.02032 16.7098C3.92032 17.3898 4.11032 18.0298 4.53032 18.4598C4.89032 18.8098 5.39032 18.9998 5.93032 18.9998C6.05032 18.9998 6.17032 18.9898 6.29032 18.9698L10.1303 18.4298C10.3103 18.3998 10.5603 18.2798 10.6803 18.1498L16.4016 12.4285C16.6612 12.1689 16.5633 11.7235 16.2257 11.5794C16.1877 11.5632 16.1492 11.5467 16.1103 11.5298Z"
                                    fill="#225157" />
                            </svg>
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.5697 5.23C19.9597 5.07 18.3497 4.95 16.7297 4.86V4.85L16.5097 3.55C16.3597 2.63 16.1397 1.25 13.7997 1.25H11.1797C8.84967 1.25 8.62967 2.57 8.46967 3.54L8.25967 4.82C7.32967 4.88 6.39967 4.94 5.46967 5.03L3.42967 5.23C3.00967 5.27 2.70967 5.64 2.74967 6.05C2.78967 6.46 3.14967 6.76 3.56967 6.72L5.60967 6.52C10.8497 6 16.1297 6.2 21.4297 6.73C21.4597 6.73 21.4797 6.73 21.5097 6.73C21.8897 6.73 22.2197 6.44 22.2597 6.05C22.2897 5.64 21.9897 5.27 21.5697 5.23Z"
                                    fill="#DA2121" />
                                <path
                                    d="M19.7298 8.14C19.4898 7.89 19.1598 7.75 18.8198 7.75H6.17975C5.83975 7.75 5.49975 7.89 5.26975 8.14C5.03975 8.39 4.90975 8.73 4.92975 9.08L5.54975 19.34C5.65975 20.86 5.79975 22.76 9.28975 22.76H15.7098C19.1998 22.76 19.3398 20.87 19.4498 19.34L20.0698 9.09C20.0898 8.73 19.9598 8.39 19.7298 8.14ZM14.1597 17.75H10.8298C10.4198 17.75 10.0798 17.41 10.0798 17C10.0798 16.59 10.4198 16.25 10.8298 16.25H14.1597C14.5697 16.25 14.9097 16.59 14.9097 17C14.9097 17.41 14.5697 17.75 14.1597 17.75ZM14.9998 13.75H9.99975C9.58975 13.75 9.24975 13.41 9.24975 13C9.24975 12.59 9.58975 12.25 9.99975 12.25H14.9998C15.4097 12.25 15.7498 12.59 15.7498 13C15.7498 13.41 15.4097 13.75 14.9998 13.75Z"
                                    fill="#DA2121" />
                            </svg>

                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div>
        {{ $news->links('pagination::default') }}
    </div>
@endsection
