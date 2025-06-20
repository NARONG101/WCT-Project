<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // List all suppliers
   public function index()
{
    $suppliers = Supplier::all(); // This includes item_type field automatically
    return view('suppliers.index', compact('suppliers'));
}

    // Store new supplier
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:suppliers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $supplier = Supplier::create($validated);
        return response()->json($supplier, 201);
    }

    // Show single supplier
    public function show($id) {
        $supplier = Supplier::find($id);
        return $supplier ? response()->json($supplier) : response()->json(['message' => 'Not found'], 404);
    }

    // Update supplier
  public function update(Request $request, $id) {
    $supplier = Supplier::find($id);
    if (!$supplier) {
        return response()->json(['message' => 'Supplier not found'], 404);
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'company' => 'nullable|string|max:255',
        'email' => 'nullable|email|unique:suppliers,email,' . $supplier->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
    ]);

    try {
        $supplier->update($validated);
        return response()->json(['message' => 'Supplier updated successfully', 'supplier' => $supplier], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Update failed', 'error' => $e->getMessage()], 500);
    }
}


    // Delete supplier
    public function destroy($id) {
        $supplier = Supplier::find($id);
        if (!$supplier) return response()->json(['message' => 'Not found'], 404);

        $supplier->delete();
        return response()->json(['message' => 'Deleted']);
    }
}