<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $table = 'medicines'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key default Laravel

    protected $fillable = [
        'gambar',
        'kode_obat',
        'nama_obat',
        'harga',
        'jumlah',
        'tanggal_exp',
        'bentuk_obat',
        'jenis_obat',
        'deskripsi'
    ];

    public $timestamps = true; // Gunakan true jika tabel memakai created_at & updated_at

    // Relasi many-to-many ke Jenis Penyakit
    public function jenisPenyakit()
    {
        return $this->belongsToMany(JenisPenyakit::class, 'medicine_jenis_penyakit', 'medicine_id', 'jenis_penyakit_id');
    }
}