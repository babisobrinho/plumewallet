<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials.head')
<body class="font-sans antialiased">
    <x-banner />

    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-800">
        <!-- Sidebar -->
        <x-sidebar-partial />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-900 shadow">
                @if (isset($header))
                    {{ $header }}
                @endif
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </div>
</body>
</html>
