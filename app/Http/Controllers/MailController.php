<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class MailController extends Controller
{
    // Metode untuk mengirim email verifikasi
    public function sendTestEmail()
    {
        // Ganti dengan email yang valid
        $email = 'recipient@example.com'; 

        // Kirim email dengan parameter email yang diteruskan ke VerifyEmail
        Mail::to($email)->send(new VerifyEmail($email));

        return 'Test email sent!';
    }
}
