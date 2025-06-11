<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_obat', 'nama_obat', 'harga', 'batch', 'jumlah', 'diskon', 'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

