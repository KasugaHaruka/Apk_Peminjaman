<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Peminjaman Route
Route::get('/admin/peminjaman', [App\Http\Controllers\PeminjamanController::class, 'index']);

// Siswa Route
Route::get('/admin/siswa', [App\Http\Controllers\SiswaController::class, 'index']);

// Alat Route
Route::get('/admin/alat', [App\Http\Controllers\AlatController::class, 'index']);

// Laporan Route
Route::get('/admin/laporan', [App\Http\Controllers\LaporanController::class, 'index']);