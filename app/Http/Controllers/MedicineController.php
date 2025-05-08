<?php

// namespace App\Http\Controllers;

// use App\Models\Medicine;
// use Illuminate\Http\Request;
// use App\Models\JenisPenyakit;

// class MedicineController extends Controller
// {
    
//     public function create()
//     {
        // Mengambil semua data jenis penyakit dari tabel jenis_penyakits
        // $penyakit = JenisPenyakit::all();
    
        // Untuk memastikan apakah data berhasil diambil dan ditampilkan
        // dd($penyakit);  // Digunakan untuk menampilkan data dan menghentikan eksekusi script
    
        // Mengirim data ke view untuk ditampilkan
    //     return view('admin.medicines.create', compact('penyakit'));
    // }
    
    
    


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'kode_obat' => 'required|unique:medicines',
    //         'nama_obat' => 'required',
    //         'harga' => 'required|numeric',
    //         'tanggal_exp' => 'required|date',
    //         'bentuk_obat' => 'required',
    //         'penyakit' => 'required|array',
    //         'penyakit.*' => 'exists:jenis_penyakit,id', // ← ini yang diperbaiki
    //         'jenis_obat' => 'required',
    //         'jumlah' => 'required|integer',
    //     ]);
        
    
    //     $data = $request->except('_token', 'penyakit');  // kita akan proses relasi terpisah
    
    //     if ($request->hasFile('gambar')) {
    //         $file = $request->file('gambar');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $destination = public_path('uploads/obat');
    
    //         if (!file_exists($destination)) {
    //             mkdir($destination, 0755, true);
    //         }
    
    //         $file->move($destination, $filename);
    //         $data['gambar'] = 'uploads/obat/' . $filename;
    //     } else {
    //         $data['gambar'] = null;
    //     }
    
    //     $medicine = Medicine::create($data);
    
        // Tambahkan relasi many-to-many ke pivot table
    //     $medicine->jenisPenyakit()->sync($request->penyakit);

    // return redirect()->route('medicines.create')->with('success', 'Obat berhasil ditambahkan');
    // }
    

    // public function edit($id)
    // {
    //     $medicine = Medicine::findOrFail($id);
    //     return view('admin.medicines.edit', compact('medicine'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'kode_obat' => 'required|unique:medicines,kode_obat,' . $id,
    //         'nama_obat' => 'required',
    //         'harga' => 'required|numeric',
    //         'tanggal_exp' => 'required|date',
    //         'bentuk_obat' => 'required',
    //         'jenis_penyakit' => 'required',
    //         'jenis_obat' => 'required',
    //         'jumlah' => 'required|integer',
    //     ]);

    //     $medicine = Medicine::findOrFail($id);
    //     $data = $request->except('_token', '_method');

    //     if ($request->hasFile('gambar')) {
    //         $file = $request->file('gambar');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('uploads/obat'), $filename);
    //         $data['gambar'] = 'uploads/obat/' . $filename;
    //     }

    //     $medicine->update($data);

    //     return redirect()->route('medicines.edit', $medicine->id)->with('success', 'Data obat berhasil diperbarui');
    // }
    
    
    // public function dashboard()
    // {
    //     $medicines = Medicine::all();
        
        // Ambil nilai unik dari kolom enum/string di tabel obat
    //     $jenisObat = Medicine::select('jenis_obat')->distinct()->pluck('jenis_obat');
    //     $bentukObat = Medicine::select('bentuk_obat')->distinct()->pluck('bentuk_obat');
    //     $penyakit = Medicine::with('jenisPenyakit')->get();  // Relasi many-to-many
    
    //     return view('admin.dashboard', compact('medicines', 'jenisObat', 'bentukObat', 'penyakit'));
    // }
    
    
    

    // public function index(Request $request)
    // {
    //     $medicines = Medicine::query();
    
    //     if ($request->filled('jenis_obat')) {
    //         $medicines->where('jenis_obat', $request->jenis_obat);
    //     }
    
    //     if ($request->filled('penyakit')) {
    //         $medicines->whereHas('jenisPenyakit', function ($query) use ($request) {
    //             $query->whereIn('id', $request->penyakit);
    //         });
    //     }
    
    //     if ($request->filled('bentuk_obat')) {
    //         $medicines->where('bentuk_obat', $request->bentuk_obat);
    //     }
    
    //     $medicines = $medicines->get();
    
    //     return view('admin.dashboard', [
    //         'medicines'   => $medicines,
    //         'jenisObat'   => Medicine::distinct()->pluck('jenis_obat'),
    //         'bentukObat'  => Medicine::distinct()->pluck('bentuk_obat'),
    //         'penyakit'    => JenisPenyakit::all(),
    //     ]);
    // }
    
    


//}


//class MedicineController extends Controller
//{
//     public function create()
//     {
//         return view('admin.medicines.create');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
//             'kode_obat' => 'required|unique:medicines',
//             'nama_obat' => 'required',
//             'harga' => 'required|numeric',
//             'tanggal_exp' => 'required|date',
//             'bentuk_obat' => 'required',
//             'jenis_penyakit' => 'required',
//             'jenis_obat' => 'required',
//             'jumlah' => 'required|integer',
//         ]);
    
//         $data = $request->except('_token');
    
//         if ($request->hasFile('gambar')) {
//             $file = $request->file('gambar');
//             $filename = time() . '_' . $file->getClientOriginalName();
//             $file->move(public_path('uploads/obat'), $filename);
//             $data['gambar'] = 'uploads/obat/' . $filename;
//         }
    
//         Medicine::create($data);
    
//         return redirect()->route('medicines.create')->with('success', 'Obat berhasil ditambahkan');
//     }
    
//     public function edit($id)
// {
//     $medicine = Medicine::findOrFail($id);
//     return view('admin.medicines.edit', compact('medicine'));
// }

//     public function update(Request $request, $id)
// {
//     $request->validate([
//         'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
//         'kode_obat' => 'required|unique:medicines,kode_obat,' . $id,
//         'nama_obat' => 'required',
//         'harga' => 'required|numeric',
//         'tanggal_exp' => 'required|date',
//         'bentuk_obat' => 'required',
//         'jenis_penyakit' => 'required',
//         'jenis_obat' => 'required',
//         'jumlah' => 'required|integer',
//     ]);

//     $medicine = Medicine::findOrFail($id);
//     $data = $request->except('_token', '_method');

//     if ($request->hasFile('gambar')) {
//         $file = $request->file('gambar');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $file->move(public_path('uploads/obat'), $filename);
//         $data['gambar'] = 'uploads/obat/' . $filename;
//     }

//     $medicine->update($data);

//     return redirect()->route('medicines.edit', $medicine->id)->with('success', 'Data obat berhasil diperbarui');
// }


//} -->





namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\JenisPenyakit;
use Illuminate\Http\Request;

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
            'tanggal_exp' => 'required|date',
            'bentuk_obat' => 'required',
            'penyakit' => 'required|array',
            'penyakit.*' => 'exists:jenis_penyakits,id',
            'jenis_obat' => 'required',
            'jumlah' => 'required|integer',
        ]);

        $data = $request->except('_token', 'penyakit');

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

        $medicine = Medicine::create($data);
        $medicine->jenisPenyakit()->sync($request->penyakit);

        return redirect()->route('medicines.create')->with('success', 'Obat berhasil ditambahkan');
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
        $medicines = Medicine::query();

        if ($request->filled('jenis_obat')) {
            $medicines->where('jenis_obat', $request->jenis_obat);
        }

        if ($request->filled('penyakit')) {
            $medicines->whereHas('jenisPenyakit', function ($query) use ($request) {
                $query->whereIn('id', $request->penyakit);
            });
        }

        if ($request->filled('bentuk_obat')) {
            $medicines->where('bentuk_obat', $request->bentuk_obat);
        }

        $medicines = $medicines->get();

        return view('admin.dashboard', [
            'medicines' => $medicines,
            'jenisObat' => Medicine::distinct()->pluck('jenis_obat'),
            'bentukObat' => Medicine::distinct()->pluck('bentuk_obat'),
            'penyakit' => JenisPenyakit::all(),
        ]);
    }
}
