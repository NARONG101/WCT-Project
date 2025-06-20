<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Order::factory()->count(10)->create()->each(function ($order) {
        $products = Product::inRandomOrder()->take(3)->pluck('id');
        foreach ($products as $productId) {
            $order->products()->attach($productId, ['quantity' => rand(1, 10)]);
        }
    });
}

}
