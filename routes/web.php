<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('landing');
});

// Login & Register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::middleware(['auth', 'role:owner'])->get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::middleware(['auth', 'role:owner'])->post('/register', [RegisterController::class, 'register']);
Route::get('/register/first-owner', [RegisterController::class, 'showFirstOwnerRegistrationForm'])->name('register.first-owner');
Route::post('/register/first-owner', [RegisterController::class, 'registerFirstOwner'])->name('register.first-owner.submit');
Route::get('/email/verify/{email}', [RegisterController::class, 'verifyEmail'])->name('verify.email');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Owner & Admin
Route::middleware(['auth', 'role:owner'])->get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Medicines Resource (CRUD)
Route::resource('medicines', MedicineController::class);

// Admin dashboard khusus (jika ingin dashboard khusus dari MedicineController)
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [MedicineController::class, 'dashboard'])->name('admin.dashboard');

// Form create obat khusus admin (opsional, jika ingin path berbeda)
Route::middleware(['auth', 'role:admin'])->get('/admin/create', [MedicineController::class, 'create'])->name('admin.medicines.create');

// Dashboard untuk user biasa
Route::get('/dashboarduser', [MedicineController::class, 'index'])->name('dashboarduser');

// Detail obat untuk user
Route::get('/detailuser/{medicine}', [MedicineController::class, 'detailuser'])->name('detailuser.show');
Route::middleware(['auth', 'role:admin'])->get('/admin/detail/{medicine}', [MedicineController::class, 'show'])->name('admin.detail');

Route::get('/medicines/expiring', [MedicineController::class, 'expiringSoon'])->name('medicines.expiring');
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [MedicineController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/medicines/expiring', [MedicineController::class, 'expiringSoon'])->name('medicines.expiring');
    Route::get('/create', [MedicineController::class, 'create'])->name('admin.medicines.create');

});
