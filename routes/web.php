<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException; 
use App\Http\Controllers\Auth\ResetPasswordController; 
use App\Http\Controllers\Auth\ForgotPasswordController;

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
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('guest')->group(function () {
    // Tampilkan form minta link reset
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    // Kirim email reset password
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Form reset password dari email
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    // Proses reset password
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.reset.update');
});

// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.request');

// // Kirim link reset password ke email
// Route::post('/forgot-password', function (Request $request) {
//     $request->validate(['email' => 'required|email']);

//     $status = Password::sendResetLink(
//         $request->only('email')
//     );

//     return $status === Password::RESET_LINK_SENT
//         ? back()->with('status', __($status))
//         : back()->withErrors(['email' => __($status)]);
// })->middleware('guest')->name('password.email');

// // Form ubah password dari link email
// Route::get('/reset-password/{token}', function (string $token) {
//     return view('auth.reset-password', [
//         'token' => $token,
//         'email' => request('email')
//     ]);
// })->middleware('guest')->name('password.reset');

// // Proses reset password dari email
// Route::post('/reset-password', function (Request $request) {
//     Log::info('🔥 Request Reset Password Masuk:', $request->all());

//     $request->validate([
//         'token' => 'required',
//         'email' => 'required|email',
//         'password' => [
//             'required',
//             'string',
//             'min:8',
//             'confirmed',
//             'regex:/[a-z]/',      // huruf kecil
//             'regex:/[A-Z]/',      // huruf besar
//             'regex:/[0-9]/',      // angka
//         ],
//     ], [
//         'password.required' => 'Password wajib diisi.',
//         'password.min' => 'Password minimal 8 karakter.',
//         'password.confirmed' => 'Konfirmasi password tidak cocok.',
//         'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka.',
//     ]);

//     $status = Password::reset(
//         $request->only('email', 'password', 'password_confirmation', 'token'),
//         function ($user, $password) {
//             if (Hash::check($password, $user->password)) {
//                 throw ValidationException::withMessages([
//                     'password' => 'Password baru tidak boleh sama dengan password lama.',
//                 ]);
//             }

//             $user->forceFill([
//                 'password' => Hash::make($password),
//             ])->save();

//             event(new \Illuminate\Auth\Events\PasswordReset($user));
//         }
//     );

//     if ($status === Password::PASSWORD_RESET) {
//         return redirect()->route('login')->with('status', __($status));
//     } else {
//         return back()->withInput($request->only('email'))
//                      ->withErrors(['email' => __($status)]);
//     }
// })->middleware('guest')->name('password.reset.update');

Route::middleware(['auth', 'role:admin'])->get('/admin/home', [AdminController::class, 'index'])->name('admin.home');

// Medicines Resource (CRUD)
Route::resource('medicines', MedicineController::class);


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [MedicineController::class, 'homeAdmin'])->name('admin.home');
    Route::get('/detail{medicine}',  [MedicineController::class, 'show'])->name('admin.detail');
    Route::get('/medicines/expiring', [MedicineController::class, 'expiringSoon'])->name('medicines.expiring');
    Route::get('/medicines/sedikit-stok', [MedicineController::class, 'sedikitStok'])->name('medicines.sedikitstok');  
    Route::get('/create', [MedicineController::class, 'create'])->name('admin.medicines.create');
    Route::post('medicines/record-purchase', [MedicineController::class, 'recordPurchase'])->name('medicines.recordPurchase');
    Route::put('medicines/{id}/update-stock-beli', [MedicineController::class, 'updateStockBeli'])->name('medicines.updateStockBeli');

 
    // Route for updating stock
    Route::put('medicines/{id}/update-stock', [MedicineController::class, 'updateStock'])->name('medicines.updateStock');

    // Show the form for recording a purchase
    // Menampilkan formulir pembelian
    Route::get('/medicines/purchase', [MedicineController::class, 'purchaseCreate'])->name('medicines.purchase');

    // Menyimpan pembelian dan memperbarui stok
    Route::post('/medicines/purchase', [MedicineController::class, 'purchaseStore'])->name('medicines.purchase.store');
    // Route to search for a medicine by its code or name
    // Route::get('/medicines/search-medicine/{search_term}', [MedicineController::class, 'searchMedicine'])->name('medicines.search');

  // Route untuk mencari obat berdasarkan kode atau nama
    Route::get('/medicines/search-medicine/{search_term}', [MedicineController::class, 'searchMedicine'])->name('medicines.search');
    Route::get('/medicines/get-medicine-batches/{kodeObat}', [MedicineController::class, 'getMedicineBatches']);

    Route::get('/medicines/add-stock', [MedicineController::class, 'addObatCreate'])->name('medicines.addStock');

    // Rute untuk menyimpan stok yang ditambahkan
    Route::get('/medicines/get-medicine-batches-stock/{kodeObat}', [MedicineController::class, 'getMedicineBatchesStock']);

    Route::post('/medicines/add-stock', [MedicineController::class, 'addObatStore'])->name('medicines.addStock.store');

    Route::get('/medicines/edit-by-batch', [MedicineController::class, 'editByBatch'])->name('medicines.editByBatch');


});


Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/home', [OwnerController::class, 'index'])->name('owner.home');
    
    Route::get('/detail{medicine}',  [MedicineController::class, 'show'])->name('owner.admin.detail');

    Route::get('/medicines/expiring', [MedicineController::class, 'expiringSoon'])->name('owner.medicines.expiring');
    Route::get('/medicines/sedikit-stok', [MedicineController::class, 'sedikitStok'])->name('owner.medicines.sedikitstok');  
    Route::get('/create', [MedicineController::class, 'create'])->name('owner.medicines.create');
    
    Route::get('/transaksi', [OwnerController::class, 'transaksi'])->name('owner.transaksi');
    Route::patch('/admin/{id}/toggle-status', [AuthController::class, 'toggleAdminStatus'])->name('admin.toggleStatus');

  

});

// Semua route yang butuh auth dan harus aktif



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.update');
    Route::delete('/admin/{id}/delete', [OwnerController::class, 'deleteAdmin'])->name('admin.delete')->middleware('role:owner');

});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/homeuser', [MedicineController::class, 'publicIndex'])->name('user.home');
Route::get('/homeuser/{id}', [MedicineController::class, 'publicShow'])->name('user.detail');
// Route for user to apply filters and view filtered medicines
Route::get('/homeuser', [MedicineController::class, 'indexHome'])->name('user.homeuser');

