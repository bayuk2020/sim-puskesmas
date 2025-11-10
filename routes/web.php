<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TindakanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\PrescriptionsController;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PasienExport;


Route::middleware('auth')->group(function () {
  Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
   Route::get('/kunjungan', [VisitController::class, 'index'])->name('visits.index');
   Route::get('/kunjungan', [PrescriptionsController::class, 'index'])->name('prescriptions.index');
  // Contoh proteksi per modul:
//   Route::middleware('can:manage-visits')->group(function () {
//     Route::resource('visits', VisitController::class);
//   });

//   Route::middleware('can:manage-prescriptions')->group(function () {
//     Route::resource('prescriptions', PrescriptionController::class)->only(['show','store','destroy']);
//   });

//   Route::middleware('can:manage-payments')->group(function () {
//     Route::get('visits/{visit}/payment', [PaymentController::class,'prepare'])->name('payments.create');
//     Route::post('visits/{visit}/pay', [PaymentController::class,'pay'])->name('payments.pay');
//     Route::get('visits/{visit}/receipt', [PaymentController::class,'receipt'])->name('payments.receipt');
//   });

  // reports, settings, dsb…
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
