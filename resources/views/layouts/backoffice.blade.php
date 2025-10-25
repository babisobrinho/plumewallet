<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials.head')
<body class="font-sans antialiased">
    <x-banner />

    <div class="flex bg-gray-100 dark:bg-gray-800">
        <!-- Sidebar -->
        @include('layouts.partials.backoffice-sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen justify-between">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-900 shadow">
                @if (isset($header))
                    {{ $header }}
                @endif
            </header>

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            @include('layouts.partials.backoffice-footer')
        </div>

        @stack('modals')

        @livewireScripts
    </div>
</body>
</html>
