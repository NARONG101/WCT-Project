<!-- resources/views/supplier/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Supplier')
@section('content')
<h1 class="text-xl font-bold mb-4">Edit Supplier</h1>

<form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Name:</label>
        <input type="text" name="name" class="border p-2 w-full" value="{{ $supplier->name }}" required>
    </div>
    <div>
        <label>Contact:</label>
        <input type="text" name="contact" class="border p-2 w-full" value="{{ $supplier->contact }}" required>
    </div>
    <div>
        <label>Address:</label>
        <textarea name="address" class="border p-2 w-full" required>{{ $supplier->address }}</textarea>
    </div>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
