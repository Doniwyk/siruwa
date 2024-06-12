<?php

namespace App\Services;

use App\Models\DSSModel;

class DSSFuzzyService
{
    public $maxValue = 1000000000;

    public function calculateScores()
    {
        $recipients = DSSModel::all();

        $results = [];

        foreach ($recipients as $recipient) {
            // Fuzzification
            $gaji = $this->fuzzifyGaji($recipient->total_gaji);
            $pajakBumi = $this->fuzzifyPajakBumi($recipient->total_pajak_bumi);
            $biayaListrik = $this->fuzzifyBiayaListrik($recipient->total_biaya_listrik);
            $biayaAir = $this->fuzzifyBiayaAir($recipient->total_biaya_air);
            $PajakKendaraan = $this->fuzzifyPajakKendaraan($recipient->total_pajak_kendaraan);
            $jumlahTanggungan = $this->fuzzifyJumlahTanggungan($recipient->jumlah_tanggungan);

            // $gaji = $this->fuzzifyGaji(14755167.33);
            // $pajakBumi = $this->fuzzifyPajakBumi(302180.89);
            // $biayaListrik = $this->fuzzifyBiayaListrik(87943.1);
            // $biayaAir = $this->fuzzifyBiayaAir(75915.57);
            // $PajakKendaraan = $this->fuzzifyPajakKendaraan(230823.42);
            // $jumlahTanggungan = $this->fuzzifyJumlahTanggungan(3);

            // Rule Evaluation
            $score = $this->evaluateRules($gaji, $pajakBumi, $biayaListrik, $biayaAir, $PajakKendaraan, $jumlahTanggungan);

            // dd($gaji, $pajakBumi, $biayaListrik, $biayaAir, $PajakKendaraan, $jumlahTanggungan);

            // Defuzzification
            $crispScore = $this->defuzzify($score);

            $results[] = [
                'nomor_hp' => $recipient->nomor_hp_kepala_keluarga,
                'name' => $recipient->nama_kepala_keluarga,
                'score' => $crispScore
            ];
        }

        // Sorting
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Kategori
        // foreach ($results as &$result) {
        //     if ($result['score'] >= 1.8) {
        //         $result['category'] = 'Utama';
        //     } elseif ($result['score'] >= 1.5) {
        //         $result['category'] = 'Sedang';
        //     } else {
        //         $result['category'] = 'Rendah';
        //     }
        // }    

        // dd($results);

        return $results;
    }
    
    private function evalMembership($x, $a, $b, $c, $d)
    {
        // Metode trapezoidal (dibagi 4 kriteria keanggotaan)
        if ($x <= $a) {
            return 0;
        } elseif ($x > $a && $x <= $b) {
            return ($x - $a) / ($b - $a);
        } elseif ($x > $b && $x <= $c) {
            return 1;
        } elseif ($x > $c && $x < $d) {
            return ($d - $x) / ($d - $c);
        } else {
            return 0;
        }
    // } else {
    //     return 1;
    // }
    }

    private function fuzzifyGaji($gaji)
    {
        $maxValues = $this->maxValue;
        $low = $this->evalMembership($gaji, 3000000, 3500000, 5000000, $maxValues);
        $medium = $this->evalMembership($gaji, 1000000, 1500000, 2500000, 3000000);
        $high = $this->evalMembership($gaji, 0, 0, 1000000, 1500000);

        // dd($low, $medium, $high);
        // dd($maxValues);
        
        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyPajakBumi($pajakBumi)
    {
        $maxValues = $this->maxValue;
        $low = $this->evalMembership($pajakBumi, 500000, 600000, 1000000, $maxValues);
        $medium = $this->evalMembership($pajakBumi, 75000, 125000, 300000, 500000);
        $high = $this->evalMembership($pajakBumi, 0, 0, 50000, 100000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyBiayaListrik($biayaListrik)
    {
        $maxValues = $this->maxValue;
        $low = $this->evalMembership($biayaListrik, 600000, 800000, 1200000, $maxValues);
        $medium = $this->evalMembership($biayaListrik, 150000, 250000, 450000, 600000);
        $high = $this->evalMembership($biayaListrik, 0, 0, 100000, 200000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyBiayaAir($biayaAir)
    {
        $maxValues = $this->maxValue;
        $low = $this->evalMembership($biayaAir, 200000, 250000, 300000, $maxValues);
        $medium = $this->evalMembership($biayaAir, 40000, 60000, 150000, 200000);
        $high = $this->evalMembership($biayaAir, 0, 0, 20000, 50000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyPajakKendaraan($PajakKendaraan)
    {
        $maxValues = $this->maxValue;
        $low = $this->evalMembership($PajakKendaraan, 1500000, 2000000, 3000000, $maxValues);
        $medium = $this->evalMembership($PajakKendaraan, 400000, 600000, 1000000, 1500000);
        $high = $this->evalMembership($PajakKendaraan, 0, 0, 200000, 500000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyJumlahTanggungan($jumlahTanggungan)
    {
        $maxValues = $this->maxValue - 999999950;
        $low = $this->evalMembership($jumlahTanggungan, 0, 1, 2, 3);
        $medium = $this->evalMembership($jumlahTanggungan, 2, 3, 4, 5);
        $high = $this->evalMembership($jumlahTanggungan, 4, 5, 6, $maxValues);

        // dd($maxValues);
        // dd($low, $medium, $high);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];

    }

    private function evaluateRules($gaji, $pajakBumi, $biayaListrik, $biayaAir, $PajakKendaraan, $jumlahTanggungan)
    {
        $lowPriority = ($gaji['low'] + $pajakBumi['low'] + $biayaListrik['low'] + $biayaAir['low'] + $PajakKendaraan['low'] + $jumlahTanggungan['low']) / 6;
        $mediumPriority = ($gaji['medium'] + $pajakBumi['medium'] + $biayaListrik['medium'] + $biayaAir['medium'] + $PajakKendaraan['medium'] + $jumlahTanggungan['medium']) / 6;
        $highPriority = ($gaji['high'] + $pajakBumi['high'] + $biayaListrik['high'] + $biayaAir['high'] + $PajakKendaraan['high'] + $jumlahTanggungan['high']) / 6;
        
        // dd($gaji, $pajakBumi, $biayaListrik, $biayaAir, $PajakKendaraan, $jumlahTanggungan);

        // $lowPriority = min($gaji['low'], $pajakBumi['low'], $biayaListrik['low'], $biayaAir['low'], $PajakKendaraan['low'], $jumlahTanggungan['low']);
        // $mediumPriority = min($gaji['medium'], $pajakBumi['medium'], $biayaListrik['medium'], $biayaAir['medium'], $PajakKendaraan['medium'], $jumlahTanggungan['medium']);
        // $highPriority = min($gaji['high'], $pajakBumi['high'], $biayaListrik['high'], $biayaAir['high'], $PajakKendaraan['high'], $jumlahTanggungan['high']);
    
        // dd($lowPriority, $mediumPriority, $highPriority);
        
        return [
            'low' => $lowPriority,
            'medium' => $mediumPriority,
            'high' => $highPriority
        ];
    }    
    
    private function defuzzify($scores)
    {
        // Gunakan metode Centroid untuk defuzzifikasi
        $numerator = ($scores['low'] * 1) + ($scores['medium'] * 2) + ($scores['high'] * 3);
        $denominator = $scores['low'] + $scores['medium'] + $scores['high'];

        
        return $denominator == 0 ? 0 : $numerator / $denominator;
    }
}
