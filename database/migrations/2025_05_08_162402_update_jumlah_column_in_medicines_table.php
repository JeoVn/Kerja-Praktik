<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJumlahColumnInMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            // Menambahkan nilai default untuk kolom jumlah
            $table->integer('jumlah')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->integer('jumlah')->nullable()->change(); // Mengembalikan ke nullable jika perlu
        });
    }
}

