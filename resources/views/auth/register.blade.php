<!DOCTYPE html>
<html lang="pt" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registo - Plume Wallet</title>

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

    <div class="w-full max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[700px] rounded-2xl overflow-hidden shadow-2xl">
            <!-- Left Panel - Sign Up Form -->
            <div class="bg-white dark:bg-gray-800 p-12 flex flex-col justify-center">
                <div class="max-w-md mx-auto w-full">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Registo</h2>
                        <p class="text-gray-600 dark:text-gray-400">Crie sua conta para começar</p>
                    </div>
                    
                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="ti ti-alert-circle text-red-600 dark:text-red-400 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-red-800 dark:text-red-200 font-medium mb-2">Por favor, corrija os seguintes erros:</p>
                                    <ul class="text-red-700 dark:text-red-300 text-sm space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>• {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nome completo
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                required 
                                autofocus
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors"
                                placeholder="Digite seu nome completo"
                            >
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Login, email ou telefone
                            </label>
                            <input 
                                type="text" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors"
                                placeholder="Digite seu email ou telefone"
                            >
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Palavra-passe
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors pr-12"
                                    placeholder="Digite sua palavra-passe"
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
                        
                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Confirmar palavra-passe
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors pr-12"
                                    placeholder="Confirme sua palavra-passe"
                                >
                                <button 
                                    type="button" 
                                    id="toggle-password-confirmation"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                >
                                    <i class="ti ti-eye" id="password-confirmation-icon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Terms and Privacy -->
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="flex items-start">
                                <input 
                                    type="checkbox" 
                                    id="terms" 
                                    name="terms" 
                                    required
                                    class="w-4 h-4 text-plume-600 bg-gray-100 border-gray-300 rounded focus:ring-plume-500 dark:focus:ring-plume-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mt-1"
                                >
                                <label for="terms" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    Concordo com os <a href="{{ route('terms.show') }}" target="_blank" class="text-plume-600 dark:text-plume-400 hover:underline">Termos de Serviço</a> e <a href="{{ route('policy.show') }}" target="_blank" class="text-plume-600 dark:text-plume-400 hover:underline">Política de Privacidade</a>
                                </label>
                            </div>
                        @endif
                        
                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full px-6 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors shadow-lg transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-plume-500 focus:ring-offset-2"
                        >
                            Criar conta
                        </button>
                    </form>
                    
                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400">Ou</span>
                        </div>
                    </div>
                    
                    <!-- Social Login -->
                    <div class="flex justify-center">
                        <button class="w-12 h-12 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/80 dark:hover:bg-gray-800/80 transition-colors border border-gray-200 dark:border-gray-700">
                            <i class="ti ti-brand-google text-gray-600 dark:text-gray-400"></i>
                        </button>
                    </div>
                    
                    <!-- Footer Text -->
                    <p class="text-center text-xs text-gray-500 dark:text-gray-400 mt-6">
                        Ao criar uma conta, você concorda com nossos termos e condições de uso.
                    </p>
                </div>
            </div>
            
            <!-- Right Panel - Welcome -->
            <div class="gradient-bg text-white p-12 flex flex-col justify-center relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mt-16"></div>
                <div class="absolute bottom-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mb-12"></div>
                
                <div class="relative z-10">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">
                        Bem-vindo!
                    </h1>
                    <p class="text-xl text-white/90 mb-4">
                        A Plume Wallet
                    </p>
                    <p class="text-lg text-white/80 mb-8">
                        Já tem uma conta? Entre e continue gerenciando suas finanças de forma inteligente.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3 bg-white text-gray-800 font-medium rounded-lg hover:bg-gray-100 transition-colors shadow-lg transform hover:scale-[1.02]">
                        Entrar
                        <i class="ti ti-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

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

        // Password confirmation toggle functionality
        const togglePasswordConfirmation = document.getElementById('toggle-password-confirmation');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const passwordConfirmationIcon = document.getElementById('password-confirmation-icon');

        togglePasswordConfirmation.addEventListener('click', () => {
            if (passwordConfirmationInput.type === 'password') {
                passwordConfirmationInput.type = 'text';
                passwordConfirmationIcon.classList.remove('ti-eye');
                passwordConfirmationIcon.classList.add('ti-eye-off');
            } else {
                passwordConfirmationInput.type = 'password';
                passwordConfirmationIcon.classList.remove('ti-eye-off');
                passwordConfirmationIcon.classList.add('ti-eye');
            }
        });

        // Form validation
        const form = document.querySelector('form');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        form.addEventListener('submit', function(e) {
            if (password.value !== passwordConfirmation.value) {
                e.preventDefault();
                alert('As palavras-passe não coincidem!');
                return false;
            }
        });
    </script>
</body>
</html>