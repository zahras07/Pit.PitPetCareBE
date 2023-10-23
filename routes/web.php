<?php

use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\JenisHewanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DokterController;

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
    return view('/dashboard');
})->middleware('auth');


Route::get('/login', [LoginController::class,'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'authenticate']);
Route::get('/logout', [LoginController::class,'logout']);
Route::resource('/dokter', DokterController::class);
Route::resource('/hewan', HewanController::class);
Route::resource('/pelanggan', PelangganController::class);
Route::resource('/paket', PaketController::class);
Route::resource('/layanan', LayananController::class);
Route::resource('/transaksi', TransaksiController::class);
Route::resource('/laporan', LaporanController::class);
Route::resource('/jadwaldokter', JadwalDokterController::class);
Route::resource('/jenishewan', JenisHewanController::class);
Route::get('/cetaksemua',  [LaporanController::class, 'cetaksemua']);
Route::get('/cetakpertanggal/{tglawal}/{tglakhir}',  [LaporanController::class, 'cetakpertanggal']);