<div class="btn-group" role="group">
    <a href="{{ route('airport-codes.edit', $airportCode) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('airport-codes.destroy', $airportCode) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this airport code?') }}');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>