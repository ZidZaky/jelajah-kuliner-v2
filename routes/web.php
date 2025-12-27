<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PKLController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\halamanController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// =========================
// PUBLIC ROUTES
// =========================
Route::get('/', fn () => redirect('/dashboard'))->name('home');

Route::get('/dashboard', fn () => view('map'))->name('dashboard.index');
Route::get('/TS', [Controller::class, 'TS'])->name('ts.index');

Route::get('/cek', fn () => view('LamaranKerja'))->name('lamaran.index');
Route::get('/tes_online', fn () => view('EVI.TesOnline'))->name('tesonline.index');
Route::get('/aboutus', fn () => view('aboutus'))->name('about.index');
Route::get('/userguide', fn () => view('userguide'))->name('userguide');


// =========================
// AUTH
// =========================
Route::get('/login', function () {
    if (session()->has('account')) {
        return redirect('/dashboard');
    }
    return view('login');
})->name('login.index');

Route::post('/loginAccount', [AccountController::class, 'login'])->name('login.process');
Route::get('/logout', [AccountController::class, 'logoutAccount'])->name('logout');


// =========================
// API / AJAX
// =========================
Route::get('/getData', [PKLController::class, 'getDataPKL'])->name('pkl.data');
Route::get('/getCoordinates', [PKLController::class, 'getCoordinates'])->name('pkl.coordinates');
Route::get('/getUlasan', [UlasanController::class, 'getUlasan'])->name('ulasan.all');
Route::get('/getUlasan/{id}', [UlasanController::class, 'getUlasan'])->name('ulasan.byId');
Route::get('/getProduk/{id}', [ProdukController::class, 'getProduk'])->name('produk.get');
Route::get('/getPictureByID/{id}', [PKLController::class, 'getPictureByID'])->name('pkl.picture');
Route::get('/getIDPkl/{id}', [PKLController::class, 'getIdPKL'])->name('pkl.getId');


// =========================
// RESOURCE ROUTES (AUTO NAME)
// =========================
Route::resource('/account', AccountController::class);
Route::resource('/PKL', PKLController::class);
Route::resource('/produk', ProdukController::class);
Route::resource('/pesanan', PesananController::class);
Route::resource('/ulasan', UlasanController::class);
Route::resource('/report', ReportController::class);


// =========================
// PESANAN
// =========================
Route::get('/pesanDetail/{id}', [PesananController::class, 'pesanDetail'])
    ->name('pesanan.detail');

Route::get('/pesanan/create/{id}', [PesananController::class, 'createWithId'])
    ->name('pesanan.createWithId');

Route::get('/batalPesanan', [PesananController::class, 'batalPesanan'])
    ->name('pesanan.batal');


// =========================
// AUTHENTICATED USER
// =========================
Route::middleware(['status:PKL|Pelanggan|Admin'])->group(function () {

    Route::get('/profile', fn () => view('profile'))->name('profile.index');
    Route::get('/Profile', fn () => redirect('/profile'))->name('profile.redirect');

    Route::post('/account/update-photo', [AccountController::class, 'updatePhoto'])
        ->name('account.updatePhoto');

    Route::post('/pkl/update-photo', [PKLController::class, 'updatePklPhoto'])
        ->name('pkl.updatePhoto');

    Route::post('/account/{id}', [AccountController::class, 'editProfile'])
        ->name('account.update');
});


// =========================
// PKL ONLY
// =========================
Route::middleware(['status:PKL'])->group(function () {

    Route::post('/update-location', [PKLController::class, 'updateLocation'])
        ->name('pkl.updateLocation');

    Route::get('/rwt/{id}', [halamanController::class, 'getrwtStok'])
        ->name('stok.riwayat');

    Route::get('/History-Stok/{id}', [halamanController::class, 'history'])
        ->name('stok.history');

    Route::get('/chartTahun', [halamanController::class, 'ChartMonth'])
        ->name('chart.tahun');

    Route::get('/terimaPesanan', [PesananController::class, 'terimaPesanan'])
        ->name('pesanan.terima');

    Route::get('/tolakPesanan', [PesananController::class, 'tolakPesanan'])
        ->name('pesanan.tolak');

    Route::get('/siapDiambilPesanan', [PesananController::class, 'siapDiambilPesanan'])
        ->name('pesanan.siap');

    Route::get('/selesaiPesanan', [PesananController::class, 'selesaiPesanan'])
        ->name('pesanan.selesai');

    Route::get('/Dashboard-Penjualan/{id}', [halamanController::class, 'DashboardPenjualan'])
        ->name('penjualan.dashboard');

    Route::post('/MakeStokAwal', [halamanController::class, 'UpdateStatusStok'])
        ->name('stok.awal');

    Route::post('/updateStokAkhir', [halamanController::class, 'UpdateStokAkhir'])
        ->name('stok.akhir');

    Route::post('/buatHistory', [ProdukController::class, 'buatHistory'])
        ->name('history.store');

    Route::post('/updateHistory', [ProdukController::class, 'updateHistory'])
        ->name('history.update');
});


// =========================
// ADMIN ONLY
// =========================
Route::middleware(['status:Admin'])->group(function () {

    Route::get('/banUser/{id}', [ReportController::class, 'banUser'])
        ->name('admin.ban');

    Route::get('/unbanUser/{id}', [ReportController::class, 'unbanUser'])
        ->name('admin.unban');
});


// =========================
// ERROR & STATIC
// =========================
Route::get('/404', fn () => view('new.pagenotfound'))->name('error.404');
Route::get('/access-denied', fn () => view('new.accessdenied'))->name('error.accessDenied');



// start here 
