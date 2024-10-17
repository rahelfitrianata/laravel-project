<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TelegramAuthController;

Auth::routes();
Route::get('/produks', [ProdukController::class, 'index'])->name('produks.index')->middleware('auth'); // Route untuk Blade Product List

// Middleware Auth
Route::middleware(['auth'])->group(function () {
Route::get('/produks/create', [ProdukController::class, 'create'])->name('produks.create')->middleware('auth'); // Route untuk Blade Add Product di Product List 
Route::get('/produks/{idproduk}', [ProdukController::class, 'show'])->name('produks.show')->middleware('auth');; // Route untuk Blade Show Product List
Route::post('/produks', [ProdukController::class, 'store'])->name('produk.store')->middleware('auth');; // Route untuk menyimpan data produk di Product List
Route::get('/produks/{idproduk}/edit', [ProdukController::class, 'edit'])->name('produks.edit')->middleware('auth'); // Route untuk Blade edit data produk di Product List
Route::put('/produks/{idproduk}', [ProdukController::class, 'update'])->name('produks.update')->middleware('auth');; // Route untuk mengupdate apabila data sudah di edit
Route::delete('/produks/{idproduk}', [ProdukController::class, 'destroy'])->name('produks.destroy')->middleware('auth'); // Route untuk menghapus data produk di Product List
});

Route::get('/login', [ProdukController::class, 'showLoginForm'])->name('login'); // Route untuk menampilkan halaman login
Route::post('/login', [ProdukController::class, 'login']); // Route untuk masuk ke halaman login
Route::get('register', [ProdukController::class, 'showRegistrationForm'])->name('register'); // Route untuk menampilkan form daftar
Route::post('register', [ProdukController::class, 'register']); // Route untuk masuk ke halaman daftar
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Route untuk logout apabila pengguna ingin logout
Route::get('/profile', [ProdukController::class, 'profile'])->name('profile'); // Route untuk masuk ke halaman profil
Route::get('/profile', [ProdukController::class, 'editProfile'])->name('profile'); // Route untuk mengedit profil jika kita mengganti nama/email
Route::post('/profile', [ProdukController::class, 'updateProfile'])->name('profile.update'); // Route untuk mengupdate apabila profil sudah di edit
Route::get('/profile', [ProdukController::class, 'showProfile'])->name('profile'); // Route untuk menampilkan halaman profil
Route::get('/dashboardumum', [ProdukController::class, 'dashboardUmum'])->name('dashboard.umum')->middleware('auth'); // Route untuk menampilkan halaman dashboard umum
Route::get('/pengaturan/metodepembayaran', [ProdukController::class, 'metodePembayaran'])->name('pengaturan.metodepembayaran'); // Route untuk menampilkan halaman metode pembayaran
Route::get('/pengaturan/tentang', [ProdukController::class, 'tentang'])->name('pengaturan.tentang'); // Route untuk menampilkan halaman tentang
Route::get('/pengaturan/profil', [ProdukController::class, 'profil'])->name('pengaturan.profil'); // Route untuk menampilkan halaman profil pengguna
Route::post('/pengaturan/updateProfil', [ProdukController::class, 'updateProfil'])->name('pengaturan.updateProfil'); // Route untuk mengupdate profil yang sudah di edit 
Route::get('/pengaturan/editProfil', [ProdukController::class, 'editProfil'])->name('pengaturan.editProfil'); // Route untuk menampilkan halaman edit profil 
Route::get('/pengaturan', [ProdukController::class, 'pengaturan'])->name('pengaturan.index')->middleware('auth'); // Route untuk menampilkan halaman pengaturan(index)

// Customer Complaints Route
Route::get('/notifikasis', [NotifikasiController::class, 'index'])->name('notifikasis.index')->middleware('auth'); 
Route::post('/notifikasis/kirim', [NotifikasiController::class, 'kirim'])->name('notifikasis.kirim'); 
Route::get('/notifikasi/{id}/edit', [NotifikasiController::class, 'edit'])->name('notifikasi.edit'); 
Route::put('/notifikasi/{id}', [NotifikasiController::class, 'update'])->name('notifikasi.update'); 
Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy'); 

// Google Login Route
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('social.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']); 

// Telegram Login Route
Route::get('/login-telegram', [TelegramAuthController::class, 'login'])->name('telegram.login');
Route::get('/telegram-callback', [TelegramAuthController::class, 'callback'])->name('telegram.callback');
Route::post('/auth/login', [TelegramAuthController::class, 'login'])->name('auth.login');
Route::get('auth/telegram/callback', [TelegramAuthController::class, 'handleProviderCallback']);
Route::get('/auth/telegram/confirm-login/{id}', [TelegramAuthController::class, 'confirmLogin']);