<?php

namespace App\Services;

use App\Services\DSSService;
use App\Services\DSSFuzzyService;

class CombinedDSSService
{
    public function calculateScores()
    {
        // Menghitung skor dari DSSService
        $dssService = new DSSService();
        $dssResults = $dssService->calculateScores();
        $normalizedDssResults = $this->normalizeScores($dssResults);

        // Menghitung skor dari DSSFuzzyService
        $dssFuzzyService = new DSSFuzzyService();
        $fuzzyResults = $dssFuzzyService->calculateScores();
        $normalizedFuzzyResults = $this->normalizeScores($fuzzyResults);

        // Menggabungkan hasil
        $combinedResults = $this->combineScores($normalizedDssResults, $normalizedFuzzyResults);

        // Sorting
        usort($combinedResults, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $combinedResults;
    }

    private function normalizeScores($results)
    {
        $maxScore = max(array_column($results, 'score'));

        foreach ($results as &$result) {
            $result['normalized_score'] = $result['score'] / $maxScore;
        }

        return $results;
    }

    private function combineScores($dssResults, $fuzzyResults)
    {
        $combinedResults = [];

        foreach ($dssResults as $dssResult) {
            foreach ($fuzzyResults as $fuzzyResult) {
                if ($dssResult['name'] == $fuzzyResult['name']) {
                    $combinedScore = ($dssResult['normalized_score'] + $fuzzyResult['normalized_score']) / 2;

                    $combinedResults[] = [
                        'name' => $dssResult['name'],
                        'score' => $combinedScore,
                        'nomor_hp' => $dssResult['nomor_hp'],
                        'dss_score' => $dssResult['score'],
                        'fuzzy_score' => $fuzzyResult['score'],
                    ];
                    break;
                }
            }
        }

        return $combinedResults;
    }
}
