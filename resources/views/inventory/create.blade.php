@extends('layouts.app')

@section('title', 'Add New Product')
@section('page-title', 'Add New Inventory Item')
@section('page-subtitle', 'Fill out the form to add a new product.')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-6 text-indigo-700">Add New Product</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-4 rounded">
            <strong>Whoops! Something went wrong.</strong>
            <ul class="list-disc pl-5 mt-2 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventory.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-semibold text-gray-700">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200"
                   placeholder="Example: Logitech Mouse">
        </div>

        <div>
            <label for="sku" class="block font-semibold text-gray-700">SKU / Barcode</label>
            <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200"
                   placeholder="Example: SKU123456">
        </div>

        <div>
            <label for="category" class="block font-semibold text-gray-700">Category</label>
            <input type="text" name="category" id="category" value="{{ old('category') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200"
                   placeholder="Example: Electronics">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="quantity" class="block font-semibold text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200"
                       placeholder="Example: 10">
            </div>

            <div>
                <label for="price" class="block font-semibold text-gray-700">Price ($)</label>
                <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200"
                       placeholder="Example: 25.50">
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('inventory.index') }}" class="text-gray-600 hover:text-gray-800">
                ← Cancel
            </a>
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg">
                <i class="fas fa-save mr-2"></i> Save Product
            </button>
        </div>
    </form>
</div>
@endsection
