<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
 
        public function __construct()
    {
            $this->middleware('auth'); // Memastikan hanya pengguna yang sudah login yang bisa mengakses
            $this->middleware('role:owner'); // Memastikan hanya pengguna dengan role "owner" yang bisa mengakses
    }
    
        /**
         * Menampilkan form register untuk admin
         */
        public function showRegistrationForm()
    {
            return view('auth.register');
    }

        /**
         * Proses pendaftaran untuk admin
         */
        public function register(Request $request)
    {
        // Validasi input termasuk role
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,owner', // Tambahan validasi role di sini
        ]);

        // Membuat akun sesuai role yang dipilih
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
