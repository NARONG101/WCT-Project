@extends('layouts.app')

@section('title', 'Edit Order')
@section('page-title', 'Edit Purchase Order')
@section('page-subtitle', 'Update the details of this purchase order.')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow space-y-6">
    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        ✏️ Edit Purchase Order #{{ $order->order_number }}
    </h2>

    <form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Order Number -->
        <div>
            <label for="order_number" class="block font-semibold text-gray-700 mb-1">Order Number <span class="text-red-500">*</span></label>
            <input type="text" name="order_number" id="order_number"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                value="{{ old('order_number', $order->order_number) }}" required>
        </div>

        <!-- Supplier -->
        <div>
            <label for="supplier_id" class="block font-semibold text-gray-700 mb-1">Supplier <span class="text-red-500">*</span></label>
            <select name="supplier_id" id="supplier_id"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                required>
                <option value="">-- Select Supplier --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $order->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Supplier Info Display -->
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Supplier Contact</label>
                <input type="text" id="supplier_contact"
                    class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 cursor-not-allowed"
                    readonly>
            </div>
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Supplier Address</label>
                <textarea id="supplier_address" rows="3"
                    class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 cursor-not-allowed"
                    readonly></textarea>
            </div>
        </div>

        <!-- Order Dates -->
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label for="order_date" class="block font-semibold text-gray-700 mb-1">Order Date <span class="text-red-500">*</span></label>
                <input type="date" name="order_date" id="order_date"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    value="{{ old('order_date', $order->order_date->format('Y-m-d')) }}" required>
            </div>

            <div>
                <label for="expected_delivery" class="block font-semibold text-gray-700 mb-1">Expected Delivery</label>
                <input type="date" name="expected_delivery" id="expected_delivery"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    value="{{ old('expected_delivery', optional($order->expected_delivery)->format('Y-m-d')) }}">
            </div>
        </div>

        <!-- ✅ Fixed Status -->
        <div>
            <label for="status" class="block font-semibold text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
            <select name="status" id="status"
                class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <!-- Total -->
        <div>
            <label for="total" class="block font-semibold text-gray-700 mb-1">Total ($) <span class="text-red-500">*</span></label>
            <input type="number" name="total" id="total" step="0.01"
                class="w-full border border-gray-300 rounded-lg px-4 py-2"
                value="{{ old('total', $order->total) }}" required>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('orders.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded-lg transition">
                Cancel
            </a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                Update Order
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const suppliers = {
        @foreach ($suppliers as $supplier)
            "{{ $supplier->id }}": {
                contact: {!! json_encode($supplier->contact ?? '') !!},
                address: {!! json_encode($supplier->address ?? '') !!}
            },
        @endforeach
    };

    const supplierSelect = document.getElementById('supplier_id');
    const contactInput = document.getElementById('supplier_contact');
    const addressInput = document.getElementById('supplier_address');

    function fillSupplierInfo(id) {
        if (id && suppliers[id]) {
            contactInput.value = suppliers[id].contact;
            addressInput.value = suppliers[id].address;
        } else {
            contactInput.value = '';
            addressInput.value = '';
        }
    }

    supplierSelect.addEventListener('change', function () {
        fillSupplierInfo(this.value);
    });

    window.addEventListener('DOMContentLoaded', () => {
        fillSupplierInfo(supplierSelect.value);
    });
</script>
@endsection
