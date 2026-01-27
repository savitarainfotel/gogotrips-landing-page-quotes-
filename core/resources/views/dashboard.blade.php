<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="card-title h5 mb-2">{{ __('Welcome!') }}</h3>
                                    <p class="card-text text-muted mb-0">
                                        {{ __("You're logged in!") }}
                                    </p>
                                </div>
                                <div class="ms-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-success" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.203l1.07-3.627a.68.68 0 0 1 .202-.416.647.647 0 0 1 .411-.23l.352-.008a.646.646 0 0 1 .478.216z"/>
                                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>