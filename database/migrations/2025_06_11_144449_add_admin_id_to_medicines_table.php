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
        $table->unsignedBigInteger('admin_id')->nullable()->after('jumlah');

        // Jika kamu pakai relasi ke tabel users:
        $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            //
        });
    }
};
