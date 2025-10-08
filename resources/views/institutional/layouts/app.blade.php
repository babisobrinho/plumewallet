<!DOCTYPE html>
<html lang="pt" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Plume Wallet') - Plume Wallet</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Plume Wallet - Gerencie suas finanças pessoais de forma inteligente e descomplicada.')">
    <meta name="keywords" content="@yield('keywords', 'finanças pessoais, controle financeiro, orçamento, economia, Plume Wallet')">
    <meta name="author" content="Plume Wallet">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'Plume Wallet') - Plume Wallet">
    <meta property="og:description" content="@yield('description', 'Plume Wallet - Gerencie suas finanças pessoais de forma inteligente e descomplicada.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Plume Wallet') - Plume Wallet">
    <meta name="twitter:description" content="@yield('description', 'Plume Wallet - Gerencie suas finanças pessoais de forma inteligente e descomplicada.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-image.jpg'))">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'plume': {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/tabler-icons.min.css">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.015em;
        }
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-300 font-poppins">
    <!-- Theme Toggle and Language Selector -->
    <div class="fixed top-20 right-4 z-30 flex space-x-2">
        <!-- Language Selector -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" type="button" class="p-2 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ strtoupper(app()->getLocale()) }}</span>
            </button>
            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-20 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <a href="{{ route('language.switch', 'pt') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">PT</a>
                <a href="{{ route('language.switch', 'en') }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">EN</a>
            </div>
        </div>
        
        <!-- Theme Toggle Button -->
        <button id="theme-toggle" type="button" class="p-2 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i id="theme-icon" class="ti ti-sun text-gray-700 dark:text-gray-300 text-lg"></i>
            <span id="theme-fallback" class="hidden text-gray-700 dark:text-gray-300 text-lg">☀️</span>
        </button>
    </div>

    <!-- Floating Elements (Decorative) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-plume-100 dark:bg-plume-900/20 opacity-40 blur-xl"></div>
        <div class="absolute bottom-1/4 right-20 w-24 h-24 rounded-full bg-blue-100 dark:bg-blue-900/20 opacity-40 blur-xl"></div>
        <div class="absolute top-1/3 right-1/4 w-20 h-20 rounded-full bg-purple-100 dark:bg-purple-900/20 opacity-40 blur-xl"></div>
    </div>

    <!-- Navigation -->
    <header class="w-full py-4 px-6 border-b border-gray-200 dark:border-gray-700 bg-white/90 dark:bg-gray-800/90 backdrop-blur-lg sticky top-0 z-50">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center">
                <a href="{{ route('institutional.index') }}" class="text-2xl font-semibold text-gray-900 dark:text-white hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                    Plume Wallet
                </a>
            </div>
            
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('institutional.index') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.index') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    {{ __('institutional.nav_home') }}
                </a>
                <a href="{{ route('institutional.about-us') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.about-us') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    {{ __('institutional.nav_about') }}
                </a>
                <a href="{{ route('institutional.how-it-works') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.how-it-works') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    {{ __('institutional.nav_how_it_works') }}
                </a>
                <a href="{{ route('institutional.blog') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.blog*') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    {{ __('institutional.nav_blog') }}
                </a>
                <a href="{{ route('institutional.contact') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.contact') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    {{ __('institutional.nav_contact') }}
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('dashboard') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                        {{ __('common.dashboard') }}
                    </a>
                @endauth
            </nav>

            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <!-- Dashboard moved to main menu -->
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                            {{ __('institutional.nav_login') }}
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-plume-600 dark:bg-plume-700 text-white rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors">
                                {{ __('institutional.nav_register') }}
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="ti ti-menu-2"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-col space-y-2 pt-4">
                <a href="{{ route('institutional.index') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                    Início
                </a>
                <a href="{{ route('institutional.about-us') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                    Sobre Nós
                </a>
                <a href="{{ route('institutional.how-it-works') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                    Como Funciona
                </a>
                <a href="{{ route('institutional.blog') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                    Blog
                </a>
                <a href="{{ route('institutional.contact') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                    Contacto
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        {{ __('common.dashboard') }}
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <span class="text-xl font-semibold text-gray-900 dark:text-white">Plume Wallet</span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">
                        {{ __('institutional.footer_description') }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                            <i class="ti ti-brand-twitter text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                            <i class="ti ti-brand-facebook text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                            <i class="ti ti-brand-instagram text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                            <i class="ti ti-brand-linkedin text-lg"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('institutional.footer_product') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('institutional.how-it-works') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.nav_how_it_works') }}</a></li>
                        <li><a href="{{ route('institutional.faq') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.faq_title') }}</a></li>
                        <li><a href="{{ route('institutional.blog') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.nav_blog') }}</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('institutional.footer_company') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('institutional.about-us') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.nav_about') }}</a></li>
                        <li><a href="{{ route('institutional.contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.nav_contact') }}</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.footer_careers') }}</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('institutional.footer_legal') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.footer_privacy') }}</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.footer_terms') }}</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">{{ __('institutional.footer_security') }}</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-700 dark:text-gray-300 text-sm">
                    © {{ date('Y') }} Plume Wallet by Plume. {{ __('institutional.footer_copyright') }}
                </p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Theme toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const themeFallback = document.getElementById('theme-fallback');
            const htmlElement = document.documentElement;

            console.log('Theme toggle element:', themeToggle);
            console.log('Theme icon element:', themeIcon);
            
            if (!themeToggle || !themeIcon) {
                console.error('Theme toggle elements not found!');
                return;
            }

            // Check if Tabler Icons are loaded
            const testIcon = document.createElement('i');
            testIcon.className = 'ti ti-sun';
            document.body.appendChild(testIcon);
            const iconLoaded = window.getComputedStyle(testIcon, ':before').content !== 'none';
            document.body.removeChild(testIcon);
            
            console.log('Tabler Icons loaded:', iconLoaded);
            
            if (!iconLoaded) {
                console.log('Using fallback Unicode icons');
                themeIcon.style.display = 'none';
                themeFallback.classList.remove('hidden');
            }

        // Check for saved user preference or use system preference
        const savedTheme = localStorage.getItem('theme') || 
                          (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        console.log('Saved theme:', savedTheme);
        
        // Apply the saved theme
        if (savedTheme === 'dark') {
            htmlElement.classList.add('dark');
            if (iconLoaded) {
                themeIcon.className = 'ti ti-sun text-gray-700 dark:text-gray-300 text-lg';
            } else {
                themeFallback.textContent = '☀️';
            }
            console.log('Applied dark theme, showing sun icon');
        } else {
            htmlElement.classList.remove('dark');
            if (iconLoaded) {
                themeIcon.className = 'ti ti-moon text-gray-700 dark:text-gray-300 text-lg';
            } else {
                themeFallback.textContent = '🌙';
            }
            console.log('Applied light theme, showing moon icon');
        }

        // Toggle theme on button click
        themeToggle.addEventListener('click', () => {
            console.log('Theme toggle clicked');
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                if (iconLoaded) {
                    themeIcon.className = 'ti ti-moon text-gray-700 dark:text-gray-300 text-lg';
                } else {
                    themeFallback.textContent = '🌙';
                }
                console.log('Switched to light theme, showing moon icon');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                if (iconLoaded) {
                    themeIcon.className = 'ti ti-sun text-gray-700 dark:text-gray-300 text-lg';
                } else {
                    themeFallback.textContent = '☀️';
                }
                console.log('Switched to dark theme, showing sun icon');
            }
        });

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking on a link
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
        }); // End DOMContentLoaded
    </script>

    @stack('scripts')
</body>
</html>
