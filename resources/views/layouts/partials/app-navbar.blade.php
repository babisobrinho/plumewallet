<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @auth
                        <a href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}">
                            <x-logo class="block h-9 w-auto" />
                        </a>
                    @else
                        <a href="{{ route('homepage.show') }}">
                            <x-logo class="block h-9 w-auto" />
                        </a>
                    @endauth
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @guest
                        <x-nav-link href="{{ route('homepage.show') }}" :active="request()->routeIs('homepage.show')">
                            {{ __('common.navigation.home') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('how-it-works.show') }}" :active="request()->routeIs('how-it-works.show')">
                            {{ __('guest.footer.how_it_works') }}
                        </x-nav-link>
                    @endguest
                    @auth
                        <x-nav-link
                                href="{{ route('app.dashboard.show') }}"
                                :active="request()->routeIs('app.dashboard.show')"
                        >
                            {{ __('common.navigation.dashboard') }}
                        </x-nav-link>
                        <x-nav-link
                            href="{{ route('app.transactions.index') }}"
                            :active="request()->routeIs('app.transactions.*')"
                        >
                            {{ __('common.navigation.transactions') }}
                        </x-nav-link>
                        <x-nav-link
                            href="{{ route('app.beneficiaries.index') }}"
                            :active="request()->routeIs('app.beneficiaries.*')"
                        >
                            {{ __('common.navigation.beneficiaries') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @roletype('client')
                    <!-- Teams Dropdown -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            {{ Auth::user()->currentTeam?->name ?? __('common.navigation.no_team') }}

                                            <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('common.navigation.manage_team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        @if(Auth::user()->currentTeam)
                                            <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('common.navigation.team_settings') }}
                                        </x-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('common.navigation.create_new_team') }}
                                            </x-dropdown-link>
                                        @endcan

                                        <!-- Team Switcher -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('common.navigation.switch_teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        @endif
                                        @endif
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif
                @endroletype

                @auth
                    <!-- Settings Dropdown -->
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
                                    {{ __('common.navigation.manage_account') }}
                                </div>

                                <x-dropdown-link href="{{ Auth::user()->isStaff() ? route('backoffice.profile.show') : route('app.profile.show') }}">
                                    {{ __('common.navigation.profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('common.navigation.api_tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                             @click.prevent="$root.submit();">
                                        {{ __('common.navigation.log_out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth

                @guest
                    <x-link href="{{ route('login') }}" class="me-2">
                        {{ __('common.navigation.log_in') }}
                    </x-link>
                    <x-link href="{{ route('register') }}" class="bg-indigo-500 hover:bg-indigo-400 dark:bg-indigo-400 dark:hover:bg-indigo-500">
                        {{ __('common.navigation.register') }}
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
                <x-responsive-nav-link
                    href="{{ route('homepage.show') }}"
                    :active="request()->routeIs('homepage.show')"
                >
                    {{ __('common.navigation.home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link
                    href="{{ route('how-it-works.show') }}"
                    :active="request()->routeIs('how-it-works.show')"
                >
                    {{ __('guest.footer.how_it_works') }}
                </x-responsive-nav-link>
            </div>
        @endguest

        @auth
            <div class="pt-2 pb-3 space-y-1">
                @if(Auth::user()->isStaff())
                    <x-responsive-nav-link
                        href="{{ route('backoffice.dashboard.show') }}"
                        :active="request()->routeIs('backoffice.dashboard.show')"
                    />
                @else
                    <x-responsive-nav-link
                        href="{{ route('app.dashboard.show') }}"
                        :active="request()->routeIs('app.dashboard.show')"
                    >
                        {{ __('common.navigation.dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link
                        href="{{ route('app.transactions.index') }}"
                        :active="request()->routeIs('app.transactions.*')"
                    >
                        {{ __('common.navigation.transactions') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link
                        href="{{ route('app.beneficiaries.index') }}"
                        :active="request()->routeIs('app.beneficiaries.*')"
                    >
                        {{ __('common.navigation.beneficiaries') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        @endauth

        @roletype('client')
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
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('common.navigation.profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('common.navigation.api_tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}"
                                       @click.prevent="$root.submit();">
                            {{ __('common.navigation.log_out') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('common.navigation.manage_team') }}
                        </div>

                        <!-- Team Settings -->
                        @if(Auth::user()->currentTeam)
                            <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                            {{ __('common.navigation.team_settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('common.navigation.create_new_team') }}
                            </x-responsive-nav-link>
                        @endcan

                        <!-- Team Switcher -->
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('common.navigation.switch_teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                        @endif
                    @endif
                </div>
            </div>
        @endroletype
    </div>
</nav>
