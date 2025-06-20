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
    Schema::table('suppliers', function (Blueprint $table) {
        $table->decimal('price', 10, 2)->nullable();
       $table->integer('quantity')->nullable();
        $table->decimal('total_price', 10, 2)->nullable();
    });
}


public function down(): void
{
    Schema::table('inventories', function (Blueprint $table) {
        $table->dropForeign(['supplier_id']);
        $table->dropColumn('quantity');
        $table->dropColumn('supplier_id');
    });
}

};