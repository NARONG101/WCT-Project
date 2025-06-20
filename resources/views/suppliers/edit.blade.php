@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
  <h2 class="text-2xl font-semibold text-gray-900 mb-6">Edit Supplier</h2>

  <form action="{{ route('suppliers.update', $supplier) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div>
      <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
      <input type="text" name="name" id="name" required
             value="{{ old('name', $supplier->name) }}"
             class="w-full border border-gray-300 rounded-md px-3 py-2"
             placeholder="Supplier name">
      @error('name')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Contact -->
    <div>
      <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
      <input type="text" name="contact" id="contact"
             value="{{ old('contact', $supplier->contact) }}"
             class="w-full border border-gray-300 rounded-md px-3 py-2"
             placeholder="Phone or email">
      @error('contact')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Address -->
    <div>
      <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
      <textarea name="address" id="address" rows="3"
                class="w-full border border-gray-300 rounded-md px-3 py-2"
                placeholder="Supplier address">{{ old('address', $supplier->address) }}</textarea>
      @error('address')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Item Type -->
    <div>
      <label for="item_type" class="block text-sm font-medium text-gray-700 mb-1">Item Type</label>
      <input type="text" name="item_type" id="item_type"
             value="{{ old('item_type', $supplier->item_type) }}"
             class="w-full border border-gray-300 rounded-md px-3 py-2"
             placeholder="Type of items supplied">
      @error('item_type')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Buttons -->
    <div class="flex justify-end">
      <a href="{{ route('suppliers.index') }}" 
         class="mr-4 inline-block text-gray-600 hover:text-gray-900">Cancel</a>
      <button type="submit" 
              class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-indigo-700 transition">
        Update
      </button>
    </div>
  </form>
</div>
@endsection
