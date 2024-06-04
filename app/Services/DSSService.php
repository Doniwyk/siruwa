<?php

namespace App\Services;

use App\Models\DSSModel;

class DSSService
{
    public function calculateScores()
    {
        $recipients = DSSModel::all();
        $criteria = [
            'total_gaji' => 0.3,
            'total_pajak_bumi' => 0.15,
            'total_biaya_listrik' => 0.05,
            'total_biaya_air' => 0.05,
            'total_pajak_kendaraan' => 0.2,
            // 'jumlah_tanggungan' => 0.25
        ];

        // normalisasi max untuk benefit
        $maxGaji = $recipients->max('total_gaji');
        $maxPajak = $recipients->max('total_pajak_bumi');
        $maxListrik = $recipients->max('total_biaya_listrik');
        $maxAir = $recipients->max('total_biaya_air');
        $maxMotor = $recipients->max('total_pajak_kendaraan');
        
        // normalisasi min untuk cost
        // $minTanggungan = $recipients->min('jumlah_tanggungan');

        $results = [];
        foreach ($recipients as $recipient) {
            $normalizedGaji = $recipient->total_gaji / $maxGaji;
            $normalizedPajak = $recipient->total_pajak_bumi / $maxPajak;
            $normalizedListrik = $recipient->total_biaya_listrik / $maxListrik;
            $normalizedAir = $recipient->total_biaya_air / $maxAir;
            $normalizedMotor = $recipient->total_pajak_kendaraan / $maxMotor;
            
            // Normalisasi cost
            // $normalizedTanggungan = $minTanggungan / $recipient->jumlah_tanggungan;

            $score = ($normalizedGaji * $criteria['total_gaji']) +
                ($normalizedPajak * $criteria['total_pajak_bumi']) +
                ($normalizedListrik * $criteria['total_biaya_listrik']) +
                ($normalizedAir * $criteria['total_biaya_air']) +
                ($normalizedMotor * $criteria['total_pajak_kendaraan']);
                // + ($normalizedTanggungan * $criteria['jumlah_tanggungan']);

            $results[] = [
                'name' => $recipient->nomor_kk,
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
