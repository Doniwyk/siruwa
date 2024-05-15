<?php

namespace App\Http\Controllers;

use App\Contracts\AdminPaymentContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatePaymentRequest;
use App\Models\PaymentModel;

class AdminPaymentController extends Controller
{
    protected AdminPaymentContract $paymentService;

    public function __construct(AdminPaymentContract $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function index(){
        $fundData = $this->paymentService->getFundData();
        return view('admin._pembayaran.index', compact('fundData'));
    }
    public function validatePayment(ValidatePaymentRequest $request, string $action, PaymentModel $payment){
        try {
            $validatedData = $request->validated();
            $this->paymentService->validatePayment($validatedData, $action, $payment);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin._pembayaran.index')->with('Terjadi kesalahan tak terduga saat memvalidasi pembayaran.');
        }
        return redirect()->route('admin._pembayaran.index');
    }
    public function validatedPayment(){
        $validatedPayment = $this->paymentService->getValidatedPayment();
        return view('admin.payment.history', compact('validatedPayment'));
    }
}
