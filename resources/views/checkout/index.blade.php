@extends('layouts.app')

@section('title', 'Checkout - LUXÉ CHRONO')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4" style="font-family: 'Playfair Display', serif; font-size: 2.2rem;">Complete Your Order</h1>

        <div class="row">
            <!-- Order Summary -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Timepiece</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach($cart as $productId => $item)
                                        @php
                                            $itemSubtotal = $item['price'] * $item['quantity'];
                                            $subtotal += $itemSubtotal;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $item['image']) }}" width="40" class="rounded me-2">
                                                    {{ $item['name'] }}
                                                </div>
                                            </td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>₨{{ number_format($item['price'], 0) }}</td>
                                            <td>₨{{ number_format($itemSubtotal, 0) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Form -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Shipping Address</h5>
                        <form id="checkout-form" method="POST" action="{{ route('checkout.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ auth()->user()->name }}" required>
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="3" required></textarea>
                                @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                               id="city" name="city" required>
                                        @error('city') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ auth()->user()->phone }}" required>
                                        @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment Method</h5>
                        <form id="payment-form">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">
                                    Cash on Delivery (COD)
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       id="credit_card" value="credit_card" disabled>
                                <label class="form-check-label" for="credit_card">
                                    Credit Card (Coming Soon)
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Total -->
            <div class="col-lg-4">
                <div class="card sticky-top">
                    <div class="card-body">
                        <h5 class="card-title">Order Total</h5>
                        <hr>

                        @php
                            $shipping = 500;
                            $total = $subtotal + $shipping;
                        @endphp

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>₨{{ number_format($subtotal, 0) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping:</span>
                            <span>₨{{ number_format($shipping, 0) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total:</span>
                            <span class="fw-bold price-current h5">₨{{ number_format($total, 0) }}</span>
                        </div>

                        <button type="button" class="btn w-100 btn-lg" style="background-color: var(--primary-color); color: var(--dark-color); font-weight: 700;" onclick="submitCheckout()">
                            <i class="fas fa-check me-2"></i>Place Order
                        </button>

                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function submitCheckout() {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            const form = document.getElementById('checkout-form');
            
            // Add payment method to form
            const paymentInput = document.createElement('input');
            paymentInput.type = 'hidden';
            paymentInput.name = 'payment_method';
            paymentInput.value = paymentMethod;
            form.appendChild(paymentInput);
            
            form.submit();
        }
    </script>
@endsection
