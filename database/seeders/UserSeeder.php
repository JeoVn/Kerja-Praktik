<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Owner Asli',
            'email' => 'intansanu34@gmail.com',
            'password' => bcrypt('ayambebek'),
            'role' => 'owner',
        ]);
        $this->call(UserSeeder::class);
    }
    
}
