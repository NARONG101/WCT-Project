<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        foreach ($suppliers as $supplier) {
            for ($i = 0; $i < 3; $i++) {
                $order = Order::factory()->create([
                    'supplier_id' => $supplier->id,
                    'status' => $i === 0 ? 'pending' : 'completed',
                ]);

                $total = 0;
                for ($j = 0; $j < rand(2, 5); $j++) {
                    $product = $products->random();
                    $quantity = rand(1, 10);
                    
                    OrderItem::factory()->create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ]);

                    $total += $product->price * $quantity;
                }

                $order->update(['total' => $total]);
            }
        }
    }
}