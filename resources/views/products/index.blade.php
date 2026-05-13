@extends('layouts.app')
 
@section('title', 'Luxury Watches - LUXÉ CHRONO')
 
@section('content')
    <div class="container py-5">
        <h1 class="mb-4" style="font-family: 'Playfair Display', serif; font-size: 2.5rem;">Our Collection</h1>
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Filters</h5>
                        <form method="GET" action="{{ route('products.index') }}">
                            <!-- Category Filter -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Categories</label>
                                @foreach($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="category[]" 
                                               value="{{ $category }}" id="cat_{{ $category }}"
                                               {{ in_array($category, request()->input('category', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cat_{{ $category }}">
                                            {{ $category }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
 
                            <!-- Price Range -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price Range (PKR)</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" name="min_price" class="form-control form-control-sm"
                                               placeholder="Min" value="{{ request('min_price') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max_price" class="form-control form-control-sm"
                                               placeholder="Max" value="{{ request('max_price') }}">
                                    </div>
                                </div>
                            </div>
 
                            <!-- Sort -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Sort By</label>
                                <select name="sort" class="form-select form-select-sm">
                                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="featured" {{ request('sort') === 'featured' ? 'selected' : '' }}>Featured</option>
                                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                            </div>
 
                            <button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">Clear Filters</a>
                        </form>
                    </div>
                </div>
            </div>
 
            <!-- Product Grid -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @forelse($products as $product)
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
                                    <span class="badge mb-2" style="background-color: var(--primary-color); color: var(--dark-color);">{{ $product->category }}</span>
                                    <div class="mb-2">
                                        <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                        <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                        <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                        <i class="fas fa-star" style="color: var(--primary-color);"></i>
                                        <i class="fas fa-star-half" style="color: var(--primary-color);"></i>
                                    </div>
                                    <div>
                                        @if($product->sale_price)
                                            <small class="text-muted"><s>₨{{ number_format($product->price, 0) }}</s></small><br>
                                            <h6 class="price-current">₨{{ number_format($product->sale_price, 0) }}</h6>
                                        @else
                                            <h6 class="price-current">₨{{ number_format($product->price, 0) }}</h6>
                                        @endif
                                    </div>
                                    <div class="mt-3 d-flex gap-2">
                                        <button class="btn btn-sm flex-grow-1 add-to-cart" style="background-color: var(--primary-color); color: var(--dark-color); border: none; font-weight: 600;" data-product-id="{{ $product->id }}">
                                            <i class="fas fa-plus"></i> Add to Cart
                                        </button>
                                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No products found.</p>
                        </div>
                    @endforelse
                </div>
 
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
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
 