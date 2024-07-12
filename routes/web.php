<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataTamuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKamarController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::get('/data-tamu', [DataTamuController::class, 'index'])->name('data-tamu.index');
Route::get('/data-tamu/create', [DataTamuController::class, 'create'])->name('data-tamu.create');
Route::post('/data-tamu', [DataTamuController::class, 'store'])->name('data-tamu.store');
Route::get('/data-tamu/{id}/edit', [DataTamuController::class, 'edit'])->name('data-tamu.edit');
Route::put('/data-tamu/{id}', [DataTamuController::class, 'update'])->name('data-tamu.update');
Route::delete('/data-tamu/{id}', [DataTamuController::class, 'destroy'])->name('data-tamu.destroy');

Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan');
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
Route::get('/data-kamar', [DataKamarController::class, 'index'])->name('data-kamar');
Route::get('/laporan-pemasukan', [LaporanController::class, 'keluar'])->name('laporan-pemasukan');
Route::get('/laporan-pengeluaran', [LaporanController::class, 'masuk'])->name('laporan-pengeluaran');
Route::get('/user', [UserController::class, 'index'])->name('user');
});

require __DIR__.'/auth.php';
