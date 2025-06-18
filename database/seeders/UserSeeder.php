<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
       User::updateOrCreate(
    ['email' => 'intansanu34@gmail.com'], // ← Cek berdasarkan email
    [
        'name' => 'Owner Asli',
        'password' => Hash::make('ayambebek'),
        'role' => 'owner',
    ]
);


}
}

    

