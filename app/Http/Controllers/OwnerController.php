<?php

// app/Http/Controllers/OwnerController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct()
{
    $this->middleware('role:owner');  // Pastikan hanya owner yang bisa akses
}
    public function index()
    {
        return view('owner.dashboard');  // Halaman dashboard owner
    }
}
