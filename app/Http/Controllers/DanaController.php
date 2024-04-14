<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DanaController extends Controller
{
    public function index(){
        $page = 'manajemen-dana';
        return view('admin._fund.index', ['pages' => 'dana','page' => $page]);
    }
}
