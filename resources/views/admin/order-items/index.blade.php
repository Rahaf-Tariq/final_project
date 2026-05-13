@extends('layouts.admin')

@section('title', 'Order Items')

@section('content')
    <h1 class="mb-4">Order Items</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orderItems as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₨{{ number_format($item->unit_price, 2) }}</td>
                            <td>₨{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No order items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
