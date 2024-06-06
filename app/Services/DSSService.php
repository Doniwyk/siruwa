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
            
            'jumlah_tanggungan' => 0.25
        ];

        // Normalisasi max untuk benefit
        $maxGaji = $recipients->max('total_gaji');
        $maxPajak = $recipients->max('total_pajak_bumi');
        $maxListrik = $recipients->max('total_biaya_listrik');
        $maxAir = $recipients->max('total_biaya_air');
        $maxMotor = $recipients->max('total_pajak_kendaraan');
        
        // Normalisasi min untuk cost
        $minTanggungan = $recipients->min('jumlah_tanggungan');

        $results = [];
        foreach ($recipients as $recipient) {
            $normalizedGaji = $maxGaji != 0 ? $recipient->total_gaji / $maxGaji : 0;
            $normalizedPajak = $maxPajak != 0 ? $recipient->total_pajak_bumi / $maxPajak : 0;
            $normalizedListrik = $maxListrik != 0 ? $recipient->total_biaya_listrik / $maxListrik : 0;
            $normalizedAir = $maxAir != 0 ? $recipient->total_biaya_air / $maxAir : 0;
            $normalizedMotor = $maxMotor != 0 ? $recipient->total_pajak_kendaraan / $maxMotor : 0;

            // Normalisasi cost
            $normalizedTanggungan = $recipient->jumlah_tanggungan != 0 ? $minTanggungan / $recipient->jumlah_tanggungan : 0;

            $score = ($normalizedGaji * $criteria['total_gaji']) +
                ($normalizedPajak * $criteria['total_pajak_bumi']) +
                ($normalizedListrik * $criteria['total_biaya_listrik']) +
                ($normalizedAir * $criteria['total_biaya_air']) +
                ($normalizedMotor * $criteria['total_pajak_kendaraan']) +
                ($normalizedTanggungan * $criteria['jumlah_tanggungan']);

            $results[] = [
                'name' => $recipient->nama_kepala_keluarga,
                'nomor_hp' => $recipient->nomor_hp_kepala_keluarga,
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
