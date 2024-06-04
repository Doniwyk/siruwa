@extends('layouts.landing')
@section('content-landingpage')
<div class="px-16 py-9 flex flex-col gap-16">
    <span class="text-secondary text-4xl font-semibold">Artikel</span>

    <div class="flex flex-row flex-initial">
        <div class="flex flex-col w-screen">
            <div class="flex flex-col gap-3">
                <span class="text-secondary text-2xl font-bold">{{$artikel -> judul}}</span>
                <p>{{$artikel -> created_at}}</p>
                <p>{{$artikel -> nama}}</p>
            </div>
            <div class="flex flex-col gap-6">
                <img src="{{$artikel -> url_gambar}}" class="w-[624px] h-[464] object-none">
                <p>{{$artikel -> isi}}</p>
            </div>
        </div>

        <div class="p-6 bg-secondary rounded-2xl text-white w-96 h-fit">
            <h2 class="text-xl font-semibold mb-4">Agenda</h2>  
            <div class="relative">
                <div class="absolute top-0 left-0 w-10 h-10 flex items-center justify-center bg-white text-secondary rounded-full font-bold z-10">no</div>
                <div class="absolute top-2 left-4 w-1 h-full bg-white"></div>
                <div class="ml-8 p-4 bg-secondary rounded-lg">
                    <img class="rounded-lg mb-2" src="">
                    <span class="text-sm font-semibold"></span>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi, illo aperiam! Sed tenetur nam dignissimos fugiat cumque ut, aperiam dolores impedit consectetur non doloremque laboriosam ea deleniti. Sapiente, nihil repellendus.</p>
                </div>
            </div>
            <div class="relative">
                <div class="absolute top-0 left-0 w-10 h-10 flex items-center justify-center bg-white text-secondary rounded-full font-bold z-10">no</div>
                <div class="absolute top-2 left-4 w-1 h-full bg-white"></div>
                <div class="ml-8 p-4 bg-secondary rounded-lg">
                    <img class="rounded-lg mb-2" src="">
                    <span class="text-sm font-semibold"></span>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi, illo aperiam! Sed tenetur nam dignissimos fugiat cumque ut, aperiam dolores impedit consectetur non doloremque laboriosam ea deleniti. Sapiente, nihil repellendus.</p>
                </div>
            </div>
            <div class="relative">
                <div class="absolute top-0 left-0 w-10 h-10 flex items-center justify-center bg-white text-secondary rounded-full font-bold z-10">no</div>
                <div class="absolute top-2 left-4 w-1 h-full bg-white"></div>
                <div class="ml-8 p-4 bg-secondary rounded-lg">
                    <img class="rounded-lg mb-2" src="">
                    <span class="text-sm font-semibold"></span>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi, illo aperiam! Sed tenetur nam dignissimos fugiat cumque ut, aperiam dolores impedit consectetur non doloremque laboriosam ea deleniti. Sapiente, nihil repellendus.</p>
                </div>
            </div>
        </div>
</div>
@endsection