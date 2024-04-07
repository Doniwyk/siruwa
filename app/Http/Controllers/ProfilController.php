<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $page = 'edit-profil';
        return view('admin.pages.profil', ['pages' => 'profil','page' => $page]);
    }
}
