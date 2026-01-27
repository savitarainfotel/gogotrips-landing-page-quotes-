<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h3 mb-2 fw-bold">{{ __('Welcome Back') }}</h1>
        <p class="text-muted small">{{ __('Sign in to your account') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="mb-4 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="d-grid gap-2 mb-3">
            <x-primary-button class="w-100">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        @if (Route::has('password.request'))
            <div class="text-center">
                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>