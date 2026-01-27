<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h3 mb-2 fw-bold">{{ __('Forgot Password?') }}</h1>
        <p class="text-muted small mb-0">
            {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="d-grid gap-2 mb-3">
            <x-primary-button class="w-100">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <div class="text-center">
            <a class="text-decoration-none small" href="{{ route('login') }}">
                {{ __('Back to login') }}
            </a>
        </div>
    </form>
</x-guest-layout>