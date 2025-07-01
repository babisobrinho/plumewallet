<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{
        darkMode: localStorage.getItem('theme') === 'dark',
        toggleTheme() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        }
    }"
    x-init="$watch('darkMode', val => document.documentElement.classList.toggle('dark', val))"
    :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fontes (somente Google Fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Assets do Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
<x-banner />

<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

@stack('modals')
    @livewireScripts

    <script>
        function themeSwitcher() {
            return {
                isDark: false,
                initTheme() {
                    const savedTheme = localStorage.getItem('theme');
                    this.isDark = savedTheme === 'dark';
                },
                toggleTheme() {
                    this.isDark = !this.isDark;
                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                }
            }
        }
    </script>
</body>
</html>
