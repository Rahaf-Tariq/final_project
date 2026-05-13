@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Order Information</h5>
                    <table class="table">
                        <tr>
                            <th>Order ID:</th>
                            <td>#{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Customer:</th>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $order->user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Order Date:</th>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <form method="POST" action="{{ route('admin.orders.update', $order->id) }}" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>Payment Method:</th>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Address:</th>
                            <td>{{ $order->shipping_address }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Items</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->unit_price, 2) }}</td>
                                        <td>${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    @php
                        $subtotal = $order->orderItems->sum(fn($item) => $item->unit_price * $item->quantity);
                        $shipping = 10;
                    @endphp
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping:</span>
                        <span>${{ number_format($shipping, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total:</span>
                        <span class="fw-bold text-primary">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
