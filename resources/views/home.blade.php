@extends('layouts.app')
 
@section('title', 'LUXÉ CHRONO - Luxury Watches')
 
@section('content')
    <!-- Hero Banner -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 hero-content">
                    <h1 class="display-3 fw-bold mb-4">Timeless Elegance</h1>
                    <p class="lead mb-4 fs-5" style="color: #e0e0e0; line-height: 1.8;">Discover the art of precision. Every watch crafted with uncompromising excellence and Swiss-inspired mastery.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-arrow-right me-2"></i>Explore Collection
                    </a>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1523170335258-f5ed11844a49?w=600&h=600&fit=crop" alt="Luxury Watch" style="width: 100%; height: 500px; object-fit: cover; border-radius: 10px; box-shadow: 0 10px 40px rgba(212, 175, 55, 0.3);">
                </div>
            </div>
        </div>
    </section>
 
    <!-- Featured Products Section -->
    <section class="featured-section">
        <div class="container">
            <h2>Featured Timepieces</h2>
            <div class="row g-4">
                @forelse($featuredProducts as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="card product-card h-100">
                            {{-- ✅ FIX: Image sahi dikhegi ab --}}
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top product-image">
                            @else
                                <div class="card-img-top product-image d-flex align-items-center justify-content-center bg-light">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <span class="badge" style="background-color: var(--primary-color); color: var(--dark-color);">{{ $product->category }}</span>
                                <p class="card-text text-muted small">{{ Str::limit($product->description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        @if($product->sale_price)
                                            <small class="price-original">₨{{ number_format($product->price, 0) }}</small><br>
                                            <h6 class="price-current mb-0">₨{{ number_format($product->sale_price, 0) }}</h6>
                                        @else
                                            <h6 class="price-current mb-0">₨{{ number_format($product->price, 0) }}</h6>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm add-to-cart" style="background-color: var(--primary-color); color: var(--dark-color); border: none; font-weight: 700;" data-product-id="{{ $product->id }}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none" style="color: var(--primary-color); font-weight: 600;">View Details →</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No featured products available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
 
    <!-- Luxury Benefits Section -->
    <section class="py-5" style="background: linear-gradient(135deg, var(--dark-color) 0%, #1a1a1a 100%); color: white;">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <i class="fas fa-certificate fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h5 class="fw-bold">Authenticity Guaranteed</h5>
                    <p class="text-muted">100% genuine luxury timepieces with official certification</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-shield fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h5 class="fw-bold">Lifetime Warranty</h5>
                    <p class="text-muted">Comprehensive coverage and dedicated support</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-gift fa-3x mb-3" style="color: var(--primary-color);"></i>
                    <h5 class="fw-bold">Premium Packaging</h5>
                    <p class="text-muted">Luxury unboxing experience with gift wrapping</p>
                </div>
            </div>
        </div>
    </section>
@endsection
 
@section('scripts')
    <script>
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.dataset.productId;
                fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ product_id: productId, quantity: 1 })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartBadge();
                        alert(data.message);
                    }
                });
            });
        });
    </script>
@endsection
 