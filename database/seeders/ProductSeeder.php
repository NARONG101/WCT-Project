<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    Product::factory()->count(30)->create([
        'supplier_id' => Supplier::inRandomOrder()->first()->id,
    ]);
}

}
