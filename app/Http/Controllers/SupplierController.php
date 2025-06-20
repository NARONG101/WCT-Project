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
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255', // <-- Add this line
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'item_type' => 'nullable|string|max:255',
        ]);

        $supplier = Supplier::create($request->only([
            'name', 'contact', 'contact_person', 'email', 'phone', 'address', 'item_type'
        ]));

        if ($request->has('products')) {
            $supplier->products()->sync($request->products);
        }

        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully!');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $products = Product::all();
        return view('suppliers.edit', compact('supplier', 'products'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255', // <-- Add this line
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'item_type' => 'nullable|string|max:255',
        ]);

        $supplier->update($request->only([
            'name', 'contact', 'contact_person', 'email', 'phone', 'address', 'item_type'
        ]));

        if ($request->has('products')) {
            $supplier->products()->sync($request->products);
        }

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted');
    }
}