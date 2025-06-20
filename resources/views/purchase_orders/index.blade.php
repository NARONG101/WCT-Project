@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchase Orders</h1>
    <a href="{{ route('purchase-orders.create') }}" class="btn btn-primary mb-3">Create PO</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>PO Number</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->po_number }}</td>
                <td>{{ $order->supplier->name }}</td>
                <td>
                    <span class="badge badge-{{ $order->status == 'Pending' ? 'warning' : 'success' }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="{{ route('purchase-orders.show', $order) }}" class="btn btn-sm btn-info">
                        View
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection