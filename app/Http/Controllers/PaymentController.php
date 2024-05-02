<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentContract;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    protected PaymentContract $paymentContract;

    public function __construct(PaymentContract $paymentContract)
    {
        $this->paymentContract = $paymentContract;
    }

    public function index()
    {
        $payment = PaymentModel::all();
        $page = 'manajemen-dana';
        return view('admin._payment.index', ['pages' => 'Manajemen Dana', 'page' => $page]);
        // return view('payment.index',compact('payment'));
        //jangan lupa menyesuaikan nama view
    }

    public function add()
    {
        return view('payment.add');
        //jangan lupa menyesuaikan nama view
    }

    public function storePayment(PaymentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->paymentContract->storePayment($validated);

        return redirect()->route('payment.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function editPayment(PaymentModel $payment): View
    {
        return view('payment.edit', compact('payment'));
    }

    public function updatePayment(NewsRequest $request, PaymentModel $payment): RedirectResponse
    {
        $validated = $request->validated();
        $this->paymentContract->updatePayment($validated, $payment);

        return redirect()->route('payment.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function deletePayment(PaymentModel $payment): RedirectResponse
    {
        $this->paymentContract->deletePayment($payment);

        return redirect()->route('payment.index')->with('success', 'Berita berhasil di hapus.');
    }
}
