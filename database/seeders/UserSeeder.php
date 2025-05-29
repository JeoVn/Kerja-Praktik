<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   public function run()
{
    $email = 'intansanu34@gmail.com';

    // Cek apakah user dengan email ini sudah ada
    if (!User::where('email', $email)->exists()) {
        User::create([
            'name' => 'Owner Asli',
            'email' => $email,
            'password' => bcrypt('ayambebek'),
            'role' => 'owner',
        ]);
    }
}

}

    

