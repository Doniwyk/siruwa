<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Termwind\render;

class DataDasawismaController extends Controller
{
    public function index(){
        $page = 'data-dasawisma';
        return view('admin.pages.dataDasawisma', ['pages' => 'dataDasawisma','page' => $page]);
    }
}
