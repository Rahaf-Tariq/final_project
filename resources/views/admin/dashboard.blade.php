@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-box fa-3x text-primary mb-3"></i>
                <div class="value">{{ $totalProducts }}</div>
                <div class="label">Total Products</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-shopping-cart fa-3x text-success mb-3"></i>
                <div class="value">{{ $totalOrders }}</div>
                <div class="label">Total Orders</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-dollar-sign fa-3x text-warning mb-3"></i>
                <div class="value">${{ number_format($totalRevenue, 2) }}</div>
                <div class="label">Total Revenue</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-users fa-3x text-info mb-3"></i>
                <div class="value">{{ $totalUsers }}</div>
                <div class="label">Total Users</div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Quick Actions</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus me-2"></i>Add Product
                    </a>
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-user-plus me-2"></i>Add Admin
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-list me-2"></i>View Products
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-shopping-cart me-2"></i>View Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
