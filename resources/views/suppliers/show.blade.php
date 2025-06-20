@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <h2 class="text-2xl font-bold text-gray-900 mb-6">📄 Supplier Details</h2>

    <div class="bg-white rounded-lg shadow p-6 space-y-4">

        <div>
            <h4 class="font-semibold text-gray-700">Name</h4>
            <p>{{ $supplier->name }}</p>
        </div>

        <div>
            <h4 class="font-semibold text-gray-700">Contact Person</h4>
            <p>{{ $supplier->contact_person ?? '-' }}</p>
        </div>

        <div>
            <h4 class="font-semibold text-gray-700">Email</h4>
            <p>{{ $supplier->email ?? '-' }}</p>
        </div>

        <div>
            <h4 class="font-semibold text-gray-700">Phone</h4>
            <p>{{ $supplier->phone ?? '-' }}</p>
        </div>

        <div>
            <h4 class="font-semibold text-gray-700">Address</h4>
            <p>{{ $supplier->address ?? '-' }}</p>
        </div>

        <div>
            <h4 class="font-semibold text-gray-700">Payment Terms</h4>
            <p>{{ $supplier->payment_terms ?? '-' }}</p>
        </div>

        <div>
            <h4 class="font-semibold text-gray-700">Rating</h4>
            <p>{{ $supplier->rating ?? '-' }}</p>
        </div>

        <div>
            <h4 class="font-semibold text-gray-700">Item Type</h4>
            <p>{{ $supplier->item_type ?? '-' }}</p>
        </div>

    </div>

    <div class="mt-6">
        <a href="{{ route('suppliers.index') }}" class="text-indigo-600 hover:underline">
            ← Back to List
        </a>
    </div>
</div>
@endsection
