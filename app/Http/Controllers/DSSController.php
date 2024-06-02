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
        $results = $this->dssService->calculateScores();
        return view('banusosu', compact('results'));
    }
}