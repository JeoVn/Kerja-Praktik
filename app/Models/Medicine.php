<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Medicine extends Model
// {
//     use HasFactory;

//     protected $table = 'medicines'; // Pastikan nama tabel sesuai ERD

//     protected $primaryKey = 'id_obat';

//     protected $fillable = [
//         'gambar', 'kode_obat', 'nama_obat', 'harga_obat', 'tanggal_exp',
//         'bentuk_obat', 'jenis_obat',
//         'deskripsi', 'stok_obat', 'diskon_obat'
//     ];

//     public $timestamps = false;

    // Relasi ke Jenis Penyakit
// public function jenisPenyakit()
// {
//     return $this->belongsToMany(JenisPenyakit::class, 'medicine_jenis_penyakit');
// }


    
//}


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $table = 'medicines'; // Pastikan nama tabel sesuai dengan ERD

    protected $primaryKey = 'id'; // Gunakan 'id' jika primary key-nya default Laravel

    protected $fillable = [
        'gambar', 'kode_obat', 'nama_obat', 'harga', 'tanggal_exp',
        'bentuk_obat', 'jenis_obat', 'deskripsi', 'stok_obat', 'diskon_obat'
    ];

    public $timestamps = true; // Set ke true jika menggunakan created_at dan updated_at

    // Relasi many-to-many ke Jenis Penyakit
    public function jenisPenyakit()
    {
        return $this->belongsToMany(JenisPenyakit::class, 'medicine_jenis_penyakit', 'medicine_id', 'jenis_penyakit_id');
    }
    
}
