<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\DokterApiController;
use App\Http\Controllers\Api\HewanApiController;
use App\Http\Controllers\Api\JadwalDokterApiController;
use App\Http\Controllers\Api\JenisHewanController;
use App\Http\Controllers\Api\LayananApiController;
use App\Http\Controllers\Api\PaketApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register',[AuthApiController::class,'register']);

Route::post('login',[AuthApiController::class,'login']);
Route::post('logout',[AuthApiController::class,'logout']);

Route::get('user',[UserApiController::class,'userData'])->middleware('jwt.auth');

Route::post('user/change-photo-customer/{pelanggan_id}',[UserApiController::class,'changePhotoProfileCustomer'])->middleware('jwt.auth');

Route::put('user/pelanggan/{pelanggan_id}',[UserApiController::class,'updateDataPelanggan'])->middleware('jwt.auth');

Route::put('user/change-password',[UserApiController::class,'changePassword'])->middleware('jwt.auth');
Route::put('user/change-email',[UserApiController::class,'changeEmail'])->middleware('jwt.auth');


Route::get('dokter',[DokterApiController::class,'index'])->middleware('jwt.auth'); 

Route::get('dokter/detail/{id}',[DokterApiController::class,'detailDokter'])->middleware('jwt.auth'); 

Route::get('layanan',[LayananApiController::class,'index']);

Route::get('paket/{layanan_id}',[PaketApiController::class,'index']);
Route::get('paket',[PaketApiController::class,'allPackageService']);
Route::get('jenis-hewan',[JenisHewanController::class,'index']);

Route::post('booking',[BookingApiController::class,'booking'])->middleware('jwt.auth');
Route::get('booking',[BookingApiController::class,'index'])->middleware('jwt.auth');
Route::put('booking/cancel/{transaction_id}',[BookingApiController::class,'cancelBooking'])->middleware('jwt.auth');

Route::get('dokter/jadwal',[JadwalDokterApiController::class,'index'])->middleware('jwt.auth');

Route::get('hewan/{pelanggan_id}',[HewanApiController::class,'index'])->middleware('jwt.auth');
Route::post('hewan',[HewanApiController::class,'hewan'])->middleware('jwt.auth');

// Route::middleware('auth:sanctum')->group(function(){
//     Route::post('logout',[AuthApiController::class,'logout']);
//     Route::get('user', function (Request $request){
//         return $request->user();
//     });
// });