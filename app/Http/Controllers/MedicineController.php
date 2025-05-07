<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

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
