<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;;

class BeritaController extends Controller
{
    public function index()
    {
        $page = 'manajemen-berita';
        return view('admin.pages.berita', ['pages' => 'Berita', 'page' => $page]);
    }
}
