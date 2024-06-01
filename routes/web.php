<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDocumentController;
use App\Http\Controllers\AdminImportResidentController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ResidentDocumentController;
use App\Http\Controllers\ResidentPaymentController;
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

Route::get('/coba', [NewsController::class, 'coba'])->name('coba');


//==================================ROUTE LOGIN & LOGOUT========================================

Route::group(['middleware' => 'isGuest', 'revalidate'], function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'doLogin']);
});
Route::get('/logout', [AuthenticationController::class, 'doLogout'])->middleware('isAuth', 'revalidate')->name('logout');


//==================================ROUTE LANDING PAGE========================================

Route::get('/', [DashboardController::class, 'indexLandingPage'])->name('index');


//==================================ROUTE STATISTIC FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/statistik',
    'as' => 'admin.statistic.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
], function () {
    Route::get('/', [StatisticController::class, 'index'])->name('index');
});

//==================================ROUTE DASHBOARD MANAJEMEN FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/dashboard',
    'as' => 'admin.dashboard.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
], function () {
    Route::get('/', [DashboardController::class, 'dataDashboard'])->name('index');
    Route::put('/{resident}', [DashboardController::class, 'updateDashboardData'])->name('update');

});



//==================================ROUTE RESIDENT DATA FOR ADMIN========================================
Route::group([
    'prefix' => 'admin/data-penduduk',
    'as' => 'admin.data-penduduk.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [ResidentController::class, 'indexAdmin'])->name('index');
    Route::get('/tambah-penduduk', [ResidentController::class, 'add'])->name('add');
    Route::post('/store', [ResidentController::class, 'storeResident'])->name('store');
    Route::get('/{resident}/show', [ResidentController::class, 'showDetailResident'])->name('show');
    Route::delete('/{resident}/delete', [ResidentController::class, 'deleteResident'])->name('delete');
    Route::get('/{resident}/edit', [ResidentController::class, 'editResident'])->name('edit');
    Route::put('/{resident}', [ResidentController::class, 'updateResident'])->name('update');
    Route::get('/pengajuan-perubahan', [ResidentController::class, 'indexRequest'])->name('request');
    Route::put('/validasi-pengajuan/{resident}', [ResidentController::class, 'validateEditRequest'])->name('validate');
    //==================================ROUTE IMPORT DATA FOR ADMIN========================================
    Route::post('/admin/import-resident', [AdminImportResidentController::class, 'importResident'])->name('admin.import.resident');
    Route::get('/admin/resident-preview', [AdminImportResidentController::class, 'showPreview'])->name('admin.resident.preview');
    Route::post('/admin/save-imported-residents', [AdminImportResidentController::class, 'saveImportedResidents'])->name('admin.save.imported.residents');
});

//==================================ROUTE RESIDENT DATA FOR RESIDENT========================================
Route::group(
    [
        'prefix' => 'penduduk/data-dasawisma',
        'as' => 'resident.data-dasawisma.',
        'middleware' => 'isAuth'
    ],
    function () {
        Route::get('/', [ResidentController::class, 'indexResident'])->name('index');
        Route::get('/edit', [ResidentController::class, 'editForm'])->name('edit');
        Route::post('/{resident}/store', [ResidentController::class, 'storeEditRequest'])->name('store'); // To store the submission data into the resident temp
        Route::put('/riwayat', [ResidentController::class, 'historyEditRequest'])->name('request');
    }
);

//==================================ROUTE DOCUMENT FOR RESIDENT========================================
Route::group([
    'prefix' => 'penduduk/data-dokumen',
    'as' => 'resident.data-dokumen.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [ResidentDocumentController::class, 'index'])->name('index');
    Route::post('/request', [ResidentDocumentController::class, 'requestDocument'])->name('request');
    Route::get('/riwayat', [ResidentDocumentController::class, 'history'])->name('history');
});

//==================================ROUTE DOCUMENT FOR ADMIN========================================
Route::group([
    'prefix' => 'admin/data-dokumen',
    'as' => 'admin.data-dokumen.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [AdminDocumentController::class, 'index'])->name('index'); //mendapatkan halaman data dokumen yang harus divalidasi
    Route::put('/{document}/validate', [AdminDocumentController::class, 'validateDocument'])->name('validateDocument'); //proses validasi dokumen
    Route::get('/{document}/edit', [AdminDocumentController::class, 'getEditPage'])->name('edit-data-dokumen');
    Route::put('/{document}/status', [AdminDocumentController::class, 'changeStatus'])->name('changeStatus'); //proses mengganti status ke bisa diambil / dibatalkan
    Route::put('/{document}/selesai', [AdminDocumentController::class, 'changeIntoSelesai'])->name('changeIntoSelesai'); //proses mengganti status ke bisa diambil / dibatalkan
    Route::get('/history', [AdminDocumentController::class, 'validatedHistory'])->name('history'); // mendapatkan riwayat data dokumen
});

//==================================ROUTE PAYMENT FOR RESIDENT========================================
Route::group([
    'prefix' => 'penduduk/data-pembayaran',
    'as' => 'resident.data-pembayaran.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [ResidentPaymentController::class, 'index'])->name('index');
    Route::get('/add-pembayaran', [ResidentPaymentController::class, 'getAddPaymentForm'])->name('formPembayaran');
    Route::post('/add-pembayaran', [ResidentPaymentController::class, 'storePayment'])->name('store');
    Route::get('/riwayat', [ResidentPaymentController::class, 'getHistory'])->name('history');
});

//==================================ROUTE PAYMENT FOR ADMIN========================================
Route::group([
    'prefix' => 'admin/data-pembayaran',
    'as' => 'admin.data-pembayaran.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [AdminPaymentController::class, 'index'])->name('index'); //mendapatkan halaman data pembayaran yang harus divalidasi
    Route::get('/{payment}/show', [AdminPaymentController::class, 'showBuktiPembayaran'])->name('showBuktiPembayaran');
    Route::put('/{payment}/validate', [AdminPaymentController::class, 'validatePayment'])->name('validatePembayaran'); //proses validasi pembayaran
    Route::get('/history', [AdminPaymentController::class, 'validatedPayment'])->name('history'); //mendapatkan halaman riwayat pembayaran
});


//==================================ROUTE EVENT MANAGEMENT FOR ADMIN========================================

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

//==================================ROUTE NEWS MANAGEMENT FOR ADMIN========================================

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
    Route::put('/update-profil}', [AccountController::class, 'updateAccount'])->name('update');
    Route::put('/update-password', [AccountController::class, 'updatePassword'])->name('changePassword');
});



//==================================ROUTE PROFILE FOR RESIDENT========================================

Route::group([
    'prefix' => 'penduduk/profil',
    'as' => 'resident.profil.',
    'middleware' => 'isAuth'
], function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/edit', [AccountController::class, 'editAccount'])->name('edit');
    // Route::put('/{account}', [AccountController::class, 'updateAccount'])->name('update');
    Route::put('/update-profil}', [AccountController::class, 'updateAccount'])->name('update');
    Route::put('/update-password', [AccountController::class, 'updatePassword'])->name('changePassword');
});

//==================================ROUTE PENDUDUK========================================

//ROUTE PEMBAYARAN


Route::group([
    'prefix' => 'penduduk',
    'as' => 'resident.',
    'middleware' => 'isAuth'

], function () {
    Route::get('/', [NewsController::class, 'indexResident'])->name('index');
});
