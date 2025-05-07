<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar','kode_obat', 'nama_obat', 'harga', 'tanggal_exp',
        'bentuk_obat', 'jenis_penyakit', 'jenis_obat',
        'deskripsi', 'jumlah',
    ];
}

