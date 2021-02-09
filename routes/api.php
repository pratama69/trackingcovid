<?php

use App\Models\Provinsi;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/provinsi', [ProvinsiController::class, 'index']);
// Route::post('/provinsi/store', [ProvinsiController::class, 'store']);
// Route::get('/provinsi/{id?}', [ProvinsiController::class, 'show']);
// Route::post('/provinsi/update/{id?}', [ProvinsiController::class, 'update']);
// Route::delete('/provinsi/{id?}', [ProvinsiController::class, 'destroy']);

// api controller
Route::get('kasus2',[ApiController::class, 'index']);
Route::get('provinsikasus/{id}',[ApiController::class, 'provinsi']);
Route::get('provinsikasus2',[ApiController::class, 'provinsikasus']);
Route::get('kota',[ApiController::class, 'skota']);
Route::get('kecamatan',[ApiController::class, 'skecamatan']);
Route::get('kelurahan',[ApiController::class, 'kelurahan']);
Route::get('rw', [ApiController::class,'rw']);
Route::get('kotaId/{id}',[ApiController::class, 'skotaId']);
Route::get('hari',[ApiController::class, 'hari']);
Route::get('global',[ApiController::class, 'global']);
Route::get('global2',[ApiController::class, 'global2']); 