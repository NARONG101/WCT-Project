@extends('layouts.app')

@section('title', 'Order & Restocking')
@section('page-title', 'Order & Restocking')
@section('page-subtitle', 'Manage purchase orders and stock replenishment.')

@section('content')
<div class="space-y-6">

    {{-- Create PO Button --}}
    <div class="flex justify-end">
        <a href="{{ route('orders.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded font-semibold transition">
            <i class="fas fa-plus mr-2"></i> Create Purchase Order
        </a>
    </div>

    {{-- Orders Table --}}
    <div class="overflow-x-auto max-h-[400px] overflow-y-auto border border-gray-200 rounded-lg shadow-sm bg-white">
        <table class="min-w-full table-auto border-collapse text-sm">
            <thead class="bg-indigo-100 text-indigo-700 sticky top-0">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">PO Number</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Supplier</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Order Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr class="hover:bg-indigo-50">
                    <td class="border border-gray-300 px-4 py-2 font-medium">{{ $order->order_number }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $order->supplier->name ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $order->order_date->format('Y-m-d') }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="inline-block px-2 py-1 rounded text-white text-xs font-semibold
                            @if (strtolower($order->status) === 'completed') bg-green-500
                            @elseif (strtolower($order->status) === 'pending') bg-yellow-500
                            @else bg-gray-400 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 space-x-2">
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="text-indigo-600 hover:underline">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('orders.edit', $order->id) }}"
                           class="text-yellow-600 hover:underline">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">
                        <i class="fas fa-inbox text-2xl mb-2"></i><br>
                        No purchase orders found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

@section('scripts')
{{-- No scripts --}}
@endsection
