<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Supplier;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders with supplier and items eager loaded.
     */
    public function index()
    {
        $orders = Order::with(['supplier', 'items'])->get();

        // Count orders by status
        $pendingCount = $orders->where('status', 'pending')->count();
        $completedCount = $orders->where('status', 'completed')->count();

        return view('orders.index', compact('orders', 'pendingCount', 'completedCount'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('orders.create', compact('suppliers'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Remove manual input — generate below
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'expected_delivery' => 'nullable|date',
            'status' => 'required|in:pending,completed,cancelled',
            'total' => 'required|numeric|min:0',
        ]);

        // Auto-generate unique order_number
        $latestOrderNumber = Order::max('order_number');
        $validated['order_number'] = $latestOrderNumber ? $latestOrderNumber + 1 : 1;

        // Ensure status is stored lowercase
        $validated['status'] = strtolower($validated['status']);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with(['supplier', 'items'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $suppliers = Supplier::all();
        return view('orders.edit', compact('order', 'suppliers'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'order_number' => 'sometimes|string|max:255',
            'supplier_id' => 'sometimes|exists:suppliers,id',
            'order_date' => 'sometimes|date',
            'expected_delivery' => 'nullable|date',
            'status' => 'sometimes|in:pending,completed,cancelled',
            'total' => 'sometimes|numeric|min:0',
        ]);

        if (isset($validated['status'])) {
            $validated['status'] = strtolower($validated['status']);
        }

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted.');
    }
}
