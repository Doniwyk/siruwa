<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DSSService;

class DSSController extends Controller
{
    protected $dssService;

    public function __construct(DSSService $sawService)
    {
        $this->dssService = $sawService;
    }

    public function index()
    {
        try {
            $results = $this->dssService->calculateScores();
            return view('banusosu', compact('results'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
