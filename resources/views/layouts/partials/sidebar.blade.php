<div class="w-64 bg-gray-950 text-white dark:bg-gray-950 dark:text-gray-100">
    <div class="p-6">
        <h1 class="text-xl font-bold">{{ config('app.name') }}</h1>
        <p class="text-gray-400 text-sm">Backoffice</p>
    </div>

    <nav class="mt-6">
        <div class="px-4">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Principal</h3>
        </div>
        <div class="mt-2">
            <a href="{{ route('backoffice.dashboard.show') }}"
               class="group flex items-center px-4 py-2 text-sm font-medium
               {{ request()->routeIs('backoffice.dashboard.show') ? 'bg-gray-800 text-white dark:bg-gray-900 dark:text-gray-100' :
                'text-gray-300 hover:bg-gray-700 hover:text-white dark:text-gray-300 dark:hover:bg-gray-800' }}">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                Dashboard
            </a>
        </div>
    </nav>
</div>
