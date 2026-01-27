<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Bookings & Trips') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-calendar-check me-2"></i>
                                All Bookings
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