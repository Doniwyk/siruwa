<?php

namespace App\Http\Controllers;

use App\Models\PaymentModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function exportResidentData()
    {
        $users = UserModel::all();
        $pdf = PDF::loadView('admin._dasawismaData.export', ['users' => $users]);
        return $pdf->download('data-penduduk.pdf');
    }

    public function exportPaymentData()
    {
        $payment = DB::table('pembayaran')->get();
        $pdf = PDF::loadView('admin._fund.export', ['payment' => $payment]);
        return $pdf->download('data-pembayaran.pdf');
    }
}
