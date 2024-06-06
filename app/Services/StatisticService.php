<?php

namespace App\Services;


use App\Contracts\StatisticContract;
use Illuminate\Support\Facades\DB;

class StatisticService implements StatisticContract
{

    public function countJobData()
    {
        $pns = DB::table('penduduk')
            ->where('status_penduduk', 1)
            ->where('pekerjaan', '=', 'PNS')
            ->count();
        $tni_polri = DB::table(('penduduk'))
            ->where('status_penduduk', 1)
            ->where('pekerjaan', '=', 'TNI/POLRI')
            ->count();
        $wirausaha = DB::table(('penduduk'))
            ->where('status_penduduk', 1)
            ->where('pekerjaan', '=', 'Wirausaha')
            ->count();
        $wiraswasta = DB::table(('penduduk'))
            ->where('status_penduduk', 1)
            ->where('pekerjaan', '=', 'Wiraswasta')
            ->count();
        $pm = DB::table(('penduduk'))
            ->where('status_penduduk', 1)
            ->where('pekerjaan', '=', 'Pelajar/Mahasiswa')
            ->count();
        $tb = DB::table(('penduduk'))
            ->where('status_penduduk', 1)
            ->where('pekerjaan', '=', 'Tidak Bekerja')
            ->count();
        return [
            'pns' => $pns,
            'tni_polri' => $tni_polri,
            'wirausaha' => $wirausaha,
            'wiraswasta' => $wiraswasta,
            'pm' => $pm,
            'tb' => $tb
        ];
    }

    public function countEducationData()
    {
        $tts = DB::table('penduduk')
            ->where('status_penduduk', 1)
            ->where('pendidikan', '=', 'Tidak Tamat SD')
            ->count();
        $sd = DB::table('penduduk')
            ->where('status_penduduk', 1)
            ->where('pendidikan', '=', 'SD')
            ->count();
        $smp = DB::table('penduduk')
            ->where('status_penduduk', 1)
            ->where('pendidikan', '=', 'SMP')
            ->count();
        $sma = DB::table('penduduk')
            ->where('status_penduduk', 1)
            ->where('pendidikan', '=', 'SMA')
            ->count();
        $diploma = DB::table('penduduk')
            ->where('status_penduduk', 1)
            ->where('pendidikan', '=', 'Diploma')
            ->count();
        $sarjana = DB::table('penduduk')
            ->where('status_penduduk', 1)
            ->where('pendidikan', '=', 'Sarjana')
            ->count();

        return [
            'tts' => $tts,
            'sd' => $sd,
            'smp' => $smp,
            'sma' => $sma,
            'diploma' => $diploma,
            'sarjana' => $sarjana
        ];
    }
}
