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
        $datas = $this->datas;
        return view('banusosu2', compact('datas'));
    }

    public function exportPdf()
    {
        $datas = $this->datas;
        $downloadFile = FacadePdf::loadView('banusosu2', $datas);
        return $downloadFile->download('hasil_data.pdf');
 
    }
}
