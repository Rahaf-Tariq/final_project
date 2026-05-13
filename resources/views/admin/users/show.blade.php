@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $user->name }}</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Information</h5>
                    <table class="table table-sm">
                        <tr>
                            <th>ID:</th>
                            <td>#{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ $user->address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Registered:</th>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Total Orders:</th>
                            <td><span class="badge bg-primary">{{ $user->orders->count() }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}">#{{ $order->id }}</a>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>{{ $order->orderItems->count() }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            @php
                                                $colors = [
                                                    'pending' => 'warning',
                                                    'processing' => 'info',
                                                    'shipped' => 'primary',
                                                    'delivered' => 'success',
                                                    'cancelled' => 'danger',
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $colors[$order->status] }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No orders found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
