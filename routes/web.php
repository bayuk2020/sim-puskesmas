<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RekamMedisController;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PasienExport;


Route::middleware('auth')->group(function () {
  Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
 Route::get('/visits', [VisitController::class, 'index'])->name('visits.index');
   Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/doctor', [ReportController::class, 'doctor'])->name('reports.doctor');
    Route::get('/reports/poli', [ReportController::class, 'poli'])->name('reports.poli');
     Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
     Route::get('/rekammedis/create/{visit}', [RekamMedisController::class, 'create'])
    ->name('rekammedis.create');
    Route::post('/rekammedis/store/{visit}', [RekamMedisController::class, 'store'])
    ->name('rekammedis.store');
  
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
