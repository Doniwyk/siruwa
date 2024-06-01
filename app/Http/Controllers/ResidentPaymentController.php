<?php

namespace App\Http\Controllers;

use App\Contracts\ResidentPaymentContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;

class ResidentPaymentController extends Controller
{
  protected ResidentPaymentContract $paymentContract;

  public function __construct(ResidentPaymentContract $paymentContract)
  {
    $this->paymentContract = $paymentContract;
  }

  public function index()
  {
    $fundData = $this->paymentContract->getFundData();
    $history = $this->paymentContract->getHistory();
    $title = 'Iuran RW 2';
    return view('resident._fund.index', compact('fundData', 'title', 'history'));
  }

  public function getAddPaymentForm()
  {
    return view('resident._fund.add');
  }


  public function storePayment(StorePaymentRequest $request) 
  {
    $validatedData = $request->validated(); 

    try {
        $this->paymentContract->storePayment($validatedData);
        return redirect()->route('resident.data-pembayaran.index')->with('success', 'Pembayaran berhasil disimpan!');
    } catch (\Exception $e) {
        return redirect()->route('resident.data-pembayaran.index')->with('error', 'Terjadi kesalahan saat menyimpan pembayaran.');
    }
  }

  public function getFundByYear($year)
  {
    $fundData = $this->paymentContract->getFundDataByYear($year);
    return view('resident._fund.index', compact('fundData'));
  }
}
