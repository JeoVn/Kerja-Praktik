<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPenyakit extends Model
{
    use HasFactory;
    public function medicines()
{
    return $this->belongsToMany(Medicine::class, 'medicine_jenis_penyakit', 'jenis_penyakit_id', 'medicine_id');
}

}
