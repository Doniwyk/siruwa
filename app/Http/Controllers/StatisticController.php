<?php

namespace App\Http\Controllers;

use App\Contracts\StatisticContract;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    //
    protected StatisticContract $statisticContract;
    public function __construct(StatisticContract $statisticContract ) {
        $this->statisticContract = $statisticContract;
    }

    public function index()
    {
        $page = 'statistic';
        $title = 'Statistik';
        return view('admin._statistics.index', compact('title', 'page'));
    }
    public function getJobData(){
        $jobData = $this->statisticContract->countJobData();
        return response()->json(['data'=>$jobData]);
    }
    public function getLastStudiedData(){
        $studiedData = $this->statisticContract->countEducationData();
        return response()->json(['data'=>$studiedData]);
    }
}
