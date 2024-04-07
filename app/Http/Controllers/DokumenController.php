<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index(){
        $page = 'manajemen-dokumen';
        return view('admin.pages.dokumen', ['pages' => 'dokumen','page' => $page]);
    }
}
