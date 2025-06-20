<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\StockMovementController;
use App\Http\Controllers\Api\OrderController;
use App\Models\Product;

Route::get('/suppliers/{supplier}/products', function ($supplierId) {
    return Product::where('supplier_id', $supplierId)->select('id', 'name', 'price')->get();
});
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Categories
Route::apiResource('categories', CategoryController::class);

// Products
Route::apiResource('products', ProductController::class);

// Suppliers
Route::apiResource('suppliers', SupplierController::class);

// Purchase Orders
Route::apiResource('purchase-orders', PurchaseOrderController::class);

// Stock Movements
Route::apiResource('stock-movements', StockMovementController::class);
