@props([
    'title',
    'subtitle' => null,
])
<div class="flex items-center justify-between px-6 py-4">
    <div>
        @if($title)
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                {{ $title }}
            </h1>
        @endif

        @if($subtitle)
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $subtitle }}
            </p>
        @endif
    </div>

    @auth
        <div class="flex items-center space-x-4">
            <!-- Settings Dropdown -->
            <div class="ms-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center gap-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-900 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                {{ Auth::user()->name }}
                                <svg class="-me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('backoffice.profile.show') }}">
                            {{ __('profile.profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    @endauth
</div>
