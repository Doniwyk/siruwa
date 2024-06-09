<?php

namespace App\Http\Controllers;

use App\Contracts\StatisticContract;
use App\Services\CombinedDSSService;
use Illuminate\Http\Request;

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
}
