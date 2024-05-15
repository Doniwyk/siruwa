<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    //
    public function index()
    {
        $page = 'statistic';
        $title = 'Statistik';
        return view('admin._statistics.index', ['title' => $title, 'page' => $page]);
    }
}
