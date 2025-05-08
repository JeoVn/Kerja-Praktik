<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class JenisPenyakit extends Model
// {
//     use HasFactory;
//     public function medicines()
// {
//     return $this->belongsToMany(Medicine::class, 'medicine_jenis_penyakit', 'jenis_penyakit_id', 'medicine_id');
// }

// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class JenisPenyakit extends Model
// {
//     use HasFactory;

//     // Relasi many-to-many ke Medicine
//     public function medicines()
//     {
//         return $this->belongsToMany(Medicine::class, 'medicine_jenis_penyakit');
//     }
// }



class JenisPenyakit extends Model
{
    
    protected $table = 'jenis_penyakits'; // pastikan nama tabel benar
    protected $primaryKey = 'id';        // sesuaikan jika beda
    protected $fillable = ['nama_penyakit'];
}


