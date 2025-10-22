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
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Plume Wallet Column -->
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Plume Wallet</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                A solução completa para gerenciar suas finanças pessoais com facilidade e segurança.
                            </p>
                        </div>

                        <!-- Produto Column -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Produto</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Como Funciona</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Perguntas Frequentes</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Blog</a></li>
                            </ul>
                        </div>

                        <!-- Empresa Column -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Empresa</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Sobre Nós</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Contacto</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Carreiras</a></li>
                            </ul>
                        </div>

                        <!-- Legal Column -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Legal</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Privacidade</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Termos</a></li>
                                <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white text-sm">Segurança</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Separator Line -->
                    <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8">
                        <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                            © 2025 Plume Wallet by Plume. Todos os direitos reservados.
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
