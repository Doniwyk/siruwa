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
            $payment->save;
            return;
        }

        // Validasi data yang diterima dari form validasi
        $totalPayment = $validatedData['jumlah'];
        $monthsPaid = (int) ($totalPayment / self::$MONTHLY_PAYMENT);

        // Tentukan model dan tabel yang sesuai berdasarkan jenis pembayaran
        $table = $payment->jenis === 'Iuran Kematian' ? DeathFundModel::class : GarbageFundModel::class;

        // Ambil nomor kartu keluarga dari data yang ingin divalidasi
        $no_kk = $payment->nomor_kk;

        // Temukan bulan terlama yang statusnya 'Belum Lunas' untuk nomor kartu keluarga yang ingin divalidasi
        $monthsDue = $table::where('nomor_kk', $no_kk)
            ->where('status', 'Belum Lunas')
            ->orderBy('bulan', 'asc')->get();

        DB::beginTransaction();
        try {
            // Update status pembayaran
            $payment->status = 'Terverifikasi';
            $payment->id_admin = Auth::user()->id; // Ambil id_admin dari penduduk yang sedang login
            $payment->save();

            foreach ($monthsDue as $index => $currentMonth) {
                // the month hasn't been created yet
                if ($index >= $monthsPaid) {
                    $newMonth = $table::create([
                        'nomor_kk' => $no_kk,
                        'bulan' => $index == 0 ? Carbon::parse($currentMonth->bulan)->addMonth() : Carbon::parse($monthsDue[$index - 1]->bulan)->addMonth(),
                        'status' => 'Lunas'
                    ]);
            
                    $newMonth->id_pembayaran = $payment->id_pembayaran;
                    $newMonth->status = 'Lunas';
                    $newMonth->save();
                } else {
                    $currentMonth->id_pembayaran = $payment->id_pembayaran;
                    $currentMonth->status = 'Lunas';
                    $currentMonth->save();
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
        $validatedPayments = PaymentModel::where('status', ['Terverifikasi', 'Ditolak'])->with('penduduk', 'admin')->paginate(10);

        return $validatedPayments;
    }

    public function getSubmission()
    {
        $getSubmission = PaymentModel::where('status', 'Belum Terverifikasi')->with('penduduk', 'admin')->paginate(10);

        $getDeathFundAmount = DeathFundModel::where('status', 'Lunas')
        ->count() * 10000;
        $getGarbageFundAmount = GarbageFundModel::where('status', 'Lunas')
        ->count() * 10000;

        $getDeathFundTunggakan = DeathFundModel::where('status', 'Belum Lunas')
        ->count() * 10000;
        $getGarbageFundTunggakan = GarbageFundModel::where('status', 'Belum Lunas')
        ->count() * 10000;
        $getTunggakan = $getDeathFundTunggakan+$getGarbageFundTunggakan;
        
        return ['getSubmission' => $getSubmission, 
                'deathFundTotal' => $getDeathFundAmount, 
                'garbageFundTotal' => $getGarbageFundAmount,
                'tunggakan' => $getTunggakan];
    }
}
