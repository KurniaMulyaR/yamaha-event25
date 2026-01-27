<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DelearController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/pilih-motor/{enc}', [HomeController::class, 'motor'])->name('motor');
Route::get('/general-privacy', [HomeController::class, 'generalprivacy'])->name('generalprivacy');

Route::resource('booking', BookingController::class);
Route::post('/pembayaran', [BookingController::class, 'pembayaran'])->name('pembayaran');
Route::post('/metpem', [BookingController::class, 'metpem'])->name('metpem');
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);

Route::post('/check-email', [UserController::class, 'checkEmail'])
    ->name('check.email');

Route::get('/ajax/provinsi/{id}', [WilayahController::class, 'provinsi']);
Route::get('/ajax/kota/{provinsi}', [WilayahController::class, 'kota']);
Route::get('/ajax/kecamatan/{kota}', [WilayahController::class, 'kecamatan']);
Route::get('/ajax/kelurahan/{kecamatan}', [WilayahController::class, 'kelurahan']);
Route::get('/ajax/dealer', [WilayahController::class, 'dealer']);

//log-viewers
Route::get('log-viewers', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::middleware(['auth','role:user'])->group(function () {
    Route::resource('profile', ProfileController::class);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth','role:admin'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('user', UserController::class);
        Route::get('/reportusers', [UserController::class, 'getUser'])->name('getUser');
        Route::resource('produk', ProdukController::class);
        Route::get('/reportproduk', [ProdukController::class, 'getProduk'])->name('getProduk');
        Route::resource('pengiriman', PengirimanController::class);
        Route::get('/reportpesanan', [PengirimanController::class, 'getPesanan'])->name('getPesanan');

        Route::resource('delear', DelearController::class);
        Route::get('/reportdelear', [DelearController::class, 'getDelear'])->name('getDelear');
        Route::post('/dealer/import', [DelearController::class, 'import'])
->name('dealer.import');


    });

require __DIR__.'/auth.php';
