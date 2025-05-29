<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\JenisPenyakit;
use Illuminate\Http\Request;
use Carbon\Carbon; 

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
        ]);

        $medicine = Medicine::findOrFail($id);
    $medicine->update($request->except('jenis_penyakit'));
    $medicine->jenisPenyakit()->sync($request->jenis_penyakit);
        $data = $request->except('_token', '_method');

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
        }

        $medicine->update($data);

        return redirect()->route('medicines.edit', $medicine->id)->with('success', 'Data obat berhasil diperbarui');
    }

    public function dashboard()
    {
        $medicines = Medicine::all();
        $jenisObat = Medicine::select('jenis_obat')->distinct()->pluck('jenis_obat');
        $bentukObat = Medicine::select('bentuk_obat')->distinct()->pluck('bentuk_obat');
        $penyakit = JenisPenyakit::all();

        return view('admin.dashboard', compact('medicines', 'jenisObat', 'bentukObat', 'penyakit'));
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

        return view('admin.dashboard', [
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
}