@extends('layouts.admin')
@section('title')
    Statistik
@endsection
@section('head_script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('content')
    <h1 class="h1-semibold">Statistik</h1>
    <section class="flex-start flex-wrap gap-3 w-full ">
        <div class="statistic-card sm:min-h-[31.125rem] md:h-[40rem]">
            <x-s-p-k-table :results="$results" />
            <div class="flex-end mt-4">
                <a class="button-main flex items-center justify-between w-32 py-2 rounded-2xl p-4 bg-main font-semibold text-white"
                    href="{{ route('admin.statistic.bansos') }}">
                    <div name="action">Detail</div>
                    <x-icon.spk />
                </a>
            </div>
        </div>

        <div class="statistic-card-ageDistribution">
            <x-chart.resident-age-column-chart/>
        </div>

        <div class="statistic-card">
            <x-chart.job-pie-chart />
        </div>
        
        <div class="statistic-card ">
            <x-chart.last-studied-pie-chart />
        </div>
    </section>
@endsection
