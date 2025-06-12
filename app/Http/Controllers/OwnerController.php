<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Models\Medicine; 
use App\Models\Purchase;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('role:owner');  // Pastikan hanya owner yang bisa akses
    }

   public function index(Request $request) 
{
    $query = Medicine::query();

    // Jika ada parameter pencarian nama obat
    if ($request->filled('search')) {
        $query->where('nama_obat', 'like', '%' . $request->search . '%');
    }

    // Gabungkan stok berdasarkan kode_obat
    $medicines = $query->selectRaw('MAX(id) as id, kode_obat, nama_obat, harga, gambar, SUM(jumlah) as jumlah')
        ->groupBy('kode_obat', 'nama_obat', 'harga', 'gambar')
        ->orderBy('nama_obat')
        ->get();

    return view('owner.home', compact('medicines'));
}
  public function transaksi()
  {
      $purchases = Purchase::with('admin')->orderBy('created_at', 'desc')->get();
      return view('owner.transaksi', compact('purchases'));
  }
  
public function purchaseFilter(Request $request)
{
    $query = Purchase::query();

    if ($request->filled('admin')) {
        $query->where('admin_id', $request->admin);
    }

    $purchases = $query->orderBy('created_at', 'desc')->get();
    
    // Ambil semua admin
    $admins = User::where('role', 'admin')->get();

    return view('owner.transaksi', compact('purchases', 'admins'));
}


}
