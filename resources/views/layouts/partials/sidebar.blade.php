<div class="w-64 bg-gray-900 text-white dark:bg-gray-900 dark:text-gray-100">
    <div class="p-6">
        <h1 class="text-xl font-bold">{{ config('app.name') }}</h1>
        <p class="text-gray-400 text-sm">{{ __('common.navigation.backoffice') }}</p>
    </div>

    <nav class="mt-6">
        <!-- PRINCIPAL Section -->
        <div class="px-4 mb-4">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">{{ __('common.navigation.main') }}</h3>
            <div class="space-y-1">
                <a href="{{ route('backoffice.dashboard.show') }}"
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-md
                   {{ request()->routeIs('backoffice.dashboard.show') ? 'bg-blue-600 text-white' :
                    'text-gray-300 hover:bg-gray-700 hover:text-white dark:text-gray-300 dark:hover:bg-gray-800' }}">
                    <i class="ti ti-home mr-3 h-5 w-5"></i>
                    {{ __('common.navigation.dashboard') }}
                </a>
            </div>
        </div>

        <!-- GESTÃO Section -->
        <div class="px-4 mb-4">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">{{ __('common.navigation.management') }}</h3>
            <div class="space-y-1">
                <a href="{{ route('backoffice.users.index') }}"
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-md
                   {{ request()->routeIs('backoffice.users.*') ? 'bg-blue-600 text-white' :
                    'text-gray-300 hover:bg-gray-700 hover:text-white dark:text-gray-300 dark:hover:bg-gray-800' }}">
                    <i class="ti ti-users mr-3 h-5 w-5"></i>
                    {{ __('common.navigation.users') }}
                </a>
            </div>
        </div>
    </nav>
</div>
