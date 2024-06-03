<?php

namespace App\Http\Controllers;

use App\Contracts\AdminPaymentContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatePaymentRequest;
use App\Models\PaymentModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    protected AdminPaymentContract $paymentService;
    private $pageName;

    public function __construct(AdminPaymentContract $paymentService)
    {
        $this->paymentService = $paymentService;
        $this->pageName = 'data-pembayaran';
    }
    public function index(Request $request)
    {
        $typeDocument = $request->query('typeDocument', 'pembayaran');
        $search = $request->query('search', '');
        $order = $request->query('order', 'asc');
        $adminId = Auth::id();

        $title = "Manajemen Dana";
        $page = $this->pageName;

        $fundData = $this->paymentService->getSubmission($search, $order);
        $history = $this->paymentService->getValidatedPayment($search, $order);

        switch ($typeDocument) {
            case 'pembayaran':
                $fundDataJson = $fundData['getSubmission']->items();
                break;
            case 'riwayatPembayaran':
                $fundDataJson = $history->items();
                break;
        }

        $paginationHtml = $fundData['getSubmission']->appends([
            'typeDocument' => $typeDocument,
            'search' => $search,
            'order' => $order
        ])->links()->toHtml();

        // menangani jika request JSON
        if ($request->wantsJson()) {
            return response()->json([
                'page' => $page,
                'title' => $title,
                'typeDocument' => $typeDocument,
                'fundData' => $fundDataJson,
                'paginationHtml' => $paginationHtml
            ]);
        }

        return view('admin._fund.index', compact('fundData', 'history', 'title', 'page', 'typeDocument', 'search', 'order', 'adminId'));
    }
    public function validatePayment(ValidatePaymentRequest $request, PaymentModel $payment)
    {
        $action = $request->action;
        try {
            $validatedData = $request->validated();
            $this->paymentService->validatePayment($validatedData, $action, $payment);
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('admin.data-pembayaran.index')->with('Terjadi kesalahan tak terduga saat memvalidasi pembayaran.');
        }
        return redirect()->route('admin.data-pembayaran.index');
    }
    // public function validatedPayment()
    // { //riwayat
    //     $validatedPayment = $this->paymentService->getValidatedPayment();
    //     return $validatedPayment;
    // }
    public function showBuktiPembayaran(PaymentModel $payment)
    {
        return response()->json($payment);
    }
}
