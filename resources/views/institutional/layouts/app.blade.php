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
    <link href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css" rel="stylesheet">
    
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
    <!-- Theme Toggle Button -->
    <div class="fixed top-4 right-4 z-50">
        <button id="theme-toggle" type="button" class="p-2 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i id="theme-icon" class="ti ti-moon text-gray-700 dark:text-gray-300"></i>
        </button>
    </div>

    <!-- Floating Elements (Decorative) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-plume-100 dark:bg-plume-900/20 opacity-40 blur-xl"></div>
        <div class="absolute bottom-1/4 right-20 w-24 h-24 rounded-full bg-blue-100 dark:bg-blue-900/20 opacity-40 blur-xl"></div>
        <div class="absolute top-1/3 right-1/4 w-20 h-20 rounded-full bg-purple-100 dark:bg-purple-900/20 opacity-40 blur-xl"></div>
    </div>

    <!-- Navigation -->
    <header class="w-full py-4 px-6 border-b border-gray-200 dark:border-gray-700 bg-white/90 dark:bg-gray-800/90 backdrop-blur-lg sticky top-0 z-40">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center">
                <a href="{{ route('institutional.index') }}" class="text-2xl font-semibold text-gray-900 dark:text-white hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                    Plume Wallet
                </a>
            </div>
            
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('institutional.index') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.index') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    Início
                </a>
                <a href="{{ route('institutional.about-us') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.about-us') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    Sobre Nós
                </a>
                <a href="{{ route('institutional.how-it-works') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.how-it-works') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    Como Funciona
                </a>
                <a href="{{ route('institutional.blog') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.blog*') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    Blog
                </a>
                <a href="{{ route('institutional.contact') }}" class="px-3 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors {{ request()->routeIs('institutional.contact') ? 'text-plume-600 dark:text-plume-400' : '' }}">
                    Contacto
                </a>
            </nav>

            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                            Entrar
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-plume-600 dark:bg-plume-700 text-white rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors">
                                Criar conta
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
                        A solução completa para gerenciar suas finanças pessoais com facilidade e segurança.
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
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Produto</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('institutional.how-it-works') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">Como Funciona</a></li>
                        <li><a href="{{ route('institutional.faq') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">FAQ</a></li>
                        <li><a href="{{ route('institutional.blog') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Empresa</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('institutional.about-us') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">Sobre nós</a></li>
                        <li><a href="{{ route('institutional.contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">Contacto</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">Carreiras</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">Privacidade</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">Termos</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors text-sm">Segurança</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-700 dark:text-gray-300 text-sm">
                    © {{ date('Y') }} Plume Wallet by Plume. Todos os direitos reservados.
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
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const htmlElement = document.documentElement;

        // Check for saved user preference or use system preference
        const savedTheme = localStorage.getItem('theme') || 
                          (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        
        // Apply the saved theme
        if (savedTheme === 'dark') {
            htmlElement.classList.add('dark');
            themeIcon.classList.remove('ti-moon');
            themeIcon.classList.add('ti-sun');
        }

        // Toggle theme on button click
        themeToggle.addEventListener('click', () => {
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                themeIcon.classList.remove('ti-sun');
                themeIcon.classList.add('ti-moon');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                themeIcon.classList.remove('ti-moon');
                themeIcon.classList.add('ti-sun');
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
    </script>

    @stack('scripts')
</body>
</html>
