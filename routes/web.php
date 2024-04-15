<?php

use App\Http\Controllers\AccountController;
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
    Route::get('/manajemen-dokumen', [DokumenController::class, 'index'])->name('manajemen-dokumen');
    Route::get('/manajemen-dana', [DanaController::class, 'index'])->name('manajemen-dana');
    Route::get('/manajemen-berita', [BeritaController::class, 'index'])->name('manajemen-berita');
    Route::get('/edit-profil', [ProfilController::class, 'index'])->name('edit-profil');
});

Route::prefix('admin/users')->group(function () {
    Route::get('', [UserController::class, 'index'])->name('user.index');
    Route::get('/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/store', [UserController::class, 'storeUser'])->name('user.store');
    Route::get('/{id}/edit', [UserController::class, 'editUser'])->name('user.edit');
    Route::put('/{id}', [UserController::class, 'updateUser'])->name('user.update');
    Route::delete('/{id}/delete', [UserController::class, 'deleteUser'])->name('user.delete');
});

Route::prefix('admin/account')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('account.index');
    Route::get('/accounts/add', [AccountController::class, 'add'])->name('account.add');
    Route::post('/accounts/store', [AccountController::class, 'storeAccount'])->name('account.store');
    Route::get('/accounts/{account}/edit', [AccountController::class, 'editAccount'])->name('account.edit');
    Route::put('/accounts/{account}', [AccountController::class, 'updateAccount'])->name('account.update');
    Route::delete('/accounts/{account}/delete', [AccountController::class, 'deleteAccount'])->name('account.delete');
});
