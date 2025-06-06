<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Medicine;  // <--- Import model Medicine
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('role:owner');  // Pastikan hanya owner yang bisa akses
    }

    public function index() 
    {
        $medicines = Medicine::all();  // Ambil semua data obat
        return view('owner.home', compact('medicines'));
    }
}
