<!DOCTYPE html>
<html lang="pt" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('auth.login_title') }} - Plume Wallet</title>

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
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 font-poppins min-h-screen flex items-center justify-center">
    <!-- Language Selector and Theme Toggle -->
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

    <div class="w-full max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[600px] rounded-2xl overflow-hidden shadow-2xl">
            <!-- Left Panel - Welcome -->
            <div class="gradient-bg text-white p-12 flex flex-col justify-center relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
                
                <div class="relative z-10">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">
                        {{ __('auth.welcome_back') }}
                    </h1>
                    <p class="text-xl text-white/90 mb-8">
                        {{ __('auth.welcome_back_subtitle') }}
                    </p>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-white text-gray-800 font-medium rounded-lg hover:bg-gray-100 transition-colors shadow-lg transform hover:scale-[1.02]">
                        {{ __('auth.create_account') }}
                        <i class="ti ti-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <!-- Right Panel - Login Form -->
            <div class="bg-white dark:bg-gray-800 p-12 flex flex-col justify-center">
                <div class="max-w-md mx-auto w-full">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('auth.login_title') }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('auth.login_subtitle') }}</p>
                    </div>
                    
                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="ti ti-alert-circle text-red-600 dark:text-red-400 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-red-800 dark:text-red-200 font-medium mb-2">{{ __('auth.validation_errors') }}</p>
                                    <ul class="text-red-700 dark:text-red-300 text-sm space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>• {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Status Message -->
                    @if (session('status'))
                        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="ti ti-check-circle text-green-600 dark:text-green-400 mr-3"></i>
                                <p class="text-green-800 dark:text-green-200">{{ session('status') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('auth.email_or_phone') }}
                            </label>
                            <input 
                                type="text" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                autofocus
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors"
                                placeholder="{{ __('auth.email_or_phone_placeholder') }}"
                            >
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('auth.password_label') }}
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors pr-12"
                                    placeholder="{{ __('auth.password_placeholder') }}"
                                >
                                <button 
                                    type="button" 
                                    id="toggle-password"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                >
                                    <i class="ti ti-eye" id="password-icon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="remember_me" 
                                    name="remember" 
                                    class="w-4 h-4 text-plume-600 bg-gray-100 border-gray-300 rounded focus:ring-plume-500 dark:focus:ring-plume-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                >
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('auth.remember_me') }}</span>
                            </label>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-plume-600 dark:text-plume-400 hover:underline">
                                    {{ __('auth.forgot_password') }}
                                </a>
                            @endif
                        </div>
                        
                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full px-6 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors shadow-lg transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-plume-500 focus:ring-offset-2"
                        >
                            {{ __('auth.sign_in') }}
                        </button>
                    </form>
                    
                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400">{{ __('auth.or') }}</span>
                        </div>
                    </div>
                    
                    <!-- Social Login -->
                    <div class="flex justify-center space-x-4">
                        <button class="w-12 h-12 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/80 dark:hover:bg-gray-800/80 transition-colors border border-gray-200 dark:border-gray-700">
                            <i class="ti ti-brand-google text-gray-600 dark:text-gray-400"></i>
                        </button>
                        <button class="w-12 h-12 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/80 dark:hover:bg-gray-800/80 transition-colors border border-gray-200 dark:border-gray-700">
                            <i class="ti ti-brand-facebook text-gray-600 dark:text-gray-400"></i>
                        </button>
                        <button class="w-12 h-12 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/80 dark:hover:bg-gray-800/80 transition-colors border border-gray-200 dark:border-gray-700">
                            <i class="ti ti-brand-github text-gray-600 dark:text-gray-400"></i>
                        </button>
                    </div>
                    
                    <!-- Footer Text -->
                    <p class="text-center text-xs text-gray-500 dark:text-gray-400 mt-6">
                        {{ __('auth.terms_agreement') }} <a href="#" class="text-plume-600 dark:text-plume-400 hover:underline">{{ __('auth.terms_of_service') }}</a> {{ __('auth.and') }} <a href="#" class="text-plume-600 dark:text-plume-400 hover:underline">{{ __('auth.privacy_policy') }}</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>

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
        });

        // Password toggle functionality
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('password-icon');

        togglePassword.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('ti-eye');
                passwordIcon.classList.add('ti-eye-off');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('ti-eye-off');
                passwordIcon.classList.add('ti-eye');
            }
        });
    </script>
</body>
</html>