<?php

namespace App\Services;


class CombinedDSSService
{
    public function calculateScores()
    {
        // Menghitung skor dari DSSService
        $dssService = new DSSService();
        $dssResults = $this->normalizeScores($dssService->calculateScores());

        // Menghitung skor dari DSSFuzzyService
        $dssFuzzyService = new DSSFuzzyService();
        $fuzzyResults = $this->normalizeScores($dssFuzzyService->calculateScores());

        // Menggabungkan hasil
        $combinedResults = $this->combineScores($dssResults, $fuzzyResults);

        // Sorting
        usort($combinedResults, function ($a, $b) {
            return $b['combined_score'] <=> $a['combined_score'];
        });

        return $combinedResults;
    }

    private function normalizeScores($results)
    {
        $maxScore = max(array_column($results, 'score'));
        $minScore = min(array_column($results, 'score'));

        foreach ($results as &$result) {
            $result['normalized_score'] = ($result['score'] - $minScore) / ($maxScore - $minScore);
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
                        'combined_score' => $combinedScore,
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
