<?php

use App\Http\Controllers\CashoutController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataTamuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKamarController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\CashinController;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


//Middleware Akun Admin
Route::middleware(['auth','role:resepsionis'])->group(function(){

    // Management Data Tamu
Route::get('/data-tamu', [DataTamuController::class, 'index'])->name('data-tamu.index');
Route::get('api/data-tamu/', [DataTamuController::class,'indexjson'])->name('data-tamu.json');
Route::get('/data-tamu/create', [DataTamuController::class, 'create'])->name('data-tamu.create');
Route::post('/data-tamu', [DataTamuController::class, 'store'])->name('data-tamu.store');
Route::get('/data-tamu/{id}/edit', [DataTamuController::class, 'edit'])->name('data-tamu.edit');
Route::put('/data-tamu/{id}', [DataTamuController::class, 'update'])->name('data-tamu.update');
Route::delete('/data-tamu/{id}', [DataTamuController::class, 'destroy'])->name('data-tamu.destroy');

// Management Kamar
Route::get('/kamar', [DataKamarController::class, 'index'])->name('kamar.index');
Route::get('/data-kamar', [DataKamarController::class, 'indexjson'])->name('kamar.json');
Route::get('/kamar/create', [DataKamarController::class, 'create'])->name('kamar.create');
Route::post('/data-kamar', [DataKamarController::class, 'store'])->name('kamar.store');
Route::get('/kamar/{id}/edit', [DataKamarController::class, 'edit'])->name('kamar.edit');
Route::put('/kamar/{id}', [DataKamarController::class, 'update'])->name('kamar.update');
Route::delete('/data-kamar/{id}', [DataKamarController::class, 'destroy'])->name('kamar.destroy');

// Management Pemesanan
Route::get('/pemesanan', [PemesananController::class, 'showIndexView'])->name('order.index');
Route::get('/api/data-pemesanan', [PemesananController::class, 'index'])->name('api.order');
Route::get('/pemesanan/{id}/create', [PemesananController::class, 'create'])->name('order.create');
Route::post('/pemesanan/store', [PemesananController::class,'store'])->name('order.store');
Route::delete('/pemesanan/{id}/delete', [PemesananController::class,'destroy'])->name('order.destroy');
Route::get('/orders/{id}/edit', [PemesananController::class, 'edit'])->name('order.edit');
Route::put('/orders/{id}', [PemesananController::class, 'update'])->name('order.update');

// Management Pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'showIndexView'])->name('payment.index');
Route::get('/api/payments', [PembayaranController::class, 'index']);
Route::get('/pembayaran/{id}/create', [PembayaranController::class, 'create'])->name('payment.create');
Route::post('/pembayaran/{id}', [PembayaranController::class, 'store'])->name('payment.store');
Route::get('/payment/{id}/show', [PembayaranController::class, 'show'])->name('payment.show');
route::delete('api/payment/{id}', [PembayaranController::class, 'destroy'])->name('payment.destroy');
Route::get('/generate-invoice', [PembayaranController::class, 'createInvoice'])->name('payment.print');
Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('payment.edit');
Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('payment.update');

});

Route::middleware(['auth','role:owner'])->group(function () {

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/create', [UserController::class,'create'])->name('user.create');
Route::post('/user/store', [UserController::class,'store'])->name('user.store');
route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
route::delete('/user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/pembayaran', [PembayaranController::class, 'showIndexView'])->name('payment.index');
Route::get('/pemesanan', [PemesananController::class, 'showIndexView'])->name('order.index');
Route::get('/kamar', [DataKamarController::class, 'index'])->name('kamar.index');


Route::get('/laporan-pemasukan', [CashinController::class, 'index'])->name('cashin.index');
Route::get('/report/{id}', [CashoutController::class,'report'])->name('report.show');
Route::get('/pengeluaran', [CashoutController::class,'index'])->name('cashout.index');
Route::get('/data-tamu', [DataTamuController::class, 'index'])->name('data-tamu.index');
Route::get('/cashout/{id}/show', [CashoutController::class, 'show'])->name('cashout.show');
Route::get('/pengeluaran', [CashoutController::class,'index'])->name('cashout.index');

});

Route::middleware(['auth','role:bendahara'])->group(function () {
    Route::get('/pengeluaran', [CashoutController::class,'index'])->name('cashout.index');
    Route::get('/cashout/{id}/edit', [CashoutController::class, 'edit'])->name('cashout.edit');
    Route::put('/cashout/{id}', [CashoutController::class, 'update'])->name('cashout.update');

    Route::get('/cashout/{id}/show', [CashoutController::class, 'show'])->name('cashout.show');
    route::get('/pengeluaran/create', [CashoutController::class, 'create'])->name('cashout.create');
    Route::post('/pengeluaran/store', [CashoutController::class,'store'])->name('cashout.store');
    Route::delete('/cashout/{id}/delete', [CashoutController::class, 'destroy'])->name('cashout.destroy');



    Route::get('/laporan-pemasukan', [CashinController::class, 'index'])->name('cashin.index');
    Route::get('/report/{id}', [CashoutController::class,'report'])->name('report.show');


});

Route::middleware(['auth']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//  Route Untuk Tamu
// Route::get('/data-tamu', [DataTamuController::class, 'index'])->name('data-tamu.index');
// Route::get('api/data-tamu/', [DataTamuController::class,'indexjson'])->name('data-tamu.json');
// Route::get('/data-tamu/create', [DataTamuController::class, 'create'])->name('data-tamu.create');
// Route::post('/data-tamu', [DataTamuController::class, 'store'])->name('data-tamu.store');
// Route::get('/data-tamu/{id}/edit', [DataTamuController::class, 'edit'])->name('data-tamu.edit');
// Route::put('/data-tamu/{id}', [DataTamuController::class, 'update'])->name('data-tamu.update');
// Route::delete('/data-tamu/{id}', [DataTamuController::class, 'destroy'])->name('data-tamu.destroy');


// Route Untuk Room
// Route::get('/kamar', [DataKamarController::class, 'index'])->name('kamar.index');
// Route::get('/data-kamar', [DataKamarController::class, 'indexjson'])->name('kamar.json');
// Route::get('/kamar/create', [DataKamarController::class, 'create'])->name('kamar.create');
// Route::post('/data-kamar', [DataKamarController::class, 'store'])->name('kamar.store');
// Route::get('/kamar/{id}/edit', [DataKamarController::class, 'edit'])->name('kamar.edit');
// Route::put('/kamar/{id}', [DataKamarController::class, 'update'])->name('kamar.update');
// Route::delete('/data-kamar/{id}', [DataKamarController::class, 'destroy'])->name('kamar.destroy');



//Route Untuk Cashout
// Route::get('/pengeluaran', [CashoutController::class,'index'])->name('cashout.index');
// Route::get('/cashout/{id}/edit', [CashoutController::class, 'edit'])->name('cashout.edit');
// Route::put('/cashout/{id}', [CashoutController::class, 'update'])->name('cashout.update');

// Route::get('/cashout/{id}/show', [CashoutController::class, 'show'])->name('cashout.show');
// route::get('/pengeluaran/create', [CashoutController::class, 'create'])->name('cashout.create');
// Route::post('/pengeluaran/store', [CashoutController::class,'store'])->name('cashout.store');
// Route::delete('/cashout/{id}/delete', [CashoutController::class, 'destroy'])->name('cashout.destroy');


//route untuk pemesanan
// Route::get('/pemesanan', [PemesananController::class, 'showIndexView'])->name('order.index');
// Route::get('/api/data-pemesanan', [PemesananController::class, 'index'])->name('api.order');
// Route::get('/pemesanan/{id}/create', [PemesananController::class, 'create'])->name('order.create');
// Route::post('/pemesanan/store', [PemesananController::class,'store'])->name('order.store');
// Route::delete('/pemesanan/{id}/delete', [PemesananController::class,'destroy'])->name('order.destroy');
// Route::get('/orders/{id}/edit', [PemesananController::class, 'edit'])->name('order.edit');
// Route::put('/orders/{id}', [PemesananController::class, 'update'])->name('order.update');


//route untuk pembayaran
// Route::get('/pembayaran', [PembayaranController::class, 'showIndexView'])->name('payment.index');
// Route::get('/api/payments', [PembayaranController::class, 'index']);

// Route::get('/pembayaran/{id}/create', [PembayaranController::class, 'create'])->name('payment.create');
// Route::post('/pembayaran/{id}', [PembayaranController::class, 'store'])->name('payment.store');
// Route::get('/payment/{id}/show', [PembayaranController::class, 'show'])->name('payment.show');
// route::delete('api/payment/{id}', [PembayaranController::class, 'destroy'])->name('payment.destroy');
// Route::get('/generate-invoice', [PembayaranController::class, 'createInvoice'])->name('payment.print');
// Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('payment.edit');
// Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('payment.update');



Route::get('/laporan-pemasukan', [CashinController::class, 'index'])->name('cashin.index');
Route::get('/report/{id}', [CashoutController::class,'report'])->name('report.show');



// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/user/create', [UserController::class,'create'])->name('user.create');
// Route::post('/user/store', [UserController::class,'store'])->name('user.store');
// route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
// route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
// route::delete('/user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::get('/user', [UserController::class, 'index'])->name('user');


}
);

require __DIR__.'/auth.php';
