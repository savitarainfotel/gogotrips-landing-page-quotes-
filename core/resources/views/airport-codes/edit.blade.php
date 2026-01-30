<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Edit Airport Code') }}
            </h2>
            <a href="{{ route('airport-codes.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                {{ __('Back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-lg-8 col-xl-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4 p-md-5">
                            @include('airport-codes.partials.form', [
                                'action' => route('airport-codes.update', $airportCode),
                                'method' => 'PUT',
                                'airportCode' => $airportCode,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
