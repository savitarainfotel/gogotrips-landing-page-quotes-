<x-guest-layout>
    <div class="text-center mb-4">
        <h1 class="h3 mb-2 fw-bold">{{ __('Create Account') }}</h1>
        <p class="text-muted small">{{ __('Sign up to get started') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="d-grid gap-2 mb-3">
            <x-primary-button class="w-100">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="text-center">
            <a class="text-decoration-none small" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>