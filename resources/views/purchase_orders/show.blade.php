@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchase Order: {{ $purchaseOrder->po_number }}</h1>
    
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Supplier:</strong> {{ $purchaseOrder->supplier->name }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> 
                        <span class="badge badge-{{ $purchaseOrder->status == 'Pending' ? 'warning' : 'success' }}">
                            {{ $purchaseOrder->status }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <h3>Items</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseOrder->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($purchaseOrder->status == 'Pending')
    <form method="POST" action="{{ route('purchase-orders.receive', $purchaseOrder) }}">
        @csrf
        <button type="submit" class="btn btn-success">Receive Stock</button>
    </form>
    @endif
</div>
@endsection