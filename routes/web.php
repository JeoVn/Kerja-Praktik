<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Mail\VerifyEmail;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('landing'); // menampilkan resources/views/landing.blade.php
});

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk pendaftaran owner pertama kali (hanya bisa diakses jika belum ada owner)
Route::get('/register/first-owner', [RegisterController::class, 'showFirstOwnerRegistrationForm'])->name('register.first-owner');
Route::post('/register/first-owner', [RegisterController::class, 'registerFirstOwner'])->name('register.first-owner.submit');

// Route untuk proses login
Route::post('/login', [AuthController::class, 'postLogin']);

// Route untuk pendaftaran akun admin (setelah owner terdaftar)
// Route::middleware(['auth', 'role:owner'])->group(function () {
//     Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//     Route::post('/register', [RegisterController::class, 'register']);
// });

// Route untuk pendaftaran akun admin (setelah owner terdaftar)
Route::middleware(['auth', 'role:owner'])->get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::middleware(['auth', 'role:owner'])->post('/register', [RegisterController::class, 'register']);

// Route untuk email verifikasi (dapat diakses setelah pendaftaran)
Route::get('/email/verify/{email}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

// Route untuk logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk dashboard owner, hanya bisa diakses oleh owner
Route::middleware(['auth', 'role:owner'])->get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');

// Route untuk dashboard admin, hanya bisa diakses oleh admin
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

use App\Http\Controllers\MedicineController;
Route::resource('medicines', MedicineController::class);

Route::get('/admin/dashboard', [MedicineController::class, 'dashboard'])->name('admin.dashboard');
