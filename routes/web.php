<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Mail\VerifyEmail;
use App\Http\Controllers\MailController;

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/test-email', function () {
    $details = [
        'url' => 'http://localhost:8000/email/verify/test@example.com',
        'name' => 'Test User'
    ];

    Mail::to('test@example.com')->send(new VerifyEmail($details));

    return 'Email telah dikirim ke Mailpit. Silakan cek http://localhost:8025';
});
// Route untuk proses login
Route::post('/login', [AuthController::class, 'postLogin']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//Route::get('/send-test-email', [MailController::class, 'sendTestEmail']);

//Route::get('/email/verify/{email}', [VerificationController::class, 'verifyEmail'])->name('verify.email');
Route::get('/email/verify/{email}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

// Logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// routes/web.php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;

Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
