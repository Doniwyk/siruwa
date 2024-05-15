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
    return view('penduduk._pembayaran.index', compact('fundData'));
  }

  public function getAddPaymentForm()
  {
    return view('penduduk._pembayaran.add');
  }


  public function storePayment(StorePaymentRequest $request) // Use validated request
  {
    $validatedData = $request->validated(); // Access validated data directly

    $this->paymentContract->storePayment($validatedData);

    return redirect()->route('penduduk._pembayaran.index')->with('success', 'Pembayaran berhasil disimpan!');
  }

  public function getHistory()
  {
    $history = $this->paymentContract->getHistory();
    return view('penduduk._pembayaran.history', compact('history'));
  }
  public function getFundByYear($year)
  {
    $fundData = $this->paymentContract->getFundDataByYear($year);
    return view('penduduk._pembayaran.index', compact('fundData'));
  }
}
