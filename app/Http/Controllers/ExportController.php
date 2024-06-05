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
        try{
        $users = UserModel::all();
        $pdf = PDF::loadView('admin._dasawismaData.export', ['users' => $users]);
        return $pdf->download('data-penduduk.pdf');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Tidak dapat mengexport data penduduk' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function exportPaymentData()
    {
        try{
        $payment = DB::table('pembayaran')->get();
        $pdf = PDF::loadView('admin._fund.export', ['payment' => $payment]);
        return $pdf->download('data-pembayaran.pdf');
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Tidak dapat mengexport data penduduk' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
