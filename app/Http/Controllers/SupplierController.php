<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Product;


class SupplierController extends Controller
{
    public function index()
{
    $suppliers = Supplier::with('orders')->get();
    return view('suppliers.index', compact('suppliers'));
}

public function create()
{
    $products = Product::all();
    return view('suppliers.create', compact('products'));
}

public function store(Request $request)
{
    $supplier = Supplier::create($request->except('products'));
    if ($request->has('products')) {
        $supplier->products()->sync($request->products); // add pivot data if needed
    }
    return redirect()->route('suppliers.index')->with('success', 'Supplier added');
}

public function edit($id)
{
    $supplier = Supplier::findOrFail($id);
    $products = Product::all(); // If you need products for a dropdown
    return view('suppliers.edit', compact('supplier', 'products'));
}

public function update(Request $request, Supplier $supplier)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'contact' => 'nullable|string',
        'address' => 'nullable|string',
        'item_type' => 'nullable|string|max:255',
        'quantity' => 'nullable|integer|min:0',
        'price' => 'nullable|numeric|min:0',
    ]);

    $supplier->update([
        'name' => $request->name,
        'contact' => $request->contact,
        'address' => $request->address,
        'item_type' => $request->item_type,
        'quantity' => $request->quantity,
        'price' => $request->price,
    ]);

    return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
}



public function destroy($id)
{
    $supplier = Supplier::findOrFail($id);
    $supplier->delete();
    return redirect()->route('suppliers.index')->with('success', 'Supplier deleted');
}

}