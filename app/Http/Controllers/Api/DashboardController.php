<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'low_stock_items' => Product::lowStock()->count(),
            'out_of_stock_items' => Product::outOfStock()->count(),
            'pending_orders' => PurchaseOrder::pending()->count(),
            'active_suppliers' => Supplier::active()->count(),
        ];

        $recentMovements = StockMovement::with(['product', 'creator'])
            ->latest()
            ->take(10)
            ->get();

        $topSellingProducts = Product::with('category')
            ->select('products.*')
            ->join('stock_movements', 'products.id', '=', 'stock_movements.product_id')
            ->where('stock_movements.type', 'out')
            ->where('stock_movements.created_at', '>=', now()->subDays(30))
            ->groupBy('products.id')
            ->orderByRaw('SUM(stock_movements.quantity) DESC')
            ->take(5)
            ->get();

        $categoryDistribution = Product::select('categories.name', DB::raw('count(*) as count'))
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        $lowStockAlerts = Product::with('category')
            ->lowStock()
            ->orderBy('quantity', 'asc')
            ->take(10)
            ->get();

        return response()->json([
            'stats' => $stats,
            'recent_movements' => $recentMovements,
            'top_selling_products' => $topSellingProducts,
            'category_distribution' => $categoryDistribution,
            'low_stock_alerts' => $lowStockAlerts,
        ]);
    }
}