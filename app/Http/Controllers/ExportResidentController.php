<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportResidentController extends Controller
{
    public function index()
    {
        $users = UserModel::all();
        // dd($users);

        $pdf = PDF::loadView('admin._dasawismaData.export', ['users' => $users]);
        return $pdf->download('data-penduduk.pdf');
    }
}
