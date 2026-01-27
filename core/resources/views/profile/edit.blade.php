<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4 p-md-5">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4 p-md-5">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>