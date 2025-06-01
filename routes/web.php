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
Route::middleware(['auth', 'role:owner'])->get('/owner/home', [OwnerController::class, 'index'])->name('owner.home');
Route::middleware(['auth', 'role:admin'])->get('/admin/home', [AdminController::class, 'index'])->name('admin.home');

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

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [MedicineController::class, 'homeAdmin'])->name('admin.home');
    Route::get('/medicines/expiring', [MedicineController::class, 'expiringSoon'])->name('medicines.expiring');
    Route::get('/medicines/sedikit-stok', [MedicineController::class, 'sedikitStok'])->name('medicines.sedikitstok');  
    Route::get('/create', [MedicineController::class, 'create'])->name('admin.medicines.create');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.update');
    Route::delete('/admin/{id}', [AuthController::class, 'deleteAdmin'])->name('admin.delete')->middleware('role:owner');
});



Route::get('/homeuser', [MedicineController::class, 'publicIndex'])->name('user.home');
Route::get('/homeuser/{id}', [MedicineController::class, 'publicShow'])->name('user.detail');


