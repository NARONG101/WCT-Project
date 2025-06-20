<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->create([
            'name' => 'Wireless Headphones',
            'category' => 'Electronics',
            'quantity' => 24,
            'price' => 89.99,
            'sold_count' => 248,
        ]);

        Product::factory()->create([
            'name' => 'Office Chair',
            'category' => 'Furniture',
            'quantity' => 6,
            'price' => 149.99,
            'sold_count' => 182,
        ]);

        Product::factory()->create([
            'name' => 'Wireless Keyboard',
            'category' => 'Electronics',
            'quantity' => 12,
            'price' => 49.99,
            'sold_count' => 156,
        ]);

        Product::factory()->create([
            'name' => 'Desk Lamp',
            'category' => 'Office Supplies',
            'quantity' => 15,
            'price' => 29.99,
            'sold_count' => 134,
        ]);

        Product::factory()->count(20)->create();
    }
}