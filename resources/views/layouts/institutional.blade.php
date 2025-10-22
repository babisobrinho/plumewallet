<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <!-- Theme Management Script -->
        @include('layouts.partials.theme-script')
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <x-institutional-navbar />

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <div class="flex justify-center mb-4">
                            <div class="flex items-center gap-2">
                                <x-application-mark class="h-8 w-8" />
                                <span class="text-lg font-bold text-gray-900 dark:text-white">PlumeWallet</span>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                            {{ __('institutional.footer.description') }}
                        </p>
                        <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('institutional.footer.rights_reserved') }}
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
