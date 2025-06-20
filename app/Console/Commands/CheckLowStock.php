<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckLowStock extends Command
{
    protected $signature = 'inventory:check-low-stock';
    protected $description = 'Check for products below reorder level';

    public function handle()
    {
        $lowStockProducts = Product::whereColumn('current_quantity', '<', 'reorder_level')->get();

        if ($lowStockProducts->isEmpty()) {
            $this->info('No products below reorder level');
            return;
        }

        $this->info('Low Stock Alert:');
        $this->table(
            ['Product', 'Current Stock', 'Reorder Level'],
            $lowStockProducts->map(function ($product) {
                return [
                    $product->name,
                    $product->current_quantity,
                    $product->reorder_level
                ];
            })
        );

        // Additional notification logic (email, slack, etc) can be added here
    }
}