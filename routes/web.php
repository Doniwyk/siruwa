<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DataDasawismaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\StatisticController;
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

// Route::get('/', function () {
//     return view('landingpage');
// });

Route::group(['middleware' => 'isGuest'], function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'doLogin']);
});

Route::get('/logout', [AuthenticationController::class, 'doLogout'])->middleware('isAuth')->name('logout');


// Route::prefix('admin')->group(function () {
//     Route::get('/', [StatistikController::class, 'index'])->name('statistik');
//     Route::get('/data-dasawisma', [DataDasawismaController::class, 'index'])->name('data-dasawisma');
//     Route::get('/manajemen-dokumen', [DokumenController::class, 'index'])->name('manajemen-dokumen');
//     Route::get('/manajemen-dana', [DanaController::class, 'index'])->name('manajemen-dana');
//     Route::get('/manajemen-berita', [BeritaController::class, 'index'])->name('manajemen-berita');
//     Route::get('/edit-profil', [ProfilController::class, 'index'])->name('edit-profil');
// });


//==================================ROUTE ADMIN========================================

//ROUTE STATISTIK
Route::prefix('admin')->group(['middleware' => 'isAuth'], function () {
    Route::get('/', [StatisticController::class, 'index'])->name('statistik');
});


//ROUTE DATA PENDUDUK
Route::prefix('admin/data-dasawisma')->group(['middleware' => 'isAuth'], function () {
    Route::get('/', [UserController::class, 'index'])->name('data-dasawisma');
    Route::get('/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/store', [UserController::class, 'storeUser'])->name('user.store');
    Route::get('/{user}/edit', [UserController::class, 'editUser'])->name('user.edit');
    Route::put('/{user}', [UserController::class, 'updateUser'])->name('user.update');
    Route::delete('/{user}/delete', [UserController::class, 'deleteUser'])->name('user.delete');
});


//ROUTE MANAJEMEN DOKUMEN
Route::prefix('admin/manajemen-dokumen')->group(['middleware' => 'isAuth'], function () {
    Route::get('/', [DocumentController::class, 'index'])->name('manajemen-dokumen');
    Route::get('/add', [DocumentController::class, 'add'])->name('document.add');
    Route::post('/store', [DocumentController::class, 'storeUser'])->name('document.store');
    Route::get('/{document}/edit', [DocumentController::class, 'editUser'])->name('document.edit');
    Route::put('/{document}', [DocumentController::class, 'updateUser'])->name('document.update');
    Route::delete('/{document}/delete', [DocumentController::class, 'deleteUser'])->name('document.delete');
});

//ROUTE MANAJEMEN DANA

Route::prefix('admin/manajemen-dana')->group(['middleware' => 'isAuth'], function () {
    Route::get('/', [PaymentController::class, 'index'])->name('manajemen-dana');
    Route::get('/add', [PaymentController::class, 'add'])->name('payment.add');
    Route::post('/store', [PaymentController::class, 'storeAccount'])->name('payment.store');
    Route::get('/{payment}/edit', [PaymentController::class, 'editAccount'])->name('payment.edit');
    Route::put('/{payment}', [PaymentController::class, 'updateAccount'])->name('payment.update');
    Route::delete('/{payment}/delete', [PaymentController::class, 'deleteAccount'])->name('payment.delete');
});

//ROUTE MANAJEMEN BERITA

Route::prefix('admin/manajemen-berita')->group(['middleware' => 'isAuth'], function () {
    Route::get('/', [EventController::class, 'index'])->name('manajemen-berita');
    Route::get('/add', [EventController::class, 'add'])->name('event.add');
    Route::post('/store', [EventController::class, 'storeEvent'])->name('event.store');
    Route::get('/{event}/edit', [EventController::class, 'editEvent'])->name('event.edit');
    Route::put('/{event}', [EventController::class, 'updateEvent'])->name('event.update');
    Route::delete('/{event}/delete', [EventController::class, 'deleteEvent'])->name('event.delete');
});



//ROUTE AKUN PENDUDUK
Route::prefix('admin/edit-profil')->group(['middleware' => 'isAuth'], function () {
    Route::get('/', [AccountController::class, 'index'])->name('edit-profil');
    Route::get('/add', [AccountController::class, 'add'])->name('account.add');
    Route::post('/store', [AccountController::class, 'storeAccount'])->name('account.store');
    Route::get('/{account}/edit', [AccountController::class, 'editAccount'])->name('account.edit');
    Route::put('/{account}', [AccountController::class, 'updateAccount'])->name('account.update');
    Route::delete('/{account}/delete', [AccountController::class, 'deleteAccount'])->name('account.delete');
});



//==================================ROUTE PENDUDUK========================================

//ROUTE BERITA PENDUDUK
Route::get('/', [NewsController::class, 'indexUser']);








