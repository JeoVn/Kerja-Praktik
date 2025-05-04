<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function postLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Ambil data email dan password dari request
        $credentials = $request->only('email', 'password');

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Cek role pengguna setelah login
            $user = Auth::user(); // Mengambil user yang sedang login

            // Menambahkan pesan sukses untuk login
            session()->flash('success', 'Login successful!');

            // Redirect berdasarkan role
            if ($user->role === 'owner') {
                return redirect()->route('owner.dashboard'); // Redirect ke dashboard owner
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect ke dashboard admin
            }

            // Default redirection jika role tidak ditemukan
            return redirect()->route('login')->withErrors(['role' => 'Invalid user role']);
        }

        // Jika login gagal
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout
    public function logout()
    {
        Auth::logout(); // Logout user
        session()->flash('success', 'You have successfully logged out.'); // Pesan sukses logout
        return redirect()->route('login'); // Redirect ke form login
    }
}
