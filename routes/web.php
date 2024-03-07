<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\DashboardController;
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

Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
Route::get('/home', function () {
    return view('index');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/staff', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/generate-excel', [PemesananController::class, 'generateExcel'])->name('generate-excel');


    Route::middleware(['userAkses:approver'])->group(function () {
        Route::get('/dashboard/persetujuan', [ApproverController::class, 'index'])->name('status-pemesanan.index');
        Route::post('/persetujuan/{id}', [ApproverController::class, 'setuju'])->name('setuju');
        Route::post('/tolak/{id}', [ApproverController::class, 'tolak'])->name('tolak');

        Route::get('/dashboard/riwayat', [ActivityLogController::class, 'index'])->name('activity-log.index');
        Route::delete('/clear-activity-log', [ActivityLogController::class, 'clearActivityLog'])->name('clear-activity-log');
    });

    Route::middleware(['userAkses:admin'])->group(function () {
        Route::get('/dashboard/followup', [AdminController::class, 'index'])->name('status-pemesanan.index');
        Route::post('/follow-up/{id}', [AdminController::class, 'followUp'])->name('follow-up');
        Route::post('/tolak/{id}', [AdminController::class, 'tolak'])->name('tolak');

        Route::prefix('dashboard')->group(function () {
            Route::resource('kendaraan', KendaraanController::class);
            Route::resource('akun', AkunController::class);
        });
    });

    Route::middleware(['userAkses:admin,approver'])->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::resource('pemesanan', PemesananController::class);
        });
    });

    Route::middleware(['userAkses:admin,karyawan'])->group(function () {
        Route::get('/dashboard/pengajuan', [KaryawanController::class, 'create'])->name('prosespengajuan.create');
        Route::post('/dashboard/pengajuan', [KaryawanController::class, 'store'])->name('prosespengajuan.store');
    });

    Route::middleware(['userAkses:karyawan'])->group(function () {
        Route::get('/dashboard/status', [KaryawanController::class, 'index'])->name('prosespengajuan.index');
    });
});
