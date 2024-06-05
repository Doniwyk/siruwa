<?php

namespace App\Http\Controllers;

use App\Services\CombinedDSSService;

class DSSCombinedController extends Controller
{
    public function index()
    {
        try{
        $dssService = new CombinedDSSService();
        $results = $dssService->calculateScores();

        return view('admin._statistics.index', compact('results'));
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
