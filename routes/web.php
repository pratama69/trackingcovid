<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinsiController;


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

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('testing', function () {
    return view('layouts.master');
});


use App\Http\Controllers\FrontendController;
Route::resource('/', FrontendController::class);


// Route::resource('index', FrontendController::class);
// Auth::routes();

// Route::get('provinsi', function () {
//     return view('admin.provinsi.index');
// });

Auth::routes();

Route::resource('provinsi', ProvinsiController::class);

use App\Http\Controllers\KotaController;
Route::resource('kota', KotaController::class);

use App\Http\Controllers\KecamatanController;
Route::resource('kecamatan', KecamatanController::class);

use App\Http\Controllers\KelurahanController;
Route::resource('kelurahan', KelurahanController::class);

use App\Http\Controllers\RwController;
Route::resource('rw', RwController::class);

use App\Http\Controllers\Kasus2Controller;
Route::resource('kasus2', Kasus2Controller::class);



// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


