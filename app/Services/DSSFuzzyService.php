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
            $gaji = $this->fuzzifyGaji($recipient->gaji);
            $pajakBumi = $this->fuzzifyPajakBumi($recipient->pajak_bumi);
            $biayaListrik = $this->fuzzifyBiayaListrik($recipient->biaya_listrik);
            $biayaAir = $this->fuzzifyBiayaAir($recipient->biaya_air);
            $PajakKendaraan = $this->fuzzifyPajakKendaraan($recipient->jumlah_kendaraan_bermotor);

            // dd(compact('gaji', 'pajakBumi', 'biayaListrik', 'biayaAir', 'PajakKendaraan'));

            //Rule Evaluation
            $score = $this->evaluateRules($gaji, $pajakBumi, $biayaListrik, $biayaAir, $PajakKendaraan);

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
        //Metode trapezoidal (dibagi 4 kriteria)
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
        $low = $this->hitungRentang($gaji, 0, 0, 500000, 1000000);
        $medium = $this->hitungRentang($gaji, 800000, 0, 0, 3500000);
        $high = $this->hitungRentang($gaji, 300000, 0, 0, 7000000);
        
        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyPajakBumi($pajakBumi)
    {
        $low = $this->hitungRentang($pajakBumi, 0, 0, 0, 1000000);
        $medium = $this->hitungRentang($pajakBumi, 70000, 500, 700, 500000);
        $high = $this->hitungRentang($pajakBumi, 0, 0, 300000, 95000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyBiayaListrik($biayaListrik)
    {
        $low = $this->hitungRentang($biayaListrik, 0, 0, 100, 900);
        $medium = $this->hitungRentang($biayaListrik, 150, 250, 350, 1300);
        $high = $this->hitungRentang($biayaListrik, 400, 500, 600, 3500);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyBiayaAir($biayaAir)
    {
        $low = $this->hitungRentang($biayaAir, 0, 0, 50, 100);
        $medium = $this->hitungRentang($biayaAir, 80, 150, 200, 250);
        $high = $this->hitungRentang($biayaAir, 200, 300, 400, 400);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyPajakKendaraan($PajakKendaraan)
    {
        $low = $this->hitungRentang($PajakKendaraan, 0, 0, 1, 1500000);
        $medium = $this->hitungRentang($PajakKendaraan, 1, 2, 3, 5000000);
        $high = $this->hitungRentang($PajakKendaraan, 5000000, 4, 5, 20000000);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }
    
    private function evaluateRules($gaji, $pajakBumi, $biayaListrik, $biayaAir, $PajakKendaraan)
    {
        // Evaluasi menggunakan min (tapi error jir embo)
        // $lowPriority = min($gaji['low'] + $pajakBumi['low'] + $biayaListrik['low'] + $biayaAir['low'] + $PajakKendaraan['low']);
        // $mediumPriority = min($gaji['medium'] + $pajakBumi['medium'] + $biayaListrik['medium'] + $biayaAir['medium'] + $PajakKendaraan['medium']);
        // $highPriority = min($gaji['high'] + $pajakBumi['high'] + $biayaListrik['high'] + $biayaAir['high'] + $PajakKendaraan['high']);

        // Evaluasi
        $lowPriority = ($gaji['low'] + $pajakBumi['low'] + $biayaListrik['low'] + $biayaAir['low'] + $PajakKendaraan['low']) / 5;
        $mediumPriority = ($gaji['medium'] + $pajakBumi['medium'] + $biayaListrik['medium'] + $biayaAir['medium'] + $PajakKendaraan['medium']) / 5;
        $highPriority = ($gaji['high'] + $pajakBumi['high'] + $biayaListrik['high'] + $biayaAir['high'] + $PajakKendaraan['high']) / 5;
    
        // Gabungkan nilai fuzzy menjadi array dengan kunci yang sesuai untuk defuzzifikasi
        return [
            'low' => $lowPriority,
            'medium' => $mediumPriority,
            'high' => $highPriority
        ];
    }
    
    private function defuzzify($scores)
    {

        // $numerator = (min($scores['low'] * 1) + ($scores['medium'] * 2) + ($scores['high'] * 3))/(max($scores['low'] + $scores['medium'] + $scores['high']));
        // $denominator = $numerator / (max($scores['low'] + $scores['medium'] + $scores['high']));

        // Gunakan metode Centroid untuk defuzzifikasi
        $numerator = ($scores['low'] * 1) + ($scores['medium'] * 2) + ($scores['high'] * 3);
        $denominator = $scores['low'] + $scores['medium'] + $scores['high'];
    
        return $denominator == 0 ? 0 : $numerator / $denominator;
    }
}
