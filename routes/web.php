<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServisController;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->prefix('petugas')->group(function () {
    Route::get('/dashboard', fn () => view('petugas.dashboard'))->name('dashboard');
    Route::get('/servis', [ServisController::class, 'index'])->name('servis.index');
    Route::get('/servis/baru', [ServisController::class, 'create'])->name('servis.create');
    Route::post('/servis', [ServisController::class, 'store'])->name('servis.store');
    Route::get('/servis/{servis}', [ServisController::class, 'show'])->name('servis.show');
    Route::put('/servis/{servis}', [ServisController::class, 'update'])->name('servis.update');
});