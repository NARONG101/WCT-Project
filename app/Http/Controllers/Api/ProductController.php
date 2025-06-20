<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return Inventory::with('supplier')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'sku' => 'required|string|unique:inventories',
            'category' => 'nullable|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'supplier_id' => 'nullable|exists:suppliers,id'
        ]);

        return Inventory::create($validated);
    }

    public function show($id)
    {
        return Inventory::with('supplier')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'sku' => 'sometimes|string|unique:inventories,sku,' . $inventory->id,
            'category' => 'nullable|string',
            'quantity' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'supplier_id' => 'nullable|exists:suppliers,id'
        ]);

        $inventory->update($validated);

        return $inventory;
    }

    public function destroy($id)
    {
        Inventory::findOrFail($id)->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
