@extends('layouts.app')

@section('title', 'Shopping Cart - LUXÉ CHRONO')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4" style="font-family: 'Playfair Display', serif; font-size: 2.2rem;">Your Cart</h1>

        @if(empty($cart))
            <div class="alert alert-info">
                Your cart is empty. <a href="{{ route('products.index') }}">Continue shopping</a>
            </div>
        @else
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Timepiece</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $productId => $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $item['image']) }}" 
                                                     alt="{{ $item['name'] }}" 
                                                     style="width: 80px; height: 80px; object-fit: cover;" 
                                                     class="rounded me-3">
                                                <div>
                                                    <a href="{{ route('products.show', $item['slug']) }}" style="color: var(--primary-color); text-decoration: none;">
                                                        {{ $item['name'] }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price-current">₨{{ number_format($item['price'], 0) }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('cart.update') }}" class="d-inline" style="display: flex; gap: 5px;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                       min="1" class="form-control" style="width: 70px;">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">Update</button>
                                            </form>
                                        </td>
                                        <td class="fw-bold price-current">₨{{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('cart.remove') }}" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                        <form method="POST" action="{{ route('cart.clear') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Clear Cart</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <hr>

                            @php
                                $subtotal = 0;
                                foreach($cart as $item) {
                                    $subtotal += $item['price'] * $item['quantity'];
                                }
                                $shipping = 500;
                                $total = $subtotal + $shipping;
                            @endphp

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>₨{{ number_format($subtotal, 0) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Shipping Fee:</span>
                                <span>₨{{ number_format($shipping, 0) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Grand Total:</span>
                                <span class="fw-bold price-current h5">₨{{ number_format($total, 0) }}</span>
                            </div>

                            @auth
                                <a href="{{ route('checkout.index') }}" class="btn w-100" style="background-color: var(--primary-color); color: var(--dark-color); font-weight: 700;">
                                    Proceed to Checkout
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn w-100" style="background-color: var(--primary-color); color: var(--dark-color); font-weight: 700;">
                                    Login to Checkout
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection