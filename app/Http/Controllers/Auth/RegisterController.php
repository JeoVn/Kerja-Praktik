<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan form register untuk owner pertama kali
     */
    public function showFirstOwnerRegistrationForm()
    {
        // Cek apakah sudah ada akun owner
        $ownerExists = User::where('role', 'owner')->exists();

        if ($ownerExists) {
            // Jika sudah ada akun owner, arahkan ke halaman login dengan pesan error
            return redirect()->route('login')->with('error', 'Akun owner sudah ada, silakan login.');
        }

        // Jika belum ada akun owner, tampilkan form register untuk owner pertama kali
        return view('auth.register-first-owner');
    }

    /**
     * Proses pendaftaran owner pertama kali
     */
    public function registerFirstOwner(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat akun owner pertama kali
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'owner',
            'email_verified_at' => now(), // Langsung terverifikasi
        ]);

        // Setelah akun owner berhasil dibuat, arahkan ke halaman login
        return redirect()->route('login')->with('success', 'Akun owner pertama telah dibuat. Silakan login.');
    }

        /**s
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
