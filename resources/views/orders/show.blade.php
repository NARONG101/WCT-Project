@extends('layouts.app')

@section('title', 'Order Details')
@section('page-title', 'Order Details')
@section('page-subtitle', 'View details for Purchase Order #' . $order->order_number)

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow space-y-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
        📄 Purchase Order #{{ $order->order_number }}
    </h2>

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <p class="text-gray-600 font-medium">Supplier:</p>
            <p class="text-gray-800">{{ $order->supplier->name }}</p>

            <p class="text-gray-600 font-medium mt-4">Contact:</p>
            <p class="text-gray-800">{{ $order->supplier->contact }}</p>

            <p class="text-gray-600 font-medium mt-4">Address:</p>
            <p class="text-gray-800 whitespace-pre-line">{{ $order->supplier->address }}</p>
        </div>

        <div>
            <p class="text-gray-600 font-medium">Order Date:</p>
            <p class="text-gray-800">{{ $order->order_date->format('Y-m-d') }}</p>

            <p class="text-gray-600 font-medium mt-4">Expected Delivery:</p>
            <p class="text-gray-800">{{ $order->expected_delivery ? $order->expected_delivery->format('Y-m-d') : '-' }}</p>

            <p class="text-gray-600 font-medium mt-4">Status:</p>
            <span class="inline-block px-3 py-1 rounded-full text-white text-sm font-semibold
                {{ $order->status === 'Completed' ? 'bg-green-500' : ($order->status === 'Pending' ? 'bg-yellow-500' : 'bg-gray-500') }}">
                {{ $order->status }}
            </span>

            <p class="text-gray-600 font-medium mt-4">Total:</p>
            <p class="text-gray-800 font-bold text-lg">${{ number_format($order->total, 2) }}</p>
        </div>
    </div>

    @if ($order->items->count())
        <div class="pt-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Order Items</h3>

            <table class="min-w-full bg-white border rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Item</th>
                        <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Quantity</th>
                        <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Price</th>
                        <th class="px-4 py-2 border-b text-left text-sm font-medium text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $item->inventory->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-4 py-2">${{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-2">${{ number_format($item->quantity * $item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="mt-6 text-gray-500">No items found for this order.</p>
    @endif

    <div class="pt-6">
        <a href="{{ route('orders.index') }}"
            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
            ← Back to Orders
        </a>
    </div>
</div>
@endsection
