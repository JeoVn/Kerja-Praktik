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
        $medicines = Medicine::selectRaw('MAX(id) as id, kode_obat, nama_obat, harga, gambar, SUM(jumlah) as jumlah')
      ->groupBy('kode_obat', 'nama_obat', 'harga', 'gambar')
      ->orderBy('nama_obat')
      ->get();

        return view('owner.home', compact('medicines'));
    }
}
