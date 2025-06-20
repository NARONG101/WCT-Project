<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of inventory items.
     */
    public function index()
    {
        return Inventory::with('supplier')->get();
    }

    /**
     * Store a newly created inventory item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|max:100|unique:inventories,sku',
            'category'    => 'nullable|string|max:100',
            'quantity'    => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $inventory = Inventory::create($validated);

        return response()->json($inventory, 201);
    }

    /**
     * Display a specific inventory item.
     */
    public function show($id)
    {
        $inventory = Inventory::with('supplier')->findOrFail($id);
        return response()->json($inventory);
    }

    /**
     * Update a specific inventory item.
     */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|string|max:255',
            'sku'         => 'sometimes|string|max:100|unique:inventories,sku,' . $inventory->id,
            'category'    => 'nullable|string|max:100',
            'quantity'    => 'sometimes|integer|min:0',
            'price'       => 'sometimes|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $inventory->update($validated);

        return response()->json($inventory);
    }

    /**
     * Delete a specific inventory item.
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return response()->json(['message' => 'Inventory item deleted successfully.'], 200);
    }
}
