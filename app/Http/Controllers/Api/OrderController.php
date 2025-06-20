<?php

namespace App\Http\api\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Inventory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('inventory')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Pending,Completed'
        ]);

        $order = Order::create($validated);

        if ($validated['status'] === 'Completed') {
            $inventory = Inventory::findOrFail($validated['inventory_id']);
            $inventory->quantity += $validated['quantity'];
            $inventory->save();
        }

        return $order;
    }

    public function show($id)
    {
        return Order::with('inventory')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'inventory_id' => 'sometimes|exists:inventories,id',
            'quantity' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:Pending,Completed'
        ]);

        $order->update($validated);

        return $order;
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();

        return response()->json(['message' => 'Order deleted']);
    }
}
// This controller handles CRUD operations for orders, including creating, updating, and deleting orders.