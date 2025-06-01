<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:owner');  // Pastikan hanya owner yang bisa akses
    }

    public function index()
    {
        return view('owner.home');  // Halaman dashboard owner
    }

    // public function profile()
    // {
    //     $user = Auth::user();

    //     $admins = collect();

    //     if ($user->role === 'owner') {
    //         $admins = User::where('role', 'admin')->get();
    //     }

    //     return view('profile', compact('admins', 'user'));
    // }
    public function profile()
    {
        $user = Auth::user();
        $admins = collect();

        if ($user->role === 'owner') {
            $admins = User::where('role', 'admin')->get();
        }

        return view('profile', compact('admins', 'user'));
    }


    public function showChangePasswordForm()
    {
        return view('change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
    public function deleteAdmin($id)
    {
        $admin = User::where('id', $id)->where('role', 'admin')->first();

        if (!$admin) {
            return redirect()->route('profile')->with('error', 'Admin tidak ditemukan.');
        }

        $admin->delete();

        return redirect()->route('profile')->with('success', 'Admin berhasil dihapus.');
    }

}
