<form action="{{ route('vip-signups.destroy', $vipSignup) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to remove this VIP signup?') }}');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Delete') }}">
        <i class="bi bi-trash"></i>
    </button>
</form>