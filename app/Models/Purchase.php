<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'harga',
        'batch',
        'jumlah',
        'diskon', // ✅ tambahkan ini!
        'admin_id',
    ];
}

