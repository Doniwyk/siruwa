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
            $jumlahMotor = $this->fuzzifyJumlahMotor($recipient->jumlah_kendaraan_bermotor);

            // dd(compact('gaji', 'pajakBumi', 'biayaListrik', 'biayaAir', 'jumlahMotor'));

            //Rule Evaluation
            $score = $this->evaluateRules($gaji, $pajakBumi, $biayaListrik, $biayaAir, $jumlahMotor);

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
        $low = $this->hitungRentang($gaji, 0, 0, 2000, 4000);
        $medium = $this->hitungRentang($gaji, 3000, 5000, 7000, 9000);
        $high = $this->hitungRentang($gaji, 8000, 10000, 12000, 12000);
        
        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyPajakBumi($pajakBumi)
    {
        $low = $this->hitungRentang($pajakBumi, 0, 0, 200, 400);
        $medium = $this->hitungRentang($pajakBumi, 300, 500, 700, 900);
        $high = $this->hitungRentang($pajakBumi, 800, 1000, 1200, 1200);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }

    private function fuzzifyBiayaListrik($biayaListrik)
    {
        $low = $this->hitungRentang($biayaListrik, 0, 0, 100, 200);
        $medium = $this->hitungRentang($biayaListrik, 150, 250, 350, 450);
        $high = $this->hitungRentang($biayaListrik, 400, 500, 600, 600);

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

    private function fuzzifyJumlahMotor($jumlahMotor)
    {
        $low = $this->hitungRentang($jumlahMotor, 0, 0, 1, 2);
        $medium = $this->hitungRentang($jumlahMotor, 1, 2, 3, 4);
        $high = $this->hitungRentang($jumlahMotor, 3, 4, 5, 5);

        return [
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
        ];
    }
    
    private function evaluateRules($gaji, $pajakBumi, $biayaListrik, $biayaAir, $jumlahMotor)
    {
        // Evaluasi menggunakan min (tapi error jir embo)
        // $lowPriority = min($gaji['low'] + $pajakBumi['low'] + $biayaListrik['low'] + $biayaAir['low'] + $jumlahMotor['low']);
        // $mediumPriority = min($gaji['medium'] + $pajakBumi['medium'] + $biayaListrik['medium'] + $biayaAir['medium'] + $jumlahMotor['medium']);
        // $highPriority = min($gaji['high'] + $pajakBumi['high'] + $biayaListrik['high'] + $biayaAir['high'] + $jumlahMotor['high']);

        // Evaluasi
        $lowPriority = ($gaji['low'] + $pajakBumi['low'] + $biayaListrik['low'] + $biayaAir['low'] + $jumlahMotor['low']) / 5;
        $mediumPriority = ($gaji['medium'] + $pajakBumi['medium'] + $biayaListrik['medium'] + $biayaAir['medium'] + $jumlahMotor['medium']) / 5;
        $highPriority = ($gaji['high'] + $pajakBumi['high'] + $biayaListrik['high'] + $biayaAir['high'] + $jumlahMotor['high']) / 5;
    
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
