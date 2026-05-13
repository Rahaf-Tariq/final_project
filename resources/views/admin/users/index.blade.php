@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <h1 class="mb-4">Users</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info btn-view" data-url="{{ route('admin.users.show', $user->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
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
                            <td colspan="6" class="text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.btn-view', function(e) {
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
