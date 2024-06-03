<?php

namespace App\Http\Controllers;

use App\Services\CombinedDSSService;

class DSSCombinedController extends Controller
{
    public function index()
    {
        $dssService = new CombinedDSSService();
        $results = $dssService->calculateScores();

        return view('admin._statistics.index', compact('results'));
    }
}
