<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory; // ✅ Correct model used
use App\Models\Supplier;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // ✅ Use Inventory instead of Product
        $totalProducts   = Inventory::count();
        $totalSuppliers  = Supplier::count();
        $pendingOrders   = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        // ✅ Use either static threshold or dynamic field
        // Option 1: Static threshold (simple)
        $lowStockCount = Inventory::where('quantity', '<=', 10)->count();

        // Option 2: Use each item's custom low_stock_threshold
        // $lowStockCount = Inventory::whereColumn('quantity', '<=', 'low_stock_threshold')->count();

        // ✅ For charts
        $productNames      = Inventory::pluck('name');
        $productQuantities = Inventory::pluck('quantity');

        return view('dashboard', compact(
            'totalProducts',
            'totalSuppliers',
            'pendingOrders',
            'completedOrders',
            'lowStockCount',
            'productNames',
            'productQuantities'
        ));
    }
}
