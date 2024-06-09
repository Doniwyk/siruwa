@extends('layouts.admin')
@section('title')
Statistik
@endsection
@section('content')
    <h1 class="h1-semibold">Statistik</h1>
    <section class="flex-start flex-wrap gap-3 w-full ">
        <div class="bg-white sm:basis-full md:basis-[49%] p-8 rounded-2xl">    
        <x-s-p-k-table :results="$results"/>
        <div class="flex-end mt-4">
            <a class="button-main flex items-center justify-between w-32 py-2 rounded-2xl p-4 bg-main font-semibold text-white" href="{{ route('admin.statistic.bansos') }}">
                <div name="action">Detail</div>
                <x-icon.spk/>
            </a>
        </div>
        </div>
        <div class="statistic-card">
            <x-chart.resident-total-line-chart/>
        </div>
        <div class="statistic-card">
            <x-chart.job-pie-chart/>
        </div>
        <div class="statistic-card ">
            <x-chart.last-studied-pie-chart/>
        </div>
    </section>
@endsection
@yield('jobChartScript')
@yield('lastStudiedChartScript')
@yield('residentTotalChartScript')