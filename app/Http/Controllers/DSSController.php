<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DSSService;
use App\Services\DSSFuzzyService;

use function PHPSTORM_META\type;

class DSSController extends Controller
{
    protected $dssService;
    protected $dssFuzzyService;

    public function __construct(DSSService $sawService, DSSFuzzyService $fuzzyService)
    {
        $this->dssService = $sawService;
        $this->dssFuzzyService = $fuzzyService;
    }

    public function index(Request $request)
    {
        $typeDocument = $request->query('typeDocument', 'fuzzy');
        $title = 'Sistem Pendukung Keputusan Bansos';
        $page = 'SPK Bansos';

        switch ($typeDocument) {
            case 'saw':
                $results = $this->dssService->calculateScores();
                break;
            case 'fuzzy':
                $results = $this->dssFuzzyService->calculateScores();
                break;
            default:

                break;
        }
        return view('admin._statistics.bansos', compact('results', 'typeDocument', 'title', 'page'));  
    }
}