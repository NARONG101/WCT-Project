@extends('layouts.app')

@section('title', 'Inventory Management')
@section('page-title', 'Inventory Management')
@section('page-subtitle', 'Manage your products and track stock levels.')

@section('content')
<h1>Inventory Page</h1>

<!-- Flash Messages -->
@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<!-- Search Bar -->
<form method="GET" action="{{ route('inventory.index') }}">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search products..."
        class="w-full mb-4 p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
    />
</form>

<!-- Add Product Button -->
<a href="{{ route('inventory.create') }}">
    <button class="mb-6 bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded font-semibold">
        <i class="fas fa-plus mr-2"></i> Add Product
    </button>
</a>

<!-- Low Stock Alert -->
@php
    $lowStockItems = $items->filter(fn($item) => $item->quantity <= 10);
@endphp

@if ($lowStockItems->count() > 0)
    <div class="mb-6 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded shadow">
        <strong>⚠️ Low Stock Alert:</strong>
        <ul class="list-disc pl-5 mt-2">
            @foreach ($lowStockItems as $lowItem)
                <li>{{ $lowItem->name }} (Qty: {{ $lowItem->quantity }})</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Product Table -->
<div class="overflow-x-auto max-h-[320px] overflow-y-auto border border-gray-300 rounded mb-10">
    <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-indigo-100 text-indigo-700 sticky top-0">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">SKU / Barcode</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr class="hover:bg-indigo-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $item->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->sku ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $item->category ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2 font-semibold {{ $item->quantity <= 10 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $item->quantity }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">${{ number_format($item->price, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2 space-x-2">
                        <a href="{{ route('inventory.edit', $item->id) }}" class="text-indigo-600 hover:underline">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                onclick="return confirm('Are you sure you want to delete this product?')"
                                class="text-white bg-red-600 hover:bg-red-700 font-semibold py-1 px-3 rounded"
                            >
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No inventory found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Inventory Graph -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-semibold mb-4">Stock Levels Overview</h3>
    <canvas id="inventoryChart" class="w-full max-w-4xl h-64"></canvas>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('inventoryChart').getContext('2d');

    const generateColors = (num) => {
        const colors = [];
        for (let i = 0; i < num; i++) {
            colors.push(`hsl(${(i * 360 / num)}, 70%, 60%)`);
        }
        return colors;
    };

    const labels = {!! json_encode($items->pluck('name')) !!};
    const data = {!! json_encode($items->pluck('quantity')) !!};
    const backgroundColors = generateColors(labels.length);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Quantity in Stock',
                data,
                backgroundColor: backgroundColors,
                borderColor: backgroundColors.map(c => c.replace('60%', '50%')),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => `Quantity: ${ctx.parsed.y}`
                    }
                }
            }
        }
    });
</script>
@endsection
