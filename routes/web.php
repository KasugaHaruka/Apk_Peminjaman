<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\JenisAlatController;
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
Route::get('/tambahpeminjaman', [PeminjamanController::class, 'create']);
Route::post('/simpanpeminjaman', [PeminjamanController::class, 'store']); 
Route::get('/editpeminjaman/{id}', [PeminjamanController::class, 'edit']); 
Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update']);
Route::delete('/hapuspeminjaman/{id}', [PeminjamanController::class, 'destroy']);
Route::get('/peminjaman/detail/{id}', [PeminjamanController::class, 'detail']);


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

// Jenis Alat Route
Route::get('/admin/jenisalat', [JenisAlatController::class, 'index']);
Route::get('/tambahjenisalat', [JenisAlatController::class, 'create']);
Route::post('/simpanjenisalat', [JenisAlatController::class, 'store']); 
Route::get('/editjenisalat/{id}', [JenisAlatController::class, 'edit']); 
Route::put('/jenisalat/{id}', [JenisAlatController::class, 'update']);
Route::delete('/hapusjenisalat/{id}', [JenisAlatController::class, 'destroy']);

// Laporan Route
Route::get('/admin/laporan', [LaporanController::class, 'index']);