@extends('layouts.app')

@section('title', 'Suppliers')
@section('page-title', 'Suppliers List')
@section('page-subtitle', 'View and manage supplier information.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold text-gray-900">Suppliers</h2>
    <a href="{{ route('suppliers.create') }}" 
       class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow transition">
       + Add New Supplier
    </a>
  </div>

  @if (session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
      {{ session('success') }}
    </div>
  @endif

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200 table-auto">
      <thead class="bg-indigo-600 text-white">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-medium uppercase">Name</th>
          <th class="px-6 py-3 text-left text-sm font-medium uppercase">Contact</th>
          <th class="px-6 py-3 text-left text-sm font-medium uppercase">Address</th>
          <th class="px-6 py-3 text-left text-sm font-medium uppercase">Item Type</th>
          <th class="px-6 py-3 text-center text-sm font-medium uppercase">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        @forelse ($suppliers as $supplier)
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $supplier->name }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $supplier->contact ?? '-' }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $supplier->address ?? '-' }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $supplier->item_type ?? '-' }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-center text-sm space-x-2">
            <a href="{{ route('suppliers.edit', $supplier) }}" 
               class="text-indigo-600 hover:text-indigo-900 font-semibold">
               Edit
            </a>
            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline"
                  onsubmit="return confirm('Are you sure you want to delete this supplier?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                Delete
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center px-6 py-4 text-gray-500 italic">
            No suppliers found.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
