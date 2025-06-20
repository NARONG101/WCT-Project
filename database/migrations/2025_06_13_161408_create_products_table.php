<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_create_products_table.php
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('category');
        $table->integer('quantity');
        $table->decimal('price', 8, 2);
        $table->integer('low_stock_threshold')->default(10);
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
