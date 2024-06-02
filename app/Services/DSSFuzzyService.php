<?php

namespace App\Services;

use App\Models\DSSModel;

class DSSFuzzyService
{
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
            // $jumlahTanggungan = $this->fuzzifyJumlahTanggungan($recipient->jumlah_tanggungan);
            // Rule Evaluation
            $score = $this->evaluateRules($gaji, $pajakBumi, $biayaListrik, $biayaAir, $PajakKendaraan); // , $jumlahTanggungan);

            // Defuzzification
            $crispScore = $this->defuzzify($score);

            $results[] = [
                'name' => $recipient->nomor_kk,
                'score' => $crispScore
            ];
        }

        // Sorting
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Kategori
        foreach ($results as &$result) {
            if ($result['score'] >= 1.8) {
                $result['category'] = 'Utama';
            } elseif ($result['score'] >= 1.5) {
                $result['category'] = 'Sedang';
            } else {
                $result['category'] = 'Rendah';
            }
        }

        return $results;
    }

    private function hitungRentang($x, $a, $b, $c, $d)
    {
        // Metode trapezoidal (dibagi 4 kriteria)
        if ($x <= $a || $x >= $d) {
            return 0;  
        } elseif ($x >= $b && $x <= $c) {
            return 1;
        } elseif ($x > $a && $x < $b) {
            return ($x - $a) / ($b - $a);
        } else {
            return ($d - $x) / ($d - $c);
        }
    }

    private function fuzzifyGaji($gaji)
    {
        $low = $this->hitungRentang($gaji, 3000000, 3500000, 5000000, INF);
        $medium = $this->hitungRentang($gaji, 1000000, 1500000, 2500000, 3000000);
        $high = $this->hitungRentang($gaji, 0, 0, 1000000, 1500000);
        
        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyPajakBumi($pajakBumi)
    {
        $low = $this->hitungRentang($pajakBumi, 500000, 600000, 1000000, INF);
        $medium = $this->hitungRentang($pajakBumi, 75000, 125000, 300000, 500000);
        $high = $this->hitungRentang($pajakBumi, 0, 0, 50000, 100000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyBiayaListrik($biayaListrik)
    {
        $low = $this->hitungRentang($biayaListrik, 600000, 800000, 1200000, INF);
        $medium = $this->hitungRentang($biayaListrik, 150000, 250000, 450000, 600000);
        $high = $this->hitungRentang($biayaListrik, 0, 0, 100000, 200000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyBiayaAir($biayaAir)
    {
        $low = $this->hitungRentang($biayaAir, 200000, 250000, 300000, INF);
        $medium = $this->hitungRentang($biayaAir, 40000, 60000, 150000, 200000);
        $high = $this->hitungRentang($biayaAir, 0, 0, 20000, 50000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyPajakKendaraan($PajakKendaraan)
    {
        $low = $this->hitungRentang($PajakKendaraan, 1500000, 2000000, 3000000, INF);
        $medium = $this->hitungRentang($PajakKendaraan, 400000, 600000, 1000000, 1500000);
        $high = $this->hitungRentang($PajakKendaraan, 0, 0, 200000, 500000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyJumlahTanggungan($jumlahTanggungan)
    {
        $low = $this->hitungRentang($jumlahTanggungan, 0, 0, 3, 4);
        $medium = $this->hitungRentang($jumlahTanggungan, 4, 5, 6, 7);
        $high = $this->hitungRentang($jumlahTanggungan, 1, 2, 3, INF);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function evaluateRules($gaji, $pajakBumi, $biayaListrik, $biayaAir, $PajakKendaraan) // , $jumlahTanggungan)
    {
        // Evaluasi
        $lowPriority = ($gaji['low'] + $pajakBumi['low'] + $biayaListrik['low'] + $biayaAir['low'] + $PajakKendaraan['low']) / 5;
        $mediumPriority = ($gaji['medium'] + $pajakBumi['medium'] + $biayaListrik['medium'] + $biayaAir['medium'] + $PajakKendaraan['medium']) / 5;
        $highPriority = ($gaji['high'] + $pajakBumi['high'] + $biayaListrik['high'] + $biayaAir['high'] + $PajakKendaraan['high']) / 5;
    
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