<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('kode_obat')->unique();
            $table->string('nama_obat');
            $table->integer('harga');
            $table->date('tanggal_exp');
            $table->string('bentuk_obat');
            $table->string('jenis_obat');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah');
            $table->timestamps();
        });

        // Tidak perlu kolom jenis_penyakit di tabel medicines, karena relasi many-to-many
    }

    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}

