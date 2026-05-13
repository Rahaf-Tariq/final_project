@extends('layouts.app')

@section('title', 'Order Confirmed - LUXÉ CHRONO')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="mb-4">
                    <i class="fas fa-check-circle" style="font-size: 80px; color: var(--primary-color);"></i>
                </div>

                <h1 class="mb-3" style="font-family: 'Playfair Display', serif; font-size: 2.2rem;">Order Confirmed!</h1>
                <p class="lead text-muted mb-4">Thank you for your purchase. Your luxury timepiece order has been received and is being processed.</p>

                <div class="card mb-4">
                    <div class="card-body text-start">
                        <h5 class="card-title">Order Details</h5>
                        <table class="table">
                            <tr>
                                <th>Order ID:</th>
                                <td><strong>#{{ $order->id }}</strong></td>
                            </tr>
                            <tr>
                                <th>Order Date:</th>
                                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-warning">{{ ucfirst($order->status) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Payment Method:</th>
                                <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                            </tr>
                            <tr>
                                <th>Total Amount:</th>
                                <td><strong class="price-current">₨{{ number_format($order->total_amount, 0) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Shipping Address:</th>
                                <td>{{ $order->shipping_address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body text-start">
                        <h5 class="card-title">Items Ordered</h5>
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Timepiece</th>
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
                                        <td>₨{{ number_format($item->unit_price, 0) }}</td>
                                        <td>₨{{ number_format($item->unit_price * $item->quantity, 0) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="alert alert-info">
                    <p class="mb-0">A confirmation email has been sent to <strong>{{ auth()->user()->email }}</strong>. You can track your order status anytime.</p>
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('home') }}" class="btn btn-lg" style="background-color: var(--primary-color); color: var(--dark-color); font-weight: 700;">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
