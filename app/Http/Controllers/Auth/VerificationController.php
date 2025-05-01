<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    public function verify($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->save();

            return redirect()->route('login')->with('status', 'Your email has been verified. You can now login.');
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid verification link.']);
    }
}
