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
            <footer class="bg-gray-800 border-t border-gray-700">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Plume Wallet Column -->
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-bold text-white mb-4">{{ __('institutional.footer.plume_wallet') }}</h3>
                            <p class="text-gray-300 text-sm leading-relaxed">
                                {{ __('institutional.footer.description') }}
                            </p>
                        </div>

                        <!-- Produto Column -->
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4">{{ __('institutional.footer.product') }}</h3>
                            <ul class="space-y-3">
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.how_it_works') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.faq') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.blog') }}</a></li>
                            </ul>
                        </div>

                        <!-- Empresa Column -->
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4">{{ __('institutional.footer.company') }}</h3>
                            <ul class="space-y-3">
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.about_us') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.contact') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.careers') }}</a></li>
                            </ul>
                        </div>

                        <!-- Legal Column -->
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4">{{ __('institutional.footer.legal') }}</h3>
                            <ul class="space-y-3">
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.privacy') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.terms') }}</a></li>
                                <li><a href="#" class="text-gray-300 hover:text-white text-sm transition-colors">{{ __('institutional.footer.security') }}</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Separator Line -->
                    <div class="border-t border-gray-700 mt-8 pt-8">
                        <p class="text-center text-gray-400 text-sm">
                            {{ __('institutional.footer.copyright') }}
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
