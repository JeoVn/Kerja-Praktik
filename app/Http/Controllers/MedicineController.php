<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Medicine;
use App\Models\JenisPenyakit;

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
    return view('admin.medicines.edit', compact('medicine', 'penyakit', 'selectedPenyakit'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'kode_obat' => 'required|unique:medicines,kode_obat,' . $id,
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
        $medicines = Medicine::all();
        $jenisObat = Medicine::select('jenis_obat')->distinct()->pluck('jenis_obat');
        $bentukObat = Medicine::select('bentuk_obat')->distinct()->pluck('bentuk_obat');
        $penyakit = JenisPenyakit::all();

        return view('admin.home', compact('medicines', 'jenisObat', 'bentukObat', 'penyakit'));
    }

    public function index(Request $request)
    {
        $query = Medicine::query();

        if ($request->filled('jenis_obat')) {
            $query->where('jenis_obat', $request->jenis_obat);
        }

        if ($request->filled('penyakit')) {
            $query->whereHas('jenisPenyakit', function ($q) use ($request) {
                $q->whereIn('id', $request->penyakit);
            });
        }

        if ($request->filled('bentuk_obat')) {
            $query->where('bentuk_obat', $request->bentuk_obat);
        }

        $medicines = $query->get();

        return view('admin.home', [
            'medicines' => $medicines,
            'jenisObat' => Medicine::select('jenis_obat')->distinct()->pluck('jenis_obat'),
            'bentukObat' => Medicine::select('bentuk_obat')->distinct()->pluck('bentuk_obat'),
            'penyakit' => JenisPenyakit::all(),
        ]);
    }
    public function show($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('admin.detail', compact('medicine'));
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
   public function publicIndex(Request $request)
{
    $query = Medicine::query();

    if ($request->filled('jenis_obat')) {
        $query->whereIn('jenis_obat', $request->jenis_obat);
    }
    if ($request->filled('sakit')) {
        // Sesuaikan filter sakit jika ada relasi, atau hapus jika belum ada
    }
    if ($request->filled('bentuk_obat')) {
        $query->whereIn('bentuk_obat', $request->bentuk_obat);
    }

    $medicines = $query->get();

    return view('user.homeuser', compact('medicines'));
}

public function publicShow($id)
{
    $medicine = Medicine::findOrFail($id);
    return view('user.detail', compact('medicine'));
}
// Display the form for adding stock to a medicine



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
    // Update stock for a medicine

    public function searchMedicine($search_term)
{
    // Cari obat berdasarkan kode_obat atau nama_obat
    $medicine = Medicine::where('kode_obat', 'like', '%' . $search_term . '%')
                        ->orWhere('nama_obat', 'like', '%' . $search_term . '%')
                        ->first(); // Menggunakan first() untuk mendapatkan data pertama yang ditemukan

    if ($medicine) {
        return response()->json([
            'success' => true,
            'medicine' => [
                'kode_obat' => $medicine->kode_obat,
                'nama_obat' => $medicine->nama_obat,
                'harga' => $medicine->harga
            ]
        ]);
    } else {
        return response()->json(['success' => false]);
    }
}
public function addStockForm($id)
{
    // Fetch the medicine by ID
    $medicine = Medicine::findOrFail($id);

    // Pass the medicine data to the view
    return view('admin.medicines.add_stock', compact('medicine'));
}

public function addStock(Request $request, $id)
{
    // Validate the incoming data
    $request->validate([
        'jumlah' => 'required|integer|min:1', // Quantity to add must be a positive integer
    ]);

    // Find the medicine by its ID
    $medicine = Medicine::findOrFail($id);

    // Get the quantity to add to the stock
    $quantityToAdd = $request->input('jumlah');

    // **Assign a new batch number** by getting the highest current batch number and incrementing it
    $batchNumber = Medicine::where('kode_obat', $medicine->kode_obat)->max('batch') + 1;

    // **Update the stock** of the medicine
    $medicine->jumlah += $quantityToAdd;

    // **Assign the batch number** to the medicine
    $medicine->batch = $batchNumber;

    // **Save the updated medicine** record with the new batch number and updated stock
    $medicine->save();

    // Optionally, you can add a record in a `stock_history` table to track this stock addition.
    // Or simply, you can log a message or notify the user.

    return redirect()->route('medicines.show', $medicine->id)
                     ->with('success', 'Stock berhasil ditambahkan dengan Batch ' . $batchNumber);
}

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











}