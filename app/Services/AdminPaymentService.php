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
        if ($action !== 'terima') {
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
        $no_kk = $payment->no_kk;

        // Temukan bulan terlama yang statusnya 'Belum Lunas' untuk nomor kartu keluarga yang ingin divalidasi
        $monthsDue = $table::where('no_kk', $no_kk)
            ->where('status', 'Belum Lunas')
            ->orderBy('bulan', 'asc');

        DB::beginTransaction();
        try {
            // Update status pembayaran
            $payment->status = 'Terverifikasi';
            $payment->id_admin = Auth::user()->id; // Ambil id_admin dari penduduk yang sedang login
            $payment->save();

            for ($i = 0; $i < $monthsPaid; $i++) {
                $currentMonth = $monthsDue[$i];
                // the month hasn't been created yet
                if ($i > $monthsDue->count()) {
                    $table::create([
                        'no_kk' => $no_kk,
                        'bulan' => Carbon::parse($monthsDue[$i - 1]->bulan)->addMonth(),
                        'status' => 'Lunas'
                    ]);
                }
                $currentMonth->id_pembayaran = $payment->id_pembayaran;
                $currentMonth->status = 'Lunas';
                $currentMonth->save();
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
        $validatedPayments = PaymentModel::where('status', 'Terverifikasi')->with('penduduk', 'admin')->get();

        return $validatedPayments;
    }

    public function getSubmission()
    {
        $getSubmission = PaymentModel::where('status', 'Belum Terverifikasi')->with('penduduk', 'admin')->get();
        $getDeathFundAmount = DeathFundModel::where('status', 'Lunas')
        ->count() * 10000;
        $getGarbageFundAmount = GarbageFundModel::where('status', 'Lunas')
        ->count() * 10000;
        
        return ['getSubmission' => $getSubmission, 
                'deathFundTotal' => $getDeathFundAmount, 
                'garbageFundTotal' => $getGarbageFundAmount];
    }
}
