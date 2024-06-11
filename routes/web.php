<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDocumentController;
use App\Http\Controllers\AdminImportResidentController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AuthenticationController;
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
use App\Http\Controllers\DSSController;
use App\Http\Controllers\DSSFuzzyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ExportResidentController;
use App\Http\Controllers\DSSCombinedController;

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



// COBA LIST BERITA COYYYY

Route::get('/berita/list-berita', [NewsController::class, 'ListBerita'])->name('list-berita.index');
// Route::get('/berita/list-berita', [NewsController::class, 'NewsListPage'])->name('list-berita');
// Route::get('/berita/list-berita', [EventController::class, 'AgendaListPage'])->name('list-berita.index');

Route::get('/berita/{type}/{id}/artikel', [NewsController::class, 'showArtikel'])->name('list-berita.show');

//==================================ROUTE LOGIN & LOGOUT========================================

Route::group(['middleware' => \App\Http\Middleware\IsGuest::class, 'revalidate'], function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'doLogin']);
});
Route::get('/logout', [AuthenticationController::class, 'doLogout'])->middleware('isAuth', 'revalidate')->name('logout');


//==================================ROUTE LANDING PAGE========================================

Route::get('/', [DashboardController::class, 'indexLandingPage'])->name('index')->middleware('redirectIfAdmin');
Route::get('/fetch-events', [DashboardController::class, 'fetchEvents']);
//==================================ROUTE STATISTIC FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/statistik',
    'as' => 'admin.statistic.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
], function () {
    Route::get('/', [StatisticController::class, 'index'])->name('index');
    Route::get('/job', [StatisticController::class, 'getJobData'])->name('getJobData');
    Route::get('/lastStudied', [StatisticController::class, 'getLastStudiedData'])->name('getLastStudiedData');
    Route::get('/bansos', [DSSController::class, 'index'])->name('bansos');
    Route::get('/getAgeDistribution', [StatisticController::class, 'getAgeDistribution'])->name('getAgeDistribution');
});

//==================================ROUTE DASHBOARD MANAJEMEN FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/dashboard',
    'as' => 'admin.dashboard.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
], function () {
    Route::get('/', [DashboardController::class, 'manajemenDashboard'])->name('index');
    Route::put('/{data}', [DashboardController::class, 'updateDashboardData'])->name('update');

});


//==================================ROUTE RESIDENT DATA FOR ADMIN========================================
Route::group([
    'prefix' => 'admin/data-penduduk',
    'as' => 'admin.data-penduduk.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
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

    Route::get('/import', [AdminImportResidentController::class, 'importForm'])->name('import');
    Route::post('/import-file', [AdminImportResidentController::class, 'importFile'])->name('importFile');
    Route::post('/save-imported-residents', [AdminImportResidentController::class, 'saveImportedResidents'])->name('saveImport');
    Route::post('/import/preview', [AdminImportResidentController::class, 'previewImport'])->name('preview');   
    //==================================ROUTE EXPORT DATA FOR ADMIN========================================
    Route::get('/generate-pdf', [ExportController::class, 'exportResidentData'])->name('export');
    // Route::get('/generate-pdf', [ExportController::class, 'exportPaymentData'])->name('exportPayment');
});

//==================================ROUTE RESIDENT DATA FOR RESIDENT========================================
Route::group(
    [
        'prefix' => 'penduduk/data-dasawisma',
        'as' => 'resident.data-dasawisma.',
        'middleware' => ['isAuth', 'userAccess:resident']
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
    'middleware' => ['isAuth', 'userAccess:resident']
], function () {
    Route::get('/', [ResidentDocumentController::class, 'index'])->name('index');
    Route::post('/request', [ResidentDocumentController::class, 'requestDocument'])->name('request');
    Route::get('/riwayat', [ResidentDocumentController::class, 'history'])->name('history');
});

//==================================ROUTE DOCUMENT FOR ADMIN========================================
Route::group([
    'prefix' => 'admin/data-dokumen',
    'as' => 'admin.data-dokumen.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
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
    'middleware' => ['isAuth', 'userAccess:resident']
], function () {
    Route::get('/', [ResidentPaymentController::class, 'index'])->name('index');
    Route::get('/add-pembayaran', [ResidentPaymentController::class, 'getAddPaymentForm'])->name('formPembayaran');
    Route::post('/add-pembayaran', [ResidentPaymentController::class, 'storePayment'])->name('store');
    Route::get('/riwayat', [ResidentPaymentController::class, 'getHistory'])->name('history');
});
Route::get('/resident/fund', [ResidentPaymentController::class, 'getFundByYear'])->name('resident.fund.index');

//==================================ROUTE PAYMENT FOR ADMIN========================================
Route::group([
    'prefix' => 'admin/data-pembayaran',
    'as' => 'admin.data-pembayaran.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
], function () {
    Route::get('/', [AdminPaymentController::class, 'index'])->name('index'); //mendapatkan halaman data pembayaran yang harus divalidasi
    Route::get('/{payment}/show', [AdminPaymentController::class, 'showBuktiPembayaran'])->name('showBuktiPembayaran');
    Route::put('/{payment}/validate', [AdminPaymentController::class, 'validatePayment'])->name('validatePembayaran'); //proses validasi pembayaran
    Route::get('/{payment}/history', [AdminPaymentController::class, 'validatedPayment'])->name('history'); //mendapatkan halaman riwayat pembayaran
    Route::get('/generate-pdf', [ExportController::class, 'exportPaymentData'])->name('export');
    Route::get('/tunggakan', [AdminPaymentController::class, 'getDataTunggakan'])->name('tunggakan');
    Route::get('/laporan',[AdminPaymentController::class,'addExpense'])->name('add');
    Route::post('/storeExpense',[AdminPaymentController::class,'storeExpense'])->name('store');
    Route::get('/{idPengeluaran}/expense-history',[AdminPaymentController::class,'expenseHistory'])->name('expenseHistory');

});


//==================================ROUTE EVENT MANAGEMENT FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/manajemen-acara',
    'as' => 'admin.manajemen-acara.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
], function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/add', [EventController::class, 'add'])->name('add');
    Route::post('/store', [EventController::class, 'storeEvent'])->name('store');
    Route::get('/{event}/edit', [EventController::class, 'editEvent'])->name('edit');
    Route::put('/{event}/edit-status', [EventController::class, 'changeStatus'])->name('edit-status');
    Route::put('/{event}', [EventController::class, 'updateEvent'])->name('update');
    Route::delete('/{event}/delete', [EventController::class, 'deleteEvent'])->name('delete');
});
//==================================ROUTE NEWS MANAGEMENT FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/manajemen-berita',
    'as' => 'admin.manajemen-berita.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
], function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/add', [NewsController::class, 'add'])->name('add');
    Route::post('/store', [NewsController::class, 'storeNews'])->name('store');
    Route::get('/{news}/edit', [NewsController::class, 'editNews'])->name('edit');
    Route::put('/{news}/edit-status', [NewsController::class, 'changeStatus'])->name('edit-status');
    Route::put('/{news}', [NewsController::class, 'updateNews'])->name('update');
    Route::delete('/{news}/delete', [NewsController::class, 'deleteNews'])->name('delete');
});


//==================================ROUTE PROFILE FOR ADMIN========================================

Route::group([
    'prefix' => 'admin/profil',
    'as' => 'admin.profil.',
    'middleware' =>  ['isAuth', 'userAccess:admin']
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
    'middleware' => ['isAuth', 'userAccess:resident']
], function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');;
    Route::get('/edit', [AccountController::class, 'editAccount'])->name('edit');
    // Route::put('/{account}', [AccountController::class, 'updateAccount'])->name('update');
    Route::put('/update-profil}', [AccountController::class, 'updateAccount'])->name('update');
    Route::put('/update-password', [AccountController::class, 'updatePassword'])->name('changePassword');
});
Route::get('/profile/info', [AccountController::class, 'getUserProfile']);

//==================================ROUTE PENDUDUK========================================

//ROUTE PEMBAYARAN


Route::group([
    'prefix' => 'penduduk',
    'as' => 'resident.',
    'middleware' => ['isAuth', 'userAccess:resident']
], function () {
    Route::get('/', [NewsController::class, 'indexResident'])->name('index');
});
