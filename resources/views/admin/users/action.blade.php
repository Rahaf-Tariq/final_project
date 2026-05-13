<div class="btn-group" role="group">
    <a href="{{ route('admin.users.show', $data->id) }}" class="btn btn-sm btn-info btn-view" data-url="{{ route('admin.users.show', $data->id) }}">
        <i class="fas fa-eye"></i> View Orders
    </a>
    <form method="POST" action="{{ route('admin.users.destroy', $data->id) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger btn-delete">
            <i class="fas fa-trash"></i> Delete
        </button>
    </form>
</div>
