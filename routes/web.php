<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CekStatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServisController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('publik.landing');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/cek-status', [CekStatusController::class, 'index'])
    ->name('cek-status')
    ->middleware('throttle:30,1');

Route::middleware('auth')->prefix('petugas')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/servis', [ServisController::class, 'index'])->name('servis.index');
    Route::get('/servis/baru', [ServisController::class, 'create'])->name('servis.create');
    Route::post('/servis', [ServisController::class, 'store'])->name('servis.store');
    Route::get('/servis/{servis}', [ServisController::class, 'show'])->name('servis.show');
    Route::put('/servis/{servis}', [ServisController::class, 'update'])->name('servis.update');

    Route::middleware(AdminOnly::class)->group(function () {
        Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
        Route::get('/akun/baru', [AkunController::class, 'create'])->name('akun.create');
        Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
        Route::patch('/akun/{user}/status', [AkunController::class, 'status'])->name('akun.status');
    });
});