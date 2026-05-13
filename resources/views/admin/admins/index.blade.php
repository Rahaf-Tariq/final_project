@extends('layouts.admin')

@section('title', 'Admins')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Admins</h1>
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Admin
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-primary btn-edit" data-url="{{ route('admin.admins.edit', $admin->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display: inline;">
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
                            <td colspan="5" class="text-center">No admins found</td>
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
            if (confirm('Are you sure?')) {
                const form = $(this).closest('form');
                form.submit();
            }
        });
    </script>
@endsection
