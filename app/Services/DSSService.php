<?php

namespace App\Services;
use App\Models\userModel;

class DSSService
{
    public function calculateScores()
    {
        $recipients = userModel::all();
        $criteria = [
            'gaji' => 0.4,
            'pajak_bumi' => 0.2,
            'biaya_listrik' => 0.2,
            'biaya_air' => 0.2,
            'total_pajak_kendaraan' => 0.1,
        ];

        // normalisasi max karena semua kriteria adalah benefit
        $maxGaji = $recipients->max('gaji');
        $maxPajak = $recipients->max('pajak_bumi');
        $maxListrik = $recipients->max('biaya_listrik');
        $maxAir = $recipients->max('biaya_air');
        $maxMotor = $recipients->max('total_pajak_kendaraan');

        $results = [];
        foreach ($recipients as $recipient) {
            $normalizedGaji = $recipient->gaji / $maxGaji;
            $normalizedPajak = $recipient->pajak / $maxPajak;
            $normalizedListrik = $recipient->biaya_listrik / $maxListrik;
            $normalizedAir = $recipient->biaya_air / $maxAir;
            $normalizedMotor = $recipient->total_pajak_kendaraan / $maxMotor;

            $score = ($normalizedGaji * $criteria['gaji']) +
                ($normalizedPajak * $criteria['pajak_bumi']) +
                ($normalizedListrik * $criteria['biaya_listrik']) +
                ($normalizedAir * $criteria['biaya_air']) +
                ($normalizedMotor * $criteria['total_pajak_kendaraan']);

            $results[] = [
                'name' => $recipient->nama,
                'score' => $score
            ];
        }

        // Sorting
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $results;
    }
}