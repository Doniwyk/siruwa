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
        try {
            $typeDocument = $request->query('typeDocument', 'pembayaran');
            $search = $request->query('search', '');
            $order = $request->query('order', 'asc');
            $adminId = Auth::id();

            $page = $this->pageName;

            $fundData = $this->paymentService->getSubmission($search, $order);
            $history = $this->paymentService->getValidatedPayment($search, $order);
            // $financialData = $this->paymentService->getFinancialData();
            $financialData = $this->paymentService->getFinancialData();


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
                    'typeDocument' => $typeDocument,
                    'fundData' => $fundDataJson,
                    'paginationHtml' => $paginationHtml
                ]);
            }
            return view('admin._fund.index', compact('fundData', 'history', 'page', 'typeDocument', 'search', 'order', 'adminId','financialData'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
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
    public function showBuktiPembayaran(PaymentModel $payment)
    {
        try {
            return response()->json($payment);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
    public function getDataTunggakan(Request $request)
    {

        try{
            $typeDocument = $request->query('typeDocument', 'iuran-sampah');
            $search = $request->query('search', '');
            $order = $request->query('order', 'asc');
            $adminId = Auth::id();

            $page = $this->pageName;

            $dataTunggakan = $this->paymentService->getDataTunggakan($search, $order);

            if ($request->wantsJson()) {
                return response()->json([
                    'page' => $page,
                    'typeDocument' => $typeDocument,
                    'dataTunggakan' => $dataTunggakan
                ]);
            }
            
            return view('admin._fund.tunggakan', compact('dataTunggakan', 'page', 'typeDocument', 'search', 'order', 'adminId'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function addExpense(Request $request){
        
        $typeDocument = $request->query('typeDocument', 'sampah');
        $search = $request->query('search', '');
        $order = $request->query('order', 'asc');
        $adminId = Auth::id();

        $page = $this->pageName;

        $financialData = $this->paymentService->getFinancialData();

        return  view('admin._fund.add', compact('page', 'financialData', 'typeDocument', 'search', 'order'));
    }
    public function storeExpense(Request $request)
    {

        try {
            $validated = $request->validate([
                'jumlah_pengeluaran' => 'required',
                'jenis_pengeluaran' => 'required'
            ]);

            $this->paymentService->storeExpense($validated);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public  function validatedPayment(PaymentModel $payment) {
        try {
            return response()->json($payment);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
