<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHargaColumnInMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->decimal('harga', 8, 2)->default(0)->change(); // Set harga default ke 0
        });
    }

    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->decimal('harga', 8, 2)->nullable()->change(); // Kembalikan ke nullable jika perlu
        });
    }
}

