<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\LaporanController;

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
    return view('landing');
});

Auth::routes(['reset' => true]);

// Dasboard Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Peminjaman Route
Route::get('/admin/peminjaman', [PeminjamanController::class, 'index']);

// Siswa Route
Route::get('/admin/siswa', [SiswaController::class, 'index']);
Route::get('/tambahsiswa', [SiswaController::class, 'create']);
Route::post('/simpansiswa', [SiswaController::class, 'store']); 
Route::get('/editsiswa/{id}', [SiswaController::class, 'edit']); 
Route::put('/siswa/{id}', [SiswaController::class, 'update']);
Route::delete('/hapussiswa/{id}', [SiswaController::class, 'destroy']);

// Alat Route
Route::get('/admin/alat', [AlatController::class, 'index']);
Route::get('/tambahalat', [AlatController::class, 'create']);
Route::post('/simpanalat', [AlatController::class, 'store']); 
Route::get('/editalat/{id}', [AlatController::class, 'edit']); 
Route::put('/alat/{id}', [AlatController::class, 'update']);
Route::delete('/hapusalat/{id}', [AlatController::class, 'destroy']);

// Laporan Route
Route::get('/admin/laporan', [LaporanController::class, 'index']);