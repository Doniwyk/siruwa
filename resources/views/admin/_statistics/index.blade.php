@extends('layouts.admin')
@section('content')
    <h1 class="h1-semibold">Statistik</h1>
    <section class="flex-start flex-wrap gap-3 w-full ">
        <div class="bg-white sm:basis-full md:basis-[49%] p-8 rounded-2xl">
            <x-s-p-k-table :results="$results"/>
        </div>
        <div class="bg-white sm:basis-full md:basis-[49%] p-8 rounded-2xl">
            <x-chart.resident-total-line-chart/>
        </div>
        <div class="bg-white sm:basis-full md:basis-[49%] p-8 rounded-2xl">
            <x-chart.job-pie-chart/>
        </div>
        <div class="bg-white sm:basis-full md:basis-[49%] p-8 rounded-2xl ">
            <x-chart.last-studied-pie-chart/>
        </div>
    </section>
@endsection
@yield('jobChartScript')
@yield('lastStudiedChartScript')
@yield('residentTotalChartScript')