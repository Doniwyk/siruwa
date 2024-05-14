<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\StatisticController;
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



// COBA LISST BERITA COYYYY

Route::get('/list-berita', function () {
    return view('/berita/list-berita');
});


Route::group(['middleware' => 'isGuest'], function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'doLogin']);
});

Route::get('/logout', [AuthenticationController::class, 'doLogout'])->middleware('isAuth')->name('logout');


//==================================ROUTE LANDING PAGE========================================

Route::get('/', [NewsController::class, 'indexUser'])->name('index');


//==================================ROUTE STATISTIC FOR ADMIN========================================

//ROUTE STATISTIK
Route::group([
    'prefix' => 'admin/statistic',
    'as' => 'admin.statistic.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [StatisticController::class, 'index'])->name('index');
});


//==================================ROUTE RESIDENT DATA FOR ADMIN========================================
Route::group([
    'prefix' => 'admin/data-penduduk',
    'as' => 'admin.data-penduduk.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [ResidentController::class, 'indexAdmin'])->name('index');
    Route::get('/add', [ResidentController::class, 'add'])->name('add');
    Route::post('/store', [ResidentController::class, 'storeResident'])->name('store');
    Route::delete('/{resident}/delete', [ResidentController::class, 'deleteResident'])->name('delete');
    Route::get('/{resident}/edit', [ResidentController::class, 'editResident'])->name('edit');
    Route::put('/{resident}', [ResidentController::class, 'updateResident'])->name('update');

});

//==================================ROUTE RESIDENT DATA FOR RESIDENT========================================
Route::group([
    'prefix' => 'user/data-dasawisma',
    'as' => 'user.data-dasawisma.',
    'middleware' => 'isAuth'
],
    function () {
        Route::get('/', [ResidentController::class, 'indexResident'])->name('index');
        Route::get('/{resident}/edit', [ResidentController::class, 'editForm'])->name('edit');
        Route::put('/{resident}', [ResidentController::class, 'requestEditForm'])->name('request');
        Route::delete('/{resident}/delete', [ResidentController::class, 'deleteUser'])->name('delete');
    }
);



//ROUTE MANAJEMEN DOKUMEN
Route::group([
    'prefix' => 'admin/manajemen-dokumen',
    'as' => 'admin.manajemen-dokumen.',
    'middleware' => 'isAuth'
],function(){
    Route::get('/', [DocumentController::class, 'index'])->name('index');
    Route::get('/add', [DocumentController::class, 'add'])->name('add');
    Route::post('/store', [DocumentController::class, 'storeDocument'])->name('store');
    Route::get('/{document}/edit', [DocumentController::class, 'editDocument'])->name('edit');
    Route::put('/{document}', [DocumentController::class, 'updateDocument'])->name('update');
    Route::delete('/{document}/delete', [DocumentController::class, 'deleteDocument'])->name('delete');
});

//ROUTE MANAJEMEN DANA
Route::group([
    'prefix' => 'admin/manajemen-dana',
    'as' => 'admin.manajemen-dana.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::get('/add', [PaymentController::class, 'add'])->name('add');
    Route::post('/store', [PaymentController::class, 'storeAccount'])->name('store');
    Route::get('/{payment}/edit', [PaymentController::class, 'editAccount'])->name('edit');
    Route::put('/{payment}', [PaymentController::class, 'updateAccount'])->name('update');
    Route::delete('/{payment}/delete', [PaymentController::class, 'deleteAccount'])->name('delete');
});


Route::group([
    'prefix' => 'admin/manajemen-acara',
    'as' => 'admin.manajemen-acara.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/add', [EventController::class, 'add'])->name('add');
    Route::post('/store', [EventController::class, 'storeEvent'])->name('store');
    Route::get('/{event}/edit', [EventController::class, 'editEvent'])->name('edit');
    Route::put('/{event}', [EventController::class, 'updateEvent'])->name('update');
    Route::delete('/{event}/delete', [EventController::class, 'deleteEvent'])->name('delete');
});

//==================================ROUTE MANAJEMEN BERITA FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/manajemen-berita',
    'as' => 'admin.manajemen-berita.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/add', [NewsController::class, 'add'])->name('add');
    Route::post('/store', [NewsController::class, 'storeNews'])->name('store');
    Route::get('/{news}/edit', [NewsController::class, 'editNews'])->name('edit');
    Route::put('/{news}', [NewsController::class, 'updateNews'])->name('update');
    Route::delete('/{news}/delete', [NewsController::class, 'deleteNews'])->name('delete');
});


//==================================ROUTE PROFILE FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/profil',
    'as' => 'admin.profil.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/edit', [AccountController::class, 'editAccount'])->name('edit');
    Route::put('/{account}', [AccountController::class, 'updateAccount'])->name('update');
});



//==================================ROUTE PROFILE FOR RESIDENT========================================

Route::group([
    'prefix' => 'penduduk/profil',
    'as' => 'penduduk.profil.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/edit', [AccountController::class, 'editAccount'])->name('edit');
    Route::put('/{account}', [AccountController::class, 'updateAccount'])->name('update');
});

//==================================ROUTE PENDUDUK========================================

//ROUTE PEMBAYARAN


Route::group([
    'prefix' => 'penduduk',
    'as' => 'penduduk.',
    'middleware' => 'isAuth'

], function () {
    Route::get('/', [NewsController::class, 'indexUser'])->name('index');

});

// INI ROUTE CUMA BUAT NYOBA VIEW USER, BIAR DIKERAIN BACKEND MWEHEHEHEH
Route::get('/profil', function () {
    return view('/user/_profile/index');
});
Route::get('/dokumen', function () {
    return view('/user/_residentData/index');
});
Route::get('/request', function () {
    return view('/user/_requestDocument/index');
});
Route::get('/iuran', function () {
    return view('/user/_fund/index');
});
Route::get('/topbar', function () {
    return view('/components/shared/user-topbar');
});
