<?php
use App\Models\Purchase;
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
    Schema::table('purchases', function (Blueprint $table) {
        $table->decimal('diskon', 5, 2)->nullable()->after('jumlah'); // contoh: 15.00 = 15%
    });
}

public function down()
{
    Schema::table('purchases', function (Blueprint $table) {
        $table->dropColumn('diskon');
    });
}



    /**
     * Reverse the migrations.
     */

};
