<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PasienExport;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::resource('pasien', PasienController::class);
Route::get('pasien/{id}/riwayat', [PasienController::class, 'riwayat'])->name('pasien.riwayat');
Route::get('pasien/export/excel', [PasienController::class, 'exportExcel'])->name('pasien.export');
Route::get('pasien/{id}/kartu', [PasienController::class, 'kartu'])->name('pasien.kartu');