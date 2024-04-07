<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DanaController extends Controller
{
    public function index(){
        $page = 'manajemen-dana';
        return view('admin.pages.dana', ['pages' => 'dana','page' => $page]);
    }
}
