@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <h1 class="mb-4">Orders</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>₨{{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <select class="form-select form-select-sm status-select" data-order-id="{{ $order->id }}">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                            <td>{{ $order->payment_method ?? 'N/A' }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info btn-view" data-url="{{ route('admin.orders.show', $order->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.btn-view', function() {
            const url = $(this).data('url');
            window.location.href = url;
        });

        $(document).on('change', '.status-select', function() {
            const orderId = $(this).data('order-id');
            const status = $(this).val();
            
            $.ajax({
                url: '/admin/orders/' + orderId,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { status: status },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        });
    </script>
@endsection
