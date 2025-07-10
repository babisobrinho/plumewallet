<!DOCTYPE html>
<html lang="pt" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plume Wallet - Gerencie suas finanças pessoais</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css" rel="stylesheet">
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
    </style>
</head>
<body class="bg-gray-50 text-gray-800 transition-colors duration-300">
    <!-- Theme Toggle Button -->
    <div class="fixed top-4 right-4 z-50">
        <button id="theme-toggle" type="button" class="p-2 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <i id="theme-icon" class="ti ti-moon text-gray-700 dark:text-gray-300"></i>
        </button>
    </div>

    <!-- Floating Elements (Decorative) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-teal-100 dark:bg-teal-900/20 opacity-40 blur-xl"></div>
        <div class="absolute bottom-1/4 right-20 w-24 h-24 rounded-full bg-blue-100 dark:bg-blue-900/20 opacity-40 blur-xl"></div>
        <div class="absolute top-1/3 right-1/4 w-20 h-20 rounded-full bg-purple-100 dark:bg-purple-900/20 opacity-40 blur-xl"></div>
    </div>

    <!-- Navigation - FUNDO CLARO (MANTIDO EXATAMENTE COMO ESTAVA) -->
    <header class="w-full py-4 px-6 border-b border-gray-200 dark:border-gray-700 bg-white/90 dark:bg-gray-800/90 backdrop-blur-lg">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center">
                <span class="text-2xl font-semibold text-gray-900 dark:text-white">Plume Wallet</span>
            </div>
            
            <nav class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                            Entrar
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-teal-600 dark:bg-teal-700 text-white rounded-lg hover:bg-teal-700 dark:hover:bg-teal-600 transition-colors">
                                Criar conta
                            </a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <!-- Hero Section - TEXTO ESCURO SOBRE FUNDO CLARO (MANTIDO) -->
    <main class="min-h-screen flex items-center justify-center px-6 py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    Plume Wallet
                </h1>
                <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 mb-8">
                    Comece agora a gerir as suas finanças pessoais de forma inteligente e descomplicada.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-teal-600 dark:bg-teal-700 text-white font-medium rounded-lg hover:bg-teal-700 dark:hover:bg-teal-600 transition-colors shadow-lg transform hover:scale-[1.02]">
                        Começar agora
                    </a>
                    <a href="#" class="px-8 py-3 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        Saiba mais
                    </a>
                </div>
            </div>
            
            <div class="relative floating-element">
                <div class="relative z-10">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Finanças pessoais" class="rounded-2xl shadow-2xl w-full max-w-lg mx-auto border border-gray-200 dark:border-gray-700">
                </div>
                <div class="absolute -bottom-6 -right-6 w-full h-full bg-teal-100 dark:bg-teal-900/20 rounded-2xl -z-10 opacity-60"></div>
            </div>
        </div>
    </main>

    <!-- Footer - FUNDO CLARO (MANTIDO) -->
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-8 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center">
                        <span class="text-xl font-semibold text-gray-900 dark:text-white">Plume Wallet</span>
                    </div>
                    <p class="mt-4 text-gray-700 dark:text-gray-300 text-sm">
                        A solução completa para gerenciar suas finanças pessoais com facilidade e segurança.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Produto</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">Recursos</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">Preços</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">FAQ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Empresa</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">Sobre nós</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">Blog</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">Carreiras</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">Privacidade</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">Termos</a></li>
                        <li><a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors text-sm">Segurança</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-700 dark:text-gray-300 text-sm">
                    © 2025 Plume Wallet by Plume. Todos os direitos reservados.
                </p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                        <i class="ti ti-brand-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                        <i class="ti ti-brand-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                        <i class="ti ti-brand-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                        <i class="ti ti-brand-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

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
    </script>
</body>
</html>