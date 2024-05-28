<?php

namespace App\Http\Controllers;

use App\Services\DSSFuzzyService;

class DSSFuzzyController extends Controller
{
    protected $dssfuzzy;

    public function __construct(DSSFuzzyService $dssfuzzy)
    {
        $this->dssfuzzy = $dssfuzzy;
    }

    public function index()
    {
        // $results = $this->dssfuzzy->calculateScores();
        // return view('banusosu2', compact('results'));

        $results = $this->dssfuzzy->calculateScores();
        return view('banusosu2', ['results' => $results]);
    }
}
