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
            
                // Jika tidak ada bulan yang 'Belum Lunas', tambahkan baris sebanyak $monthsPaid dengan bulan-bulan setelah bulan terakhir dengan status 'Lunas'
                if ($monthsDue->isEmpty()) {
                    $lastPaidMonth = $table::where('nomor_kk', $no_kk)->where('status', 'Lunas')->orderBy('bulan', 'desc')->first();
                    $lastPaidMonth = $lastPaidMonth ? Carbon::parse($lastPaidMonth->bulan) : Carbon::now();
            
                    for ($i = 0; $i < $monthsPaid; $i++) {
                        $newMonth = $table::create([
                            'nomor_kk' => $no_kk,
                            'bulan' => $lastPaidMonth->addMonth(),
                            'status' => 'Lunas'
                        ]);
                        $newMonth->id_pembayaran = $payment->id_pembayaran;
                        $newMonth->save();
                    }
                } else {
                    foreach ($monthsDue as $index => $currentMonth) {
                        if ($index < $monthsPaid) {
                            // Update bulan yang belum lunas
                            $currentMonth->id_pembayaran = $payment->id_pembayaran;
                            $currentMonth->status = 'Lunas';
                            $currentMonth->save();
                        } else {
                            break; // Tidak perlu membuat baris baru jika bulan yang dibayar sudah cukup
                        }
                    }
                
                    // Jika masih ada sisa bulan yang perlu dibayar, buat bulan baru
                    $remainingMonthsToPay = $monthsPaid - $monthsDue->count();
                    if ($remainingMonthsToPay > 0) {
                        $lastPaidMonth = $monthsDue->isEmpty() ? Carbon::now() : Carbon::parse($monthsDue->last()->bulan);
                        for ($i = 0; $i < $remainingMonthsToPay; $i++) {
                            $newMonth = $table::create([
                                'nomor_kk' => $no_kk,
                                'bulan' => $lastPaidMonth->addMonth(),
                                'status' => 'Lunas'
                            ]);
                            $newMonth->id_pembayaran = $payment->id_pembayaran;
                            $newMonth->save();
                        }
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
