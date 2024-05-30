<?php

namespace App\Services;

use App\Contracts\ResidentPaymentContract;
use App\Models\DeathFundModel;
use App\Models\GarbageFundModel;
use App\Models\PaymentModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class ResidentPaymentService implements ResidentPaymentContract
{
    public function storePayment(array $validatedData){
      $cloudinaryImage = $validatedData['urlBuktiPembayaran']->storeOnCloudinary('pembayaran');
      $response = $cloudinaryImage->getSecurePath();
      $publicId = $cloudinaryImage->getPublicId();
      $user = Auth::user();
      $penduduk = UserModel::find($user->id_penduduk);
      if ($penduduk) {
          $validatedData['nomor_kk'] = $penduduk->nomor_kk;
      } else {
          return redirect()->back()->with('error', 'Nomor KK tidak ditemukan.');
      }
      $validatedData['urlBuktiPembayaran'] = $response;
      $validatedData['image_public_id'] = $publicId;
      $validatedData['status'] = 'Belum Terverifikasi';
      PaymentModel::create($validatedData);
    }
    public function getFundData()
    {
      $user = Auth::user();
      if ($user) {
        $penduduk = UserModel::find($user->id_penduduk); // Find resident based on user's foreign key
        if ($penduduk) {
          $currentYear = date('Y');

          $deathFundData = DeathFundModel::where('nomor_kk', $penduduk->nomor_kk)
                                          ->whereYear('bulan', $currentYear)
                                          ->with('penduduk')
                                          ->get();

          $garbageFundData = GarbageFundModel::where('nomor_kk', $penduduk->nomor_kk)
                                              ->whereYear('bulan', $currentYear)
                                              ->with('penduduk')
                                              ->get();
    
          return [
            'death_fund' => $deathFundData,
            'garbage_fund' => $garbageFundData,
          ];
        } else {
          // Handle case where resident not found
          return [];
        }
      } else {
        // Handle case where user is not authenticated
        return [];
      }
    }
  
    public function getHistory()
    {
      $user = Auth::user();
      if ($user) {
        $penduduk = UserModel::find($user->id_penduduk);
        if ($penduduk) {
          $history = PaymentModel::where('nomor_kk', $penduduk->nomor_kk)->with('penduduk', 'admin')->get();
          return $history;
        } else {
          // Handle case where resident not found
          return [];
        }
      } else {
        // Handle case where user is not authenticated
        return [];
      }
    }

    public function getFundDataByYear($year)
    {
      
      $user = Auth::user();
      if ($user) {
        $penduduk = UserModel::find($user->id_penduduk); // Find resident based on user's foreign key
        if ($penduduk) {
          $deathFundData = DeathFundModel::where('nomor_kk', $penduduk->nomor_kk)
                                          ->whereYear('bulan', $year)
                                          ->with('penduduk')
                                          ->get();

          $garbageFundData = GarbageFundModel::where('nomor_kk', $penduduk->nomor_kk)
                                              ->whereYear('bulan', $year)
                                              ->with('penduduk')
                                              ->get();
    
          return [
            'death_fund' => $deathFundData,
            'garbage_fund' => $garbageFundData,
          ];
        } else {
          // Handle case where resident not found
          return [];
        }
      } else {
        // Handle case where user is not authenticated
        return [];
      }
    }
}

