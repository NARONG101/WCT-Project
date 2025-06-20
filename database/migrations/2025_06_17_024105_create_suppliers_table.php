<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // database/migrations/xxxx_xx_xx_xxxxxx_create_suppliers_table.php
Schema::create('suppliers', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->nullable();
    $table->string('phone')->nullable();
    $table->text('address')->nullable();
    $table->string('contact_person')->nullable();
    $table->string('payment_terms')->nullable();
    $table->unsignedTinyInteger('rating')->nullable(); // 1–5 stars
    $table->timestamps();
});


    }

    public function down(): void {
        Schema::dropIfExists('suppliers');
    }
};
