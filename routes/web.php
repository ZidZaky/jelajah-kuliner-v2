<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PKLController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\halamanController;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Route;
use App\Models\Ulasan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use app\Models\PKL;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//NON TESTING
    Route::get('/', function () {

        return redirect('/dashboard');
    });
    Route::get('/TS', [Controller::class, 'TS']);
    Route::get('/dashboard', function () {
        if (session()->has('account')) {
            $pkl = new PKLController();
            $ulasan = Ulasan::all();

            $pesanan = Pesanan::all();
            return view('dashboard', ['ulasan' => $ulasan, 'pesanan' => $pesanan]);
        }
        return view('dashboard', ['ulasan' => [], 'pesanan' => []]);
    });
    Route::get('/getData', [PKLController::class, 'getDataPKL']);
    Route::get('/aboutus', function () {
        return view('aboutus');
    });

    Route::post('loginAccount', [AccountController::class, 'login']);

    Route::get('pesanDetail/{id}', [PesananController::class, 'pesanDetail']);
    Route::get('/hst', function () {
        return view('riwayatProduk');
    });

    Route::get('/rwt/{$idPklpidProduk}', [halamanController::class, 'getrwtStok']);
    Route::get('/dataPKL/{idAccount}', [PKLController::class, 'showDetail']);
    // Route::get('/tes',[PKLController::class,'getDataPKL']);
    Route::get('/login', function () {
        if (session()->has('account')) {
            return redirect('/dashboard');
        }
        return view('login');
    })->name('login');

    Route::middleware(['status:Pelanggan,PKL,Admin'])->group(function () {
        Route::get('/profile', function () {
            return view('profile');
        });
        Route::get('/Profile', function () {
            return redirect('/profile');
        });
        Route::post('/account/{id}', [AccountController::class, 'editProfile']);
        Route::resource('/account', AccountController::class);
        Route::resource('/PKL', PKLController::class);
        Route::resource('/produk', ProdukController::class);
        Route::resource('/ulasan', UlasanController::class);
        Route::resource('/pesanan', PesananController::class);
        Route::resource('/report', ReportController::class);
        Route::get('/pesanan/create/{id}', [PesananController::class, 'createWithId'])->name('pesanan.createWithId');
        Route::get('/ulasan/create/{id}', [UlasanController::class, 'createWithId']);
        Route::get('logout', [AccountController::class, 'logoutAccount']);
        Route::get('batalPesanan/{id}', [PesananController::class, 'batalPesanan']);
    });

    Route::middleware(['status:PKL'])->group(function () {
        Route::post('/update-location', [PKLController::class, 'updateLocation']);
        Route::get('/rwt/{idpklpidproduk}', [halamanController::class, 'getrwtStok']);
        Route::get('/chartTahun', [halamanController::class, 'ChartMonth']);
        Route::get('terimaPesanan/{id}', [PesananController::class, 'terimaPesanan']);
        Route::get('tolakPesanan/{id}', [PesananController::class, 'tolakPesanan']);
        Route::get('selesaiPesanan/{id}', [PesananController::class, 'selesaiPesanan']);
        Route::get('riwayatProduk/{id}', [ProdukController::class, 'riwayatProduk']);
        Route::get('/Dashboard-Penjualan/{idAccVApa}', [halamanController::class, 'DashboardPenjualan']);
        Route::post('/MakeStokAwal', [halamanController::class, 'UpdateStatusStok'])->name('MakeStokAwal');
        Route::post('/updateStokAkhir', [halamanController::class, 'UpdateStokAkhir'])->name('updateStokAkhir');
        Route::get('/buatStokAkhir/{id}', [ProdukController::class, 'buatStokAkhir']);
        Route::get('/buatStokAwal/{id}', [ProdukController::class, 'buatStokAwal']);
        Route::post('/buatHistory', [ProdukController::class, 'buatHistory']);
        Route::post('/updateHistory', [ProdukController::class, 'updateHistory']);
    });

    Route::middleware(['status:Admin'])->group(function () {

        Route::get('banUser/{id}', [ReportController::class, 'banUser']);
        Route::get('unbanUser/{id}', [ReportController::class, 'unbanUser']);
    });

    Route::get('/gk', function () {
        return view('dp');
    });

    Route::get('//PageNotFound', function () {
        return view('page-not-found');
    });


    // Define a route to fetch coordinates from the database
    Route::get('/getCoordinates', [PKLController::class, 'getCoordinates']);
    // Route::get('/getUlasan', [UlasanController::class, 'getUlasan']);
    Route::get('/getUlasan/{id}', [UlasanController::class, 'getUlasan']);
    Route::get('/getProduk/{id}', [ProdukController::class, 'getProduk']);
    Route::get('/getPictureByID/{id}', [PKLController::class, 'getPictureByID']);
    Route::get('/userguide', function () {
        return view('userguide');
    });

    Route::get('/getIDPkl/{id}', [PKLController::class, 'getIdPKL']);


//TESTING
    Route::get('/', function () {

        return redirect('/dashboard');
    });
    Route::get('/TS', [Controller::class, 'TS']);
    Route::get('/dashboard', function () {
        if (session()->has('account')) {
            $pkl = new PKLController();
            $ulasan = Ulasan::all();

            $pesanan = Pesanan::all();
            return view('dashboard', ['ulasan' => $ulasan, 'pesanan' => $pesanan]);
        }
        return view('dashboard', ['ulasan' => [], 'pesanan' => []]);
    });
    Route::get('/getData', [PKLController::class, 'getDataPKL']);
    Route::get('/aboutus', function () {
        return view('aboutus');
    });

    Route::post('loginAccount', [AccountController::class, 'login']);

    Route::get('pesanDetail/{id}', [PesananController::class, 'pesanDetail']);
    Route::get('/hst', function () {
        return view('riwayatProduk');
    });

    Route::get('/rwt/{$idPklpidProduk}', [halamanController::class, 'getrwtStok']);
    Route::get('/dataPKL/{idAccount}', [PKLController::class, 'showDetail']);
    // Route::get('/tes',[PKLController::class,'getDataPKL']);
    Route::get('/login', function () {
        if (session()->has('account')) {
            return redirect('/dashboard');
        }
        return view('login');
    })->name('login');

    // Route::middleware(['status:Pelanggan,PKL,Admin'])->group(function () {
        Route::get('/profile', function () {
            return view('profile');
        });
        Route::get('/Profile', function () {
            return redirect('/profile');
        });
        Route::post('/account/{id}', [AccountController::class, 'editProfile']);
        Route::resource('/account', AccountController::class);
        Route::resource('/PKL', PKLController::class);
        Route::resource('/produk', ProdukController::class);
        Route::resource('/ulasan', UlasanController::class);
        Route::resource('/pesanan', PesananController::class);
        Route::resource('/report', ReportController::class);
        Route::get('/pesanan/create/{id}', [PesananController::class, 'createWithId'])->name('pesanan.createWithId');
        Route::get('/ulasan/create/{id}', [UlasanController::class, 'createWithId']);
        Route::get('logout', [AccountController::class, 'logoutAccount']);
        Route::get('batalPesanan/{id}', [PesananController::class, 'batalPesanan']);
    // });

    // Route::middleware(['status:PKL'])->group(function () {
        Route::post('/update-location', [PKLController::class, 'updateLocation']);
        Route::get('/rwt/{idpklpidproduk}', [halamanController::class, 'getrwtStok']);
        Route::get('/chartTahun', [halamanController::class, 'ChartMonth']);
        Route::get('terimaPesanan/{id}', [PesananController::class, 'terimaPesanan']);
        Route::get('tolakPesanan/{id}', [PesananController::class, 'tolakPesanan']);
        Route::get('selesaiPesanan/{id}', [PesananController::class, 'selesaiPesanan']);
        Route::get('riwayatProduk/{id}', [ProdukController::class, 'riwayatProduk']);
        Route::get('/Dashboard-Penjualan/{idAccVApa}', [halamanController::class, 'DashboardPenjualan']);
        Route::post('/MakeStokAwal', [halamanController::class, 'UpdateStatusStok'])->name('MakeStokAwal');
        Route::post('/updateStokAkhir', [halamanController::class, 'UpdateStokAkhir'])->name('updateStokAkhir');
        Route::get('/buatStokAkhir/{id}', [ProdukController::class, 'buatStokAkhir']);
        Route::get('/buatStokAwal/{id}', [ProdukController::class, 'buatStokAwal']);
        Route::post('/buatHistory', [ProdukController::class, 'buatHistory']);
        Route::post('/updateHistory', [ProdukController::class, 'updateHistory']);
    // });

    // Route::middleware(['status:Admin'])->group(function () {

        Route::get('banUser/{id}', [ReportController::class, 'banUser']);
        Route::get('unbanUser/{id}', [ReportController::class, 'unbanUser']);
    // });

    Route::get('/gk', function () {
        return view('dp');
    });

    Route::get('//PageNotFound', function () {
        return view('page-not-found');
    });


    // Define a route to fetch coordinates from the database
    Route::get('/getCoordinates', [PKLController::class, 'getCoordinates']);
    // Route::get('/getUlasan', [UlasanController::class, 'getUlasan']);
    Route::get('/getUlasan/{id}', [UlasanController::class, 'getUlasan']);
    Route::get('/getProduk/{id}', [ProdukController::class, 'getProduk']);
    Route::get('/getPictureByID/{id}', [PKLController::class, 'getPictureByID']);
    Route::get('/userguide', function () {
        return view('userguide');
    });

    Route::get('/getIDPkl/{id}', [PKLController::class, 'getIdPKL']);

