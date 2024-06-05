<?php

namespace App\Http\Controllers;

use App\Services\DSSFuzzyService;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class DSSFuzzyController extends Controller
{
    protected $dssfuzzy;
    private $datas;


    public function __construct(DSSFuzzyService $dssfuzzy)
    {
        $this->dssfuzzy = $dssfuzzy;
        $this->datas = $this->dssfuzzy->calculateScores();
    }

    public function index()
    {
        try{
        $datas = $this->datas;
        return view('banusosu2', compact('datas'));
    } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function exportPdf()
    {
        try{
        $datas = $this->datas;
        $downloadFile = FacadePdf::loadView('banusosu2', $datas);
        return $downloadFile->download('hasil_data.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak dapat export dokumen' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
