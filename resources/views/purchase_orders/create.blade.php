@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Purchase Order</h1>
    
    <form method="POST" action="{{ route('purchase-orders.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="supplier_id">Supplier</label>
            <select class="form-control" id="supplier_id" name="supplier_id" required>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="card mb-3">
            <div class="card-header">Items</div>
            <div class="card-body" id="items-container">
                <div class="row item-row mb-2">
                    <div class="col-md-5">
                        <select class="form-control product-select" name="items[0][product_id]" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="items[0][quantity]" placeholder="Qty" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="items[0][unit_price]" placeholder="Unit Price" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-item">X</button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-secondary" id="add-item">Add Item</button>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Purchase Order</button>
    </form>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function() {
        const container = document.getElementById('items-container');
        const index = container.querySelectorAll('.item-row').length;
        const template = `
        <div class="row item-row mb-2">
            <div class="col-md-5">
                <select class="form-control product-select" name="items[${index}][product_id]" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" name="items[${index}][quantity]" placeholder="Qty" min="1" required>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" name="items[${index}][unit_price]" placeholder="Unit Price" step="0.01" min="0" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-item">X</button>
            </div>
        </div>`;
        
        container.insertAdjacentHTML('beforeend', template);
    });

    document.getElementById('items-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            if (document.querySelectorAll('.item-row').length > 1) {
                e.target.closest('.item-row').remove();
            } else {
                alert('At least one item is required');
            }
        }
    });
</script>
@endsection