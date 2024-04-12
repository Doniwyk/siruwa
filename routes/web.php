<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DataDasawismaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\UserController;
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
    return view('landingpage');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [StatistikController::class, 'index'])->name('statistik');
    Route::get('/data-dasawisma', [DataDasawismaController::class, 'index'])->name('data-dasawisma');
    Route::get('/manajemen-dokumen', [DokumenController::class,'index'])->name('manajemen-dokumen');
    Route::get('/manajemen-dana', [DanaController::class,'index'])->name('manajemen-dana');
    Route::get('/manajemen-berita', [BeritaController::class,'index'])->name('manajemen-berita');
    Route::get('/edit-profil', [ProfilController::class,'index'])->name('edit-profil');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/users/store', [UserController::class, 'storeUser'])->name('user.store');
    Route::get('/users/{user}/edit', [UserController::class, 'editUser'])->name('user.edit');
    Route::put('/users/{user}/update', [UserController::class, 'updateUser'])->name('user.update');
    Route::delete('/users/{user}/delete', [UserController::class, 'deleteUser'])->name('user.delete');
});
