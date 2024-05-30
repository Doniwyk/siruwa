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
        $jobData = $this->statisticContract->countJobData();
        $educationData = $this->statisticContract->countEducationData();
        return view('admin._statistics.index', ['title' => $title, 'page' => $page, 'jobData'=>$jobData, 'educationData'=>$educationData]);
    }
}
