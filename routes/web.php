<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DataDasawismaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\StatistikController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});

// Route::prefix('admin')->group(function () {
//     Route::get('/', [StatistikController::class, 'index'])->name('statistik');
//     Route::get('/data-dasawisma', [DataDasawismaController::class, 'index'])->name('data-dasawisma');
//     Route::get('/manajemen-dokumen', [DokumenController::class,'index'])->name('manajemen-dokumen');
//     Route::get('/manajemen-dana', [DanaController::class,'index'])->name('manajemen-dana');
//     Route::get('/manajemen-berita', [BeritaController::class,'index'])->name('manajemen-berita');
//     Route::get('/edit-profil', [ProfilController::class,'index'])->name('edit-profil');
// });

// INI ROUTE CUMA BUAT NYOBA VIEW USER, BIAR DIKERAIN BACKEND MWEHEHEHEH
Route::get('/profil', function(){
    return view('/user/_profile/index');
});
Route::get('/dokumen', function(){
    return view('/user/_residentData/index');
});
Route::get('/request', function(){
    return view('/user/_requestDocument/index');
});
Route::get('/iuran', function(){
    return view('/user/_fund/index');
});
Route::get('/topbar', function(){
    return view('/components/shared/user-topbar');
});
