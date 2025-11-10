<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TindakanController;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PasienExport;


Route::middleware('auth')->group(function () {
  Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
  
});


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
Route::resource('pasien', PasienController::class);
Route::get('pasien/{id}/riwayat', [PasienController::class, 'riwayat'])->name('pasien.riwayat');
Route::get('pasien/export/excel', [PasienController::class, 'exportExcel'])->name('pasien.export');
Route::resource('pegawai', PegawaiController::class);
Route::resource('poli', PoliController::class);
Route::resource('obat', ObatController::class);
Route::resource('tindakan', TindakanController::class);
Route::get('pasien/{id}/kartu', [PasienController::class, 'kartu'])->name('pasien.kartu');
Route::get('/phpinfo', function() {
    phpinfo();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
