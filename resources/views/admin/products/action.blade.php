<div class="btn-group" role="group">
    <a href="{{ route('admin.products.edit', $data->id) }}" class="btn btn-sm btn-primary btn-edit" data-url="{{ route('admin.products.edit', $data->id) }}">
        <i class="fas fa-edit"></i> Edit
    </a>
    <form method="POST" action="{{ route('admin.products.destroy', $data->id) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger btn-delete">
            <i class="fas fa-trash"></i> Delete
        </button>
    </form>
</div>
