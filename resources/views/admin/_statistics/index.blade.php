@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Statistik</h1>
    <section class="flex-start flex-wrap gap-3 w-full ">
        <div class="bg-white flex flex-end flex-col basis-[51%] h-auto p-8 rounded-2xl gap-4">
            <x-s-p-k-table :results="$results"/>
        </div>
        <div class="bg-white basis-[47%] h-48 p-8 rounded-2xl">
            <x-chart.resident-total-line-chart/>
        </div>
        <div class="bg-white basis-[49%] h-[28.5rem] p-8 rounded-2xl">
            <x-chart.job-pie-chart/>
        </div>
        <div class="bg-white basis-[49%] h-[28.5rem] p-8 rounded-2xl ">
            <x-chart.last-studied-pie-chart/>
        </div>
    </section>
@endsection
@yield('jobChartScript')
@yield('lastStudiedChartScript')
@yield('residentTotalChartScript')