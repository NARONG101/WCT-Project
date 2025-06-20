<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});


// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Inventory
    Route::resource('inventory', InventoryController::class);

    // Suppliers

    Route::resource('suppliers', SupplierController::class);

    // Orders
    Route::resource('orders', OrderController::class);

    // Purchase Orders
    Route::resource('purchase-orders', PurchaseOrderController::class);
    Route::post('purchase-orders/{id}/receive', [PurchaseOrderController::class, 'receive'])->name('purchase-orders.receive');

    // Products (if you have a ProductController)
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::post('products/{product}/restock', [ProductController::class, 'restock'])->name('products.restock');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';