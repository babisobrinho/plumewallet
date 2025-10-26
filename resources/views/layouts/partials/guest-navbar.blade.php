<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('homepage.show') }}" class="flex items-center gap-3">
                        <x-logo class="h-8 w-8" />
                        <span class="text-xl font-bold text-gray-900 dark:text-white">PlumeWallet</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('homepage.show') }}" :active="request()->routeIs('homepage.show')">
                        {{ __('guest.navigation.home') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('how-it-works.show') }}" :active="request()->routeIs('how-it-works.show')">
                        {{ __('guest.footer.how_it_works') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('about-us.show') }}" :active="request()->routeIs('about-us.show')">
                        {{ __('guest.footer.about_us') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('blog.index') }}" :active="request()->routeIs('blog.*')">
                        {{ __('guest.blog.title') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- User Dropdown -->
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center gap-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <img class="size-8 rounded-full object-cover border-2 border-gray-300 dark:border-white mr-1" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        @endif

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
                                    {{ __('guest.navigation.account') }}
                                </div>

                                <x-dropdown-link href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}">
                                    {{ __('guest.navigation.dashboard') }}
                                </x-dropdown-link>

                                <x-dropdown-link href="{{ Auth::user()->isStaff() ? route('backoffice.profile.show') : route('app.profile.show') }}">
                                    {{ __('guest.navigation.profile') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                             @click.prevent="$root.submit();">
                                        {{ __('guest.navigation.log_out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth

                @guest
                    <x-link href="{{ route('login') }}" class="me-2">
                        {{ __('guest.navigation.log_in') }}
                    </x-link>
                    <x-link href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white">
                        {{ __('guest.navigation.register') }}
                    </x-link>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @guest
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('homepage.show') }}" :active="request()->routeIs('homepage.show')">
                    {{ __('guest.navigation.home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('how-it-works.show') }}" :active="request()->routeIs('how-it-works.show')">
                    {{ __('guest.footer.how_it_works') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('about-us.show') }}" :active="request()->routeIs('about-us.show')">
                    {{ __('guest.footer.about_us') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('blog.index') }}" :active="request()->routeIs('blog.*')">
                    {{ __('guest.blog.title') }}
                </x-responsive-nav-link>
            </div>
        @endguest

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}" :active="false">
                        {{ __('guest.navigation.dashboard') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link href="{{ Auth::user()->isStaff() ? route('backoffice.profile.show') : route('app.profile.show') }}" :active="false">
                        {{ __('guest.navigation.profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}"
                                       @click.prevent="$root.submit();">
                            {{ __('guest.navigation.log_out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4 space-y-2">
                    <x-link href="{{ route('login') }}" class="block text-center">
                        {{ __('guest.navigation.log_in') }}
                    </x-link>
                    <x-link href="{{ route('register') }}" class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white">
                        {{ __('guest.navigation.register') }}
                    </x-link>
                </div>
            </div>
        @endguest
    </div>
</nav>
