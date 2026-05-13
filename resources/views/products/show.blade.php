 
@extends('layouts.app')
 
@section('title', $product->name . ' - LUXÉ CHRONO')
 
@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-4">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%); padding: 40px; border-radius: 10px;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 400px;">
                        <i class="fas fa-image fa-5x text-muted"></i>
                    </div>
                @endif
            </div>
 
            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="card border-0">
                    <div class="card-body">
                        <h1 class="card-title mb-2" style="font-family: 'Playfair Display', serif; font-size: 2.2rem;">{{ $product->name }}</h1>
                        <div class="mb-3">
                            <span class="badge" style="background-color: var(--primary-color); color: var(--dark-color);">{{ $product->category }}</span>
                        </div>
 
                        <!-- Rating -->
                        <div class="mb-3">
                            <i class="fas fa-star" style="color: var(--primary-color);"></i>
                            <i class="fas fa-star" style="color: var(--primary-color);"></i>
                            <i class="fas fa-star" style="color: var(--primary-color);"></i>
                            <i class="fas fa-star" style="color: var(--primary-color);"></i>
                            <i class="fas fa-star-half" style="color: var(--primary-color);"></i>
                            <span class="text-muted ms-2">(125 Reviews)</span>
                        </div>
 
                        <!-- Price -->
                        <div class="mb-4">
                            @if($product->sale_price)
                                <p class="text-muted"><s>₨{{ number_format($product->price, 0) }}</s></p>
                                <h2 class="price-current">₨{{ number_format($product->sale_price, 0) }}</h2>
                                <span class="badge bg-danger">SALE</span>
                            @else
                                <h2 class="price-current">₨{{ number_format($product->price, 0) }}</h2>
                            @endif
                        </div>
 
                        <!-- Description -->
                        <p class="text-muted mb-4">{{ $product->description }}</p>
 
                        <!-- Stock Status -->
                        <div class="mb-4">
                            @if($product->stock > 0)
                                <span class="badge bg-success">In Stock</span>
                                <small class="text-muted">({{ $product->stock }} available)</small>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </div>
 
                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width: 100px;">
                        </div>
 
                        <div class="d-flex gap-2">
                            @if($product->stock > 0)
                                <button type="button" class="btn btn-lg" style="background-color: var(--primary-color); color: var(--dark-color); font-weight: 700;" onclick="addToCart()">
                                    <i class="fas fa-plus me-2"></i>Add to Cart
                                </button>
                                <button type="button" class="btn btn-lg btn-outline-secondary" style="border-color: var(--primary-color); color: var(--primary-color); font-weight: 700;" onclick="buyNow()">
                                    <i class="fas fa-bolt me-2"></i>Buy Now
                                </button>
                            @else
                                <button type="button" class="btn btn-lg btn-secondary" disabled>
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="mb-4">Related Products</h3>
                </div>
                @foreach($relatedProducts as $related)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card product-card h-100">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="card-img-top product-image">
                            @else
                                <div class="card-img-top product-image d-flex align-items-center justify-content-center bg-light">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $related->name }}</h5>
                                <div>
                                    @if($related->sale_price)
                                        <h6 class="price-current">₨{{ number_format($related->sale_price, 0) }}</h6>
                                    @else
                                        <h6 class="price-current">₨{{ number_format($related->price, 0) }}</h6>
                                    @endif
                                </div>
                                {{-- ✅ FIX: Slug se link --}}
                                <a href="{{ route('products.show', $related->slug) }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
 
@section('scripts')
    <script>
        function addToCart() {
            const productId = {{ $product->id }};
            const quantity = document.getElementById('quantity').value;
 
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId, quantity: parseInt(quantity) })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartBadge();
                    alert(data.message);
                }
            });
        }
 
        // ✅ FIX: Buy Now - cart mein add karke seedha checkout par
        function buyNow() {
            const productId = {{ $product->id }};
            const quantity = document.getElementById('quantity').value;
 
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId, quantity: parseInt(quantity) })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route("checkout.index") }}';
                } else {
                    alert('Something went wrong. Please try again.');
                }
            });
        }
    </script>
@endsection
 