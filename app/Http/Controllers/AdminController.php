<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\JenisPenyakit;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');  // Halaman dashboard admin
    }
    // public function homeAdmin(Request $request)
    // {
    //     $query = Medicine::query();

    //     // Filter berdasarkan jenis obat
    //     if ($request->filled('jenis_obat')) {
    //         $query->whereIn('jenis_obat', $request->jenis_obat);
    //     }

    //     // Filter berdasarkan bentuk obat
    //     if ($request->filled('bentuk_obat')) {
    //         $query->where('bentuk_obat', $request->bentuk_obat);
    //     }

    //     // Filter berdasarkan jenis penyakit jika relasi tersedia
    //     if ($request->filled('penyakit')) {
    //         $query->whereHas('jenisPenyakit', function ($q) use ($request) {
    //             $q->whereIn('id', $request->penyakit);
    //         });
    //     }

    //     // Ambil hanya satu per kode_obat, dengan jumlah total stok dijumlahkan
    //     $medicines = $query->selectRaw('MAX(id) as id, kode_obat, nama_obat, harga, gambar, jenis_obat, bentuk_obat, SUM(jumlah) as jumlah')
    //         ->groupBy('kode_obat', 'nama_obat', 'harga', 'gambar', 'jenis_obat', 'bentuk_obat')
    //         ->orderBy('nama_obat')
    //         ->get();

    //     // Ambil filter untuk form
    //     $jenisObat = Medicine::select('jenis_obat')->distinct()->pluck('jenis_obat');
    //     $bentukObat = Medicine::select('bentuk_obat')->distinct()->pluck('bentuk_obat');
    //     $penyakit = JenisPenyakit::all();

    //     return view('admin.home', compact('medicines', 'jenisObat', 'bentukObat', 'penyakit'));
    // }
}
