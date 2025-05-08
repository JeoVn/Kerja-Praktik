<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\JenisPenyakit;

class MedicineController extends Controller
{
    public function create()
    {
        return view('admin.medicines.create');
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
            'jenis_penyakit' => 'required',
            'jenis_obat' => 'required',
            'jumlah' => 'required|integer',
        ]);

        $data = $request->except('_token');

        // if ($request->hasFile('gambar')) {
        //     $file = $request->file('gambar');
        //     $filename = time() . '_' . $file->getClientOriginalName();

        //     $destination = public_path('uploads/obat');
        //     if (!file_exists($destination)) {
        //         mkdir($destination, 0755, true);
        //     }

        //     $file->move($destination, $filename);
        //     $data['gambar'] = 'uploads/obat/' . $filename;
        // } else {
        //     $data['gambar'] = null;
        // }
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            \Log::info('File being uploaded: ' . $filename);
            $destination = public_path('uploads/obat');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
                \Log::info('Directory created: ' . $destination);
            }
            $file->move($destination, $filename);
            $data['gambar'] = 'uploads/obat/' . $filename;
            \Log::info('File uploaded to: ' . $data['gambar']);
        } else {
            $data['gambar'] = null;
        }
       

        Medicine::create($data);

        return redirect()->route('medicines.create')->with('success', 'Obat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('admin.medicines.edit', compact('medicine'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kode_obat' => 'required|unique:medicines,kode_obat,' . $id,
            'nama_obat' => 'required',
            'harga' => 'required|numeric',
            'tanggal_exp' => 'required|date',
            'bentuk_obat' => 'required',
            'jenis_penyakit' => 'required',
            'jenis_obat' => 'required',
            'jumlah' => 'required|integer',
        ]);

        $medicine = Medicine::findOrFail($id);
        $data = $request->except('_token', '_method');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/obat'), $filename);
            $data['gambar'] = 'uploads/obat/' . $filename;
        }

        $medicine->update($data);

        return redirect()->route('medicines.edit', $medicine->id)->with('success', 'Data obat berhasil diperbarui');
    }

    
    public function dashboard()
    {
        $medicines = Medicine::all();
    
        // Ambil nilai unik dari kolom enum/string di tabel obat
        $jenisObat = Medicine::select('jenis_obat')->distinct()->pluck('jenis_obat');
        $bentukObat = Medicine::select('bentuk_obat')->distinct()->pluck('bentuk_obat');
        $penyakit = Medicine::select('jenis_penyakit')->distinct()->pluck('jenis_penyakit');
    
        return view('admin.dashboard', compact('medicines', 'jenisObat', 'bentukObat', 'penyakit'));
    }
    
    
    

    public function index(Request $request)
{
    $medicines = Medicine::query();

    if ($request->has('jenis_obat')) {
        $medicines->whereIn('jenis_obat_id', $request->jenis_obat);
    }

    if ($request->has('penyakit')) {
        $medicines->whereHas('penyakit', function ($q) use ($request) {
            $q->whereIn('penyakit_id', $request->penyakit);
        });
    }

    if ($request->has('bentuk_obat')) {
        $medicines->whereIn('bentuk_obat_id', $request->bentuk_obat);
    }

    return view('admin.dashboard', [
        'medicines'   => $medicines->get(),
        'jenisObat'   => JenisObat::all(),
        'penyakit'    => Penyakit::all(),
        'bentukObat'  => BentukObat::all(),
    ]);
}


}


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


//}
