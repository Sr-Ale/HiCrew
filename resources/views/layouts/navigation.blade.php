@php
    include '../config.php';
@endphp
<style>
    .logos{
        height: 9vh;
        width: auto;
    }
</style>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('index') }}">
                        <img class="logos" src="{{asset('images/logo_va2.png')}}">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(!auth()->check())
                    <x-nav-link :href="route('index')" :active="request()->routeIs('index')">
                        {{ $va_name }}
                    </x-nav-link>
                        <x-nav-link :href="route('rules')" :active="request()->routeIs('rules')">
                            {{ __('messages.rules') }}
                        </x-nav-link>
                    <x-nav-link :href="route('stats')" :active="request()->routeIs('stats')">
                        {{ __('messages.stats') }}
                    </x-nav-link>
                    <x-nav-link :href="route('list')" :active="request()->routeIs('list')">
                        {{ __('messages.list') }}
                    </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('messages.register') }}
                        </x-nav-link>

                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('messages.login') }}
                        </x-nav-link>
                    @else
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('messages.home') }}
                    </x-nav-link>
                        <x-nav-link :href="route('central')" :active="request()->routeIs('central')">
                            {{ __('messages.central') }}
                        </x-nav-link>
                        <x-nav-link :href="route('resources')" :active="request()->routeIs('resources')">
                            {{ __('messages.resources') }}
                        </x-nav-link>
                        <x-nav-link :href="route('academy')" :active="request()->routeIs('academy')">
                            {{ __('messages.academy') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tours')" :active="request()->routeIs('tours')">
                            {{ __('messages.tours') }}
                        </x-nav-link>
                        <x-nav-link :href="route('fleet')" :active="request()->routeIs('fleet')">
                            {{ __('messages.fleet') }}
                        </x-nav-link>
                        <x-nav-link :href="route('rules')" :active="request()->routeIs('rules')">
                            {{ __('messages.rules') }}
                        </x-nav-link>
                        <x-nav-link :href="route('stats')" :active="request()->routeIs('stats')">
                            {{ __('messages.stats') }}
                        </x-nav-link>
                        <x-nav-link :href="route('list')" :active="request()->routeIs('list')">
                            {{ __('messages.list') }}
                        </x-nav-link>
                        @if(Auth::user()->permission())
                            @if(Auth::user()->permission()->staff)
                                <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                                    {{ __('messages.admin') }}
                                </x-nav-link>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
            @if(auth()->check())
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('messages.profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('messages.edit_profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('messages.exit_profile') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endif
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @if(auth()->check())
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
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
            </div>
        </div>
        @endif
    </div>
</nav>
