<?php

namespace App\Services;

use App\Contracts\AdminPaymentContract;
use App\Models\DeathFundModel;
use App\Models\GarbageFundModel;
use App\Models\PaymentModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPaymentService implements AdminPaymentContract
{
    private static int $MONTHLY_PAYMENT = 10_000;

    public function validatePayment(array $validatedData, string $action, PaymentModel $payment)
    {
        if ($action != 'terima') {
            $payment->status = 'Ditolak';
            $payment->save();
            return;
        }

        $totalPayment = $validatedData['jumlah'];
        //Nominal yang dibayarkan
        $monthsPaid = (int) ($totalPayment / self::$MONTHLY_PAYMENT);

        $table = $payment->jenis === 'Iuran Kematian' ? DeathFundModel::class : GarbageFundModel::class;
        $no_kk = $payment->nomor_kk;

        //Mencaari bulan yang belum lunas
        $monthsDue = $table::where('nomor_kk', $no_kk)
            ->where('status', 'Belum Lunas')
            ->orderBy('bulan', 'asc')
            ->limit($monthsPaid)
            ->get();

        DB::beginTransaction();
        try {
            $payment->status = 'Terverifikasi';
            $payment->id_admin = Auth::user()->id;
            $payment->save();

            //Menghitung jumlah bulan yang belum lunas
            $monthsDueCount = $monthsDue->count();

            //Mengubah status lunas sejumlah dengan monts due count
            foreach ($monthsDue as $index => $currentMonth) {
                $currentMonth->id_pembayaran = $payment->id_pembayaran;
                $currentMonth->status = 'Lunas';
                $currentMonth->save();
            }

            
            if ($monthsPaid > $monthsDueCount) {
                $lastPaidMonth = $table::where('nomor_kk', $no_kk)
                    ->where('status', 'Lunas')
                    ->orderBy('bulan', 'desc')
                    ->first();

                $lastPaidMonth = $lastPaidMonth ? Carbon::parse($lastPaidMonth->bulan) : Carbon::now();

                for ($i = 0; $i < ($monthsPaid - $monthsDueCount); $i++) {
                    $table::create([
                        'nomor_kk' => $no_kk,
                        'bulan' => $lastPaidMonth->addMonth(),
                        'status' => 'Lunas',
                        'id_pembayaran' => $payment->id_pembayaran
                    ]);
                }
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }


    public function getFundData()
    {
        $deathFundData = DeathFundModel::all()->with('penduduk');
        $garbageFundData = GarbageFundModel::all()->with('penduduk');

        return [
            'deathFundData' => $deathFundData,
            'garbageFundData' => $garbageFundData,
        ];
    }

    public function getValidatedPayment()
    {
        $validatedPayments = PaymentModel::whereIn('status', ['Terverifikasi', 'Ditolak'])
            ->with('resident', 'admin', 'akun')
            ->paginate(10, ['*'], 'validatedPage');

        return $validatedPayments;
    }

    public function getSubmission()
    {
        $getSubmission = PaymentModel::where('status', 'Belum Terverifikasi')
            ->with('resident', 'admin', 'akun')
            ->paginate(10, ['*'], 'submissionPage');

        $getDeathFundAmount = DeathFundModel::where('status', 'Lunas')->count() * 10000;
        $getGarbageFundAmount = GarbageFundModel::where('status', 'Lunas')->count() * 10000;

        $getDeathFundTunggakan = DeathFundModel::where('status', 'Belum Lunas')->count() * 10000;
        $getGarbageFundTunggakan = GarbageFundModel::where('status', 'Belum Lunas')->count() * 10000;
        $getTunggakan = $getDeathFundTunggakan + $getGarbageFundTunggakan;

        return [
            'getSubmission' => $getSubmission,
            'deathFundTotal' => $getDeathFundAmount,
            'garbageFundTotal' => $getGarbageFundAmount,
            'tunggakan' => $getTunggakan
        ];
    }

}
