<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Admin Menu -->
            @if(Auth::guard('admin')->check())
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown-link :href="route('admin.roles.index')">{{ __('Roles') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('admin.users.index')">{{ __('Users') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('admin.products.index')">{{ __('Products') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('admin.category.index')">{{ __('Category') }}</x-dropdown-link>
                </div>
            @endif

            <!-- Normal User Menu -->
            @if(Auth::guard('web')->check() )
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown-link :href="route('products.index')">{{ __('Products') }}</x-dropdown-link>
                </div>
            @endif

            <!-- Profile & Logout -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                @if(Auth::guard('admin')->check())
                                    {{ Auth::guard('admin')->user()->name }}
                                @else
                                    {{ Auth::user()->name }}
                                @endif
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::guard('admin')->check())
                            <!-- Admin Profile Link -->
                            <x-dropdown-link :href="route('admin.profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        @else
                            <!-- Normal User Profile Link -->
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        @endif

                        <form method="POST" action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="Auth::guard('admin')->check() ? route('admin.logout') : route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
