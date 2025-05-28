<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPenyakitSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_penyakit' => 'Batuk, Pilek & Flu'],
            ['nama_penyakit' => 'Kondisi Kulit'],
            ['nama_penyakit' => 'Demam & Nyeri'],
            ['nama_penyakit' => 'Infeksi'],
            ['nama_penyakit' => 'Masalah Pencernaan'],
            ['nama_penyakit' => 'Tulang & Sendi'],
            ['nama_penyakit' => 'Alergi'],
            ['nama_penyakit' => 'Kesuburan'],
            ['nama_penyakit' => 'Masalah THT'],
            ['nama_penyakit' => 'Lainnya'],
            ['nama_penyakit' => 'Masalah Mata'],
        ];

         DB::table('jenis_penyakit')->insert($data);
    }
}

