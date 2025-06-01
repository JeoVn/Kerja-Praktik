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
                return redirect()->route('owner.home'); // Redirect ke dashboard owner
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.home'); // Redirect ke dashboard admin
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

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|in:admin,owner',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        // Anda bisa langsung login user jika mau
        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    


}
