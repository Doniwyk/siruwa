<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $page = 'statistik';
        return view('admin.pages.statistik', ['pages' => 'statistik', 'page' => $page]);
    }
}
