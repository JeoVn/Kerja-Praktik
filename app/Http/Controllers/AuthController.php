<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }
public function postLogin(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Ambil user berdasarkan email
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar.']);
    }

    // Cek status aktif jika role-nya admin
    if ($user->role === 'admin' && !$user->is_active) {
        return redirect()->back()->withErrors(['email' => 'Akun admin Anda telah dinonaktifkan.']);
    }

    // Cek kredensial
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        session()->flash('success', 'Login berhasil!');
        $user = Auth::user();

//         if ($user->role === 'owner') {
//             return redirect()->route('owner.home');
//         } elseif ($user->role === 'admin') {
//             return redirect()->route('admin.home');
//         }

//         Auth::logout();
//         return redirect()->route('login')->withErrors(['role' => 'Role pengguna tidak dikenali.']);
//     }

//     return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
// }
return match($user->role) {
                'owner' => redirect()->route('owner.home'),
                'admin' => redirect()->route('admin.home'),
                default => tap(Auth::logout(), function () {
                    session()->flash('error', 'Role pengguna tidak dikenali.');
                }) && redirect()->route('login'),
            };
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
    }
    public function logout()
    {
        Auth::logout(); // Logout user
        session()->flash('success', 'Berhasil keluar dari akun anda.'); // Pesan sukses logout
        return redirect()->route('login'); // Redirect ke form login
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required|string|confirmed|min:6',
                'regex:/[a-z]/',      // huruf kecil
                'regex:/[A-Z]/',      // huruf besar
                'regex:/[0-9]/'       // angka
            ],
            'role' => 'required|in:admin,owner',
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka.',
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
    
    public function profile()
    {
        $user = Auth::user();
        $admins = collect();

        if ($user->role === 'owner') {
            $admins = User::where('role', 'admin')->get();
        }

        return view('profile', compact('user', 'admins'));
    }

    public function showChangePasswordForm()
    {
        return view('change_password');
    }

    public function changePassword(Request $request)
    {
        // $request->validate([
        //     'current_password' => 'required',
        //     'new_password' => 'required|min:6|confirmed',
        // ]);
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required', 'confirmed', 'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/'
            ]
        ], [
            'new_password.regex' => 'Password baru harus mengandung huruf besar, huruf kecil, dan angka.'
        ]);
        
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }

public function toggleAdminStatus($id)
{
    $user = Auth::user();

    if ($user->role !== 'owner') {
        return redirect()->route('profile')->with('error', 'Akses ditolak');
    }

    $admin = User::where('id', $id)->where('role', 'admin')->first();

    if (!$admin) {
        return redirect()->route('profile')->with('error', 'Admin tidak ditemukan.');
    }

    $admin->is_active = !$admin->is_active;
    $admin->save();

    return redirect()->route('profile')->with('success', 'Status admin berhasil diperbarui.');
}




}
