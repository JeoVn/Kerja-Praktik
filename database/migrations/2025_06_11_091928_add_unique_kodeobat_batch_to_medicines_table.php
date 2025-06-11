<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('medicines', function (Blueprint $table) {
        $table->unique(['kode_obat', 'batch']);
    });
}

public function down()
{
    Schema::table('medicines', function (Blueprint $table) {
        $table->dropUnique(['medicines_kode_obat_batch_unique']);
    });
}
};

