<nav x-data="{ open: false }" class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-block" style="height: 36px;" />
        </a>

        <!-- Hamburger -->
        <button @click="open = ! open" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>
            </ul>

            <!-- Settings Dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="btn btn-link nav-link dropdown-toggle" type="button">
                                {{ Auth::user()->name }}
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </li>
            </ul>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'show': open}" class="collapse navbar-collapse d-lg-none" id="navbarNavMobile">
            <ul class="list-group list-group-flush">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </ul>

            <!-- Responsive Settings Options -->
            <div class="border-top mt-3 pt-3">
                <div class="px-3 mb-2">
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <div class="small text-muted">{{ Auth::user()->email }}</div>
                </div>

                <ul class="list-group list-group-flush">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
