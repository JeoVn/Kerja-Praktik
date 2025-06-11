<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Medicine;
use App\Models\JenisPenyakit;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon; 

// Add this if the Purchase model exists, otherwise create it in app/Models/Purchase.php
use App\Models\Purchase;

class MedicineController extends Controller
{
    public function create()
    {
        $penyakit = JenisPenyakit::all();
        return view('admin.medicines.create', compact('penyakit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kode_obat' => 'required|unique:medicines',
            'nama_obat' => 'required',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
            'tanggal_exp' => 'required|date',
            'bentuk_obat' => 'required',
            'penyakit' => 'required|array',
            'penyakit.*' => 'exists:jenis_penyakit,id',
            'jenis_obat' => 'required',
        ]);

        $data = $request->except('_token', 'penyakit');

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('uploads/obat');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['gambar'] = 'uploads/obat/' . $filename;
        } else {
            $data['gambar'] = null;
        }

        // Simpan ke database
        $medicine = Medicine::create($data);

        // Simpan relasi many-to-many
        $medicine->jenisPenyakit()->sync($request->penyakit);

        return redirect()->route('medicines.create')->with('success', 'Obat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        $penyakit = JenisPenyakit::all();
        $selectedPenyakit = $medicine->jenisPenyakit->pluck('id')->toArray();

        $batchList = Medicine::where('kode_obat', $medicine->kode_obat)->orderBy('batch')->get();

        return view('admin.medicines.edit', compact('medicine', 'penyakit', 'selectedPenyakit', 'batchList'));
    //     return view('admin.medicines.edit', compact('medicine', 'penyakit', 'selectedPenyakit'));
    // }
    }

      public function editByBatch(Request $request)
    {
        $medicine = Medicine::findOrFail($request->batch_id);
        $penyakit = JenisPenyakit::all();
        $selectedPenyakit = $medicine->jenisPenyakit->pluck('id')->toArray();
        $batchList = Medicine::where('kode_obat', $medicine->kode_obat)->get();

        return view('admin.medicines.edit', compact('medicine', 'penyakit', 'selectedPenyakit', 'batchList'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'kode_obat' => 'required|string|max:255',
        'nama_obat' => 'required',
        'harga' => 'required|numeric',
        'jumlah' => 'required|integer',
        'tanggal_exp' => 'required|date',
        'bentuk_obat' => 'required',
        'jenis_obat' => 'required',
        'deskripsi' => 'nullable',
        'jenis_penyakit' => 'required|array',
        'jenis_penyakit.*' => 'exists:jenis_penyakit,id',
    ]);

    $medicine = Medicine::findOrFail($id);
    $data = $request->except('_token', '_method', 'jenis_penyakit');

    // Proses upload gambar jika ada
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($medicine->gambar && file_exists(public_path($medicine->gambar))) {
            @unlink(public_path($medicine->gambar));
        }
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destination = public_path('uploads/obat');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }
        $file->move($destination, $filename);
        $data['gambar'] = 'uploads/obat/' . $filename;
    }

    $medicine->update($data);

    // Update relasi many-to-many jenis penyakit
    $medicine->jenisPenyakit()->sync($request->jenis_penyakit);

return redirect()->route('admin.detail', $medicine->id)->with('success', 'Data obat berhasil diperbarui');
}


    public function homeAdmin()
    {
        $subquery = DB::table('medicines')
            ->select(DB::raw('MAX(id) as id'))
            ->groupBy('kode_obat');

        $medicines = DB::table('medicines')
            ->joinSub($subquery, 'latest', function ($join) {
                $join->on('medicines.id', '=', 'latest.id');
            })
            ->orderBy('nama_obat')
            ->get();

        $jenisObat = Medicine::select('jenis_obat')->distinct()->pluck('jenis_obat');
        $bentukObat = Medicine::select('bentuk_obat')->distinct()->pluck('bentuk_obat');
        $penyakit = JenisPenyakit::all();

        return view('admin.home', compact('medicines', 'jenisObat', 'bentukObat', 'penyakit'));
    }

// public function index(Request $request)
// {
//     $query = Medicine::query();

//     // Filter berdasarkan Jenis Obat (array)
//     if ($request->filled('jenis_obat')) {
//         $query->whereIn('jenis_obat', $request->jenis_obat);
//     }


//     // Filter berdasarkan Bentuk Obat (single select)
//     if ($request->filled('bentuk_obat')) {
//         $query->where('bentuk_obat', $request->bentuk_obat);
//     }

//     // Filter berdasarkan Penyakit (many-to-many)
//     if ($request->filled('penyakit')) {
//         $query->whereHas('jenisPenyakit', function ($q) use ($request) {
//         $q->whereIn('jenis_penyakit.id', $request->penyakit);
//     });
// }


//     // Group berdasarkan kode_obat agar hanya tampil satu entry per kode
//     $medicines = $query->selectRaw('MAX(id) as id, kode_obat, nama_obat, harga, gambar, jenis_obat, bentuk_obat, SUM(jumlah) as jumlah')
//         ->groupBy('kode_obat', 'nama_obat', 'harga', 'gambar', 'jenis_obat', 'bentuk_obat')
//         ->orderBy('nama_obat')
//         ->get();

//     // Ambil data filter (untuk dropdown/checkbox di view)
//     $jenisObat = Medicine::distinct()->pluck('jenis_obat');
//     $bentukObat = Medicine::distinct()->pluck('bentuk_obat');
//     $penyakit = JenisPenyakit::all();

//     return view('admin.home', compact('medicines', 'jenisObat', 'bentukObat', 'penyakit'));
// }
public function index(Request $request)
{
    $query = Medicine::query();

    // Filter jenis obat
    if ($request->filled('jenis_obat')) {
        $query->whereIn('jenis_obat', $request->jenis_obat);
    }

    // Filter jenis penyakit
    if ($request->filled('penyakit')) {
        $query->whereHas('jenisPenyakit', function ($q) use ($request) {
            $q->whereIn('jenis_penyakit.id', $request->penyakit);
        });
    }

    // Filter bentuk obat
    if ($request->filled('bentuk_obat')) {
        $query->whereIn('bentuk_obat', $request->bentuk_obat);
    }

    $medicines = $query->get();

    // Kirim semua filter ke view
    $jenisObat = Medicine::distinct()->pluck('jenis_obat')->filter()->values();
    $bentukObat = Medicine::distinct()->pluck('bentuk_obat')->filter()->values();
    $penyakit = JenisPenyakit::all(); // pastikan model ini ada

    return view('admin.home', compact('medicines', 'jenisObat', 'bentukObat', 'penyakit'));
}

    // public function index(Request $request)
    // {
    //     $query = Medicine::query();

    //     if ($request->filled('jenis_obat')) {
    //         $query->where('jenis_obat', $request->jenis_obat);
    //     }

    //     if ($request->filled('penyakit')) {
    //         $query->whereHas('jenisPenyakit', function ($q) use ($request) {
    //             $q->whereIn('id', $request->penyakit);
    //         });
    //     }

    //     if ($request->filled('bentuk_obat')) {
    //         $query->where('bentuk_obat', $request->bentuk_obat);
    //     }

    //     $medicines = $query->get();

    //     return view('admin.home', [
    //         'medicines' => $medicines,
    //         'jenisObat' => Medicine::select('jenis_obat')->distinct()->pluck('jenis_obat'),
    //         'bentukObat' => Medicine::select('bentuk_obat')->distinct()->pluck('bentuk_obat'),
    //         'penyakit' => JenisPenyakit::all(),
    //     ]);
    // }
    public function show($id)
    {
        $medicine = Medicine::findOrFail($id);

           // Ambil semua batch dengan kode obat yang sama
        $batches = Medicine::where('kode_obat', $medicine->kode_obat)->orderBy('tanggal_exp')->get();
        $totalJumlah = $batches->sum('jumlah');

    return view('admin.detail', compact('medicine', 'batches', 'totalJumlah'));
        // return view('admin.detail', compact('medicine'));
    }


    public function showuser($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('detailuser', compact('medicine'));
    }
    public function expiringSoon()
    {
        $today = Carbon::today();
        $sixMonthsLater = $today->copy()->addMonths(6);

        $medicines = Medicine::whereDate('tanggal_exp', '>=', $today)
                            ->whereDate('tanggal_exp', '<=', $sixMonthsLater)
                            ->orderBy('tanggal_exp')
                            ->get();

        return view('admin.expiring', compact('medicines'));
    }

        public function sedikitStok()
    {
        $lowStockMedicines = Medicine::where('jumlah', '<', 20)->orderBy('jumlah')->get();

        return view('admin.sedikit_stok', compact('lowStockMedicines'));
    }

   // Tampilkan list obat untuk user biasa (public)
//    public function publicIndex(Request $request)
//     {
//         $query = Medicine::query();

//         if ($request->filled('jenis_obat')) {
//             $query->whereIn('jenis_obat', $request->jenis_obat);
//         }
//         if ($request->filled('sakit')) {
//             // Sesuaikan filter sakit jika ada relasi, atau hapus jika belum ada
//         }
//         if ($request->filled('bentuk_obat')) {
//             $query->whereIn('bentuk_obat', $request->bentuk_obat);
//         }

//         $medicines = $query->get();

//         return view('user.homeuser', compact('medicines'));
//     }
public function publicIndex(Request $request)
{
    $query = Medicine::query();

    // Filter berdasarkan jenis obat
    if ($request->filled('jenis_obat')) {
        $query->whereIn('jenis_obat', $request->jenis_obat);
    }

    // Filter berdasarkan bentuk obat
    if ($request->filled('bentuk_obat')) {
        $query->whereIn('bentuk_obat', $request->bentuk_obat);
    }

    // Catatan: Filter sakit belum digunakan, bisa ditambahkan jika relasi tersedia

    // Ambil data grup per kode_obat dan hitung total jumlah
$medicines = $query->selectRaw('MAX(id) as id, kode_obat, nama_obat, harga, gambar, jenis_obat, bentuk_obat, SUM(jumlah) as total_jumlah')
    ->groupBy('kode_obat', 'nama_obat', 'harga', 'gambar', 'jenis_obat', 'bentuk_obat')
    ->orderBy('nama_obat')
    ->get();


    return view('user.homeuser', compact('medicines'));
}

// public function publicShow($id)
//     {
//         $medicine = Medicine::findOrFail($id);
//         return view('user.detail', compact('medicine'));
//     }

public function publicShow($id)
{
    // Ambil 1 data utama dari ID yang diklik
    $medicine = Medicine::findOrFail($id);

    // Ambil semua batch dengan kode_obat yang sama
    $batches = Medicine::where('kode_obat', $medicine->kode_obat)->get();

    // Hitung total jumlah dari semua batch
    $totalJumlah = $batches->sum('jumlah');

    return view('user.detail', compact('medicine', 'batches', 'totalJumlah'));
}

public function purchaseCreate()
    {
        // Fetch all medicines for the purchase form
        $medicines = Medicine::all();
        return view('admin.purchase', compact('medicines'));
    }

    // Store the purchase and update the stock
    // Menyimpan pembelian dan memperbarui stok
    public function purchaseStore(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kode_obat' => 'required',  // Kode obat wajib
            'nama_obat' => 'required',  // Nama obat wajib
            'jumlah' => 'required|integer', // Jumlah wajib dan harus berupa angka
        ]);

        // Mencari obat berdasarkan kode obat
        $medicine = Medicine::where('kode_obat', $request->kode_obat)->first();

        if ($medicine) {
            // Mengecek dan mengurangi stok jika tersedia
            $stockUpdated = $medicine->decreaseStock($request->jumlah);

            if ($stockUpdated) {
                // Menghitung harga total
                $total = $request->jumlah * $medicine->harga; 

                return redirect()->route('medicines.purchase')->with('success', 'Pembelian berhasil, stok diperbarui');
            } else {
                return redirect()->route('medicines.purchase')->with('error', 'Stok tidak cukup');
            }
        } else {
            return redirect()->route('medicines.purchase')->with('error', 'Obat tidak ditemukan');
        }
    }

    public function addObatCreate()
    {
        // Fetch all medicines for the purchase form
        $medicines = Medicine::all();
        return view('admin.addStock', compact('medicines'));
    }
    public function addObatStore(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kode_obat' => 'required',
            'nama_obat' => 'required',  // Kode obat wajib
            'jumlah' => 'required|integer|min:1', // Jumlah wajib dan harus berupa angka lebih dari 0
            'tanggal_exp' => 'required|date', // Tanggal kadaluarsa wajib
        ]);

        // Mencari obat berdasarkan kode obat
        $medicine = Medicine::where('kode_obat', $request->kode_obat)->first();

        // Jika obat ditemukan
        if ($medicine) {
            // Menambahkan stok berdasarkan jumlah yang dimasukkan
            $medicine->jumlah += $request->jumlah;  // Menambah stok yang baru

            // Membuat batch baru berdasarkan batch terakhir yang ada (batch + 1)
            $batchNumber = Medicine::where('kode_obat', $request->kode_obat)->max('batch') + 1;

            // Menyimpan data baru (batch baru dan tanggal kadaluarsa baru)
            $newStock = new Medicine();
            $newStock->kode_obat = $medicine->kode_obat;
            $newStock->nama_obat = $medicine->nama_obat;
            $newStock->harga = $medicine->harga;
            $newStock->batch = $batchNumber;
            $newStock->jumlah = $request->jumlah;
            $newStock->tanggal_exp = $request->tanggal_exp;
            $newStock->bentuk_obat = $medicine->bentuk_obat;
            $newStock->gambar = $medicine->gambar; // ✅ Diambil dari obat lama
            $newStock->deskripsi = $medicine->deskripsi; // ✅ Diambil dari obat lama
            $newStock->jenis_obat = $medicine->jenis_obat; // ✅ Diambil dari obat lama


            $newStock->save();

            $newStock->jenisPenyakit()->sync($medicine->jenisPenyakit->pluck('id'));


    
            // Save the new batch
            $newStock->save();

            $newStock->jenisPenyakit()->sync($medicine->jenisPenyakit->pluck('id'));


            // Return success message
            return redirect()->route('medicines.addStock')->with('success', 'Stok berhasil ditambahkan dengan Batch ' . $batchNumber);
        } else {
            // If medicine not found, return error
            return redirect()->route('medicines.addStock')->with('error', 'Obat tidak ditemukan');
        }
    }


// public function searchMedicine($search_term)
// {
//     // Cari obat berdasarkan kode_obat atau nama_obat
//     $medicine = Medicine::where('kode_obat', 'like', '%' . $search_term . '%')
//                         ->orWhere('nama_obat', 'like', '%' . $search_term . '%')
//                         ->first(); // Menggunakan first() untuk mendapatkan data pertama yang ditemukan

//     if ($medicine) {
//         // Mendapatkan batch dan ekspansi stok jika ada
//         $batches = Medicine::where('kode_obat', $medicine->kode_obat)->get(['batch', 'tanggal_exp', 'jumlah']);

//         return response()->json([
//             'success' => true,
//             'medicine' => [
//                 'kode_obat' => $medicine->kode_obat,
//                 'nama_obat' => $medicine->nama_obat,
//                 'harga' => $medicine->harga,
//                 'batches' => $batches // Menambahkan data batch yang ada
//             ]
//         ]);
//     } else {
//         return response()->json([
//             'success' => false,
//             'message' => 'Obat tidak ditemukan'
//         ]);
//     }
// }

// MedicineController.php


public function getMedicineBatches($kodeObat)
{
    // Ambil semua batch untuk obat dengan kode yang dimasukkan
    $medicines = Medicine::where('kode_obat', $kodeObat)->get();

    // Jika obat tidak ditemukan
    if ($medicines->isEmpty()) {
        return response()->json(['success' => false, 'message' => 'Obat tidak ditemukan.']);
    }

    // Kembalikan data batch obat
    $data = $medicines->map(function ($medicine) {
        return [
            'batch' => $medicine->batch,
            'exp_date' => $medicine->tanggal_exp,
            'quantity' => $medicine->jumlah,
            'nama_obat' => $medicine->nama_obat,
            'harga' => $medicine->harga
        ];
    });

    return response()->json(['success' => true, 'medicines' => $data]);
}

public function getMedicineBatchesStock($kodeObat)
{
    $medicines = Medicine::with('jenisPenyakit')
                    ->where('kode_obat', $kodeObat)
                    ->get();

    if ($medicines->isEmpty()) {
        return response()->json(['success' => false, 'message' => 'Obat tidak ditemukan.']);
    }

    $representative = $medicines->first();

    $data = $medicines->map(function ($medicine) {
        return [
            'batch' => $medicine->batch,
            'exp_date' => $medicine->tanggal_exp,
            'quantity' => $medicine->jumlah,
            'nama_obat' => $medicine->nama_obat,
            'harga' => $medicine->harga,
        ];
    });

    return response()->json([
            'success' => true,
            'medicines' => $data,
            'representative' => [
        'nama_obat' => $representative->nama_obat,
        'harga' => $representative->harga,
        'bentuk_obat' => $representative->bentuk_obat,
        'jenis_obat' => $representative->jenis_obat, 
        'gambar' => $representative->gambar,
        'deskripsi' => $representative->deskripsi,
        'jenis_penyakit' => $representative->jenisPenyakit->map(function ($p) {
            return [
                'id' => $p->id,
                'nama_penyakit' => $p->nama_penyakit
            ];
        })
    ]
    ]);

}











}