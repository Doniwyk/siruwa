<?php

namespace App\Http\Controllers;

use App\Contracts\StatisticContract;
use App\Models\UserModel;
use App\Services\CombinedDSSService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticController extends Controller
{
    //
    protected StatisticContract $statisticContract;
    public function __construct(StatisticContract $statisticContract)
    {
        $this->statisticContract = $statisticContract;
    }

    public function index()
    {
        try {
            $page = 'statistic';
            $dssService = new CombinedDSSService();
            $results = $dssService->calculateScores();
            return view('admin._statistics.index', compact('page', 'results'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
    public function getJobData()
    {
        try {
            $jobData = $this->statisticContract->countJobData();
            return response()->json(['data' => $jobData]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data pekerjaan tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
    public function getLastStudiedData()
    {
        try {
            $studiedData = $this->statisticContract->countEducationData();
            return response()->json(['data' => $studiedData]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data pendidikan tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function getAgeDistribution()
{
    $ages = UserModel::all()->map(function ($user) {
        return Carbon::parse($user->tgl_lahir)->age;
    });

    $ageDistribution = [
        '0-10' => $ages->filter(function ($age) { return $age <= 10; })->count(),
        '11-20' => $ages->filter(function ($age) { return $age >= 11 && $age <= 20; })->count(),
        '21-30' => $ages->filter(function ($age) { return $age >= 21 && $age <= 30; })->count(),
        '31-40' => $ages->filter(function ($age) { return $age >= 31 && $age <= 40; })->count(),
        '41-50' => $ages->filter(function ($age) { return $age >= 41 && $age <= 50; })->count(),
        '51-60' => $ages->filter(function ($age) { return $age >= 51 && $age <= 60; })->count(),
        '61+' => $ages->filter(function ($age) { return $age >= 61; })->count(),
    ];
    return response()->json(['data' => $ageDistribution]);
}
}
