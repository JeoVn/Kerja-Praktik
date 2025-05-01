<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class RegisterController extends Controller
{
    // Menampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses pendaftaran// RegisterController.php
        public function register(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,owner',
        ]);

        // Menyimpan pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => null, // Tidak langsung terverifikasi
        ]);

        // Log untuk memeriksa email yang dikirim
        \Log::info('Sending email to: ' . $user->email);

        try {
            // Kirim email verifikasi
            Mail::to($user->email)->send(new VerifyEmail($user->email));
            \Log::info('Verification email sent to: ' . $user->email);
        } catch (\Exception $e) {
            \Log::error('Error sending verification email: ' . $e->getMessage());
        }

        return redirect()->route('login')->with('success', 'Please verify your email address.');
    }


    
    
    public function verifyEmail($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->email_verified_at = now();  // Tandai email sebagai terverifikasi
            $user->save();

            return redirect()->route('login')->with('success', 'Your email has been verified!');
    }

    return redirect()->route('login')->with('error', 'Invalid verification link.');
}


}
