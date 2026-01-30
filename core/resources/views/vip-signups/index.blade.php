<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 fw-bold">
            {{ __('VIP Signups') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    <span>{{ session('status') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-person-badge me-2"></i>
                                All VIP Signups
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table table-striped table-hover w-100']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {!! $dataTable->scripts() !!}
    @endpush
</x-app-layout>
