<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DSSService;
use App\Services\DSSFuzzyService;
use App\Services\CombinedDSSService;


class DSSController extends Controller
{
    protected $dssService;
    protected $dssFuzzyService;
    protected $combinedDSSService;

    public function __construct(DSSService $sawService, DSSFuzzyService $fuzzyService, CombinedDSSService $combinedService)
    {
        $this->dssService = $sawService;
        $this->dssFuzzyService = $fuzzyService;
        $this->combinedDSSService = $combinedService;
    }

    public function index(Request $request)
    {
        try {
            $results = $this->dssService->calculateScores();
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
                case 'combined':
                    $results = $this->combinedDSSService->calculateScores();
                    break;
                default:
                    $results = [];
                    break;
            }
        
            $limit = $request->query('limit', 5); // Default limit is 5

            if ($limit == -1) {
                // Tampilkan semua data
                $limitedResults = $results; 
            } else {
                // Tampilkan data dengan batasan limit
                $limitedResults = array_slice($results, 0, $limit);
            }
        
            return view('admin._statistics.bansos', compact('limitedResults', 'typeDocument', 'title', 'page', 'limit'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
