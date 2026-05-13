@extends('layouts.admin')
 
@section('title', 'Products')
 
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Product
        </a>
    </div>
 
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                {{-- ✅ FIX: Image sahi dikhegi ab --}}
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" width="50" alt="{{ $product->name }}" style="max-height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>₨{{ number_format($product->price, 0) }}</td>
                            <td>
                                @if($product->sale_price)
                                    ₨{{ number_format($product->sale_price, 0) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->category }}</td>
                            <td>
                                @if($product->is_featured)
                                    <span class="badge bg-success">Featured</span>
                                @else
                                    <span class="badge bg-secondary">Not Featured</span>
                                @endif
                            </td>
                            <td>
                                {{-- ✅ FIX: slug ki jagah id use ho raha hai --}}
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary btn-edit" data-url="{{ route('admin.products.edit', $product->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No products found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
 
@section('scripts')
    <script>
        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            const url = $(this).data('url');
            window.location.href = url;
        });
 
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this product?')) {
                const form = $(this).closest('form');
                form.submit();
            }
        });
    </script>
@endsection
 