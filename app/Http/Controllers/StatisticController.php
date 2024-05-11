<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    //
    public function index()
    {
        $page = 'statistic';
        $pageHeader = 'Statistik';
        return view('admin._statistics.index', ['pageHeader' => $pageHeader, 'page' => $page]);
    }
}
