<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\KategoriArtikelController; 
use App\Http\Controllers\PublikController;

// Route halaman login
Route::get('/login', [LoginController::class, 'index'])
    ->name('login')
    ->middleware('guest'); 
Route::post('/login', [LoginController::class, 'proses'])
    ->name('login.proses')
    ->middleware('guest');

// Route logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Route yang dilindungi middleware auth
Route::middleware('auth')->group(function () { 

    // Route untuk halaman dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route resource untuk ketiga entitas
    Route::resource('artikel', ArtikelController::class)->except(['show']);
    Route::resource('penulis', PenulisController::class)->except(['show']);
    Route::resource('kategori', KategoriArtikelController::class)->except(['show']);
});

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
}); 

// Route halaman publik (tanpa login)
Route::get('/beranda', [PublikController::class, 'index'])->name('publik.index');
Route::get('/beranda/{id}', [PublikController::class, 'show'])->name('publik.show');


?>