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
use App\Http\Controllers\RekamMedisController;
use Illuminate\Support\Facades\Auth;


Route::redirect('/', '/login');


Auth::routes();

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware('auth');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Kunjungan
    Route::get('/visits', [VisitController::class, 'index'])->name('visits.index');
    Route::get('/visits/create/{patient}', [VisitController::class, 'create'])->name('visits.create');
    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');
    Route::get('/visits/search-json', [VisitController::class, 'searchJson'])->name('visits.search-json');

    // Antrian
    Route::get('/antrian', [VisitController::class, 'antrian'])->name('visits.antrian');

    // Laporan
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/doctor', [ReportController::class, 'doctor'])->name('reports.doctor');
    Route::get('/reports/poli', [ReportController::class, 'poli'])->name('reports.poli');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    // Rekam Medis
    Route::get('/rekammedis/create/{visit}', [RekamMedisController::class, 'create'])->name('rekammedis.create');
    Route::post('/rekammedis/store/{visit}', [RekamMedisController::class, 'store'])->name('rekammedis.store');

    // Master Data
    Route::resource('pasien', PasienController::class);
    Route::get('pasien/{id}/riwayat', [PasienController::class, 'riwayat'])->name('pasien.riwayat');
    Route::get('pasien/{id}/kartu', [PasienController::class, 'kartu'])->name('pasien.kartu');
    Route::get('pasien/export/excel', [PasienController::class, 'exportExcel'])->name('pasien.export');

    Route::resource('pegawai', PegawaiController::class);
    Route::resource('poli', PoliController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('tindakan', TindakanController::class);
});

// Home route default Laravel
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// phpinfo
Route::get('/phpinfo', function() {
    phpinfo();
});
