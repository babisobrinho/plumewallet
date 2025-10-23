<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-100 font-sans antialiased">
    <!-- Navbar -->
    <x-institutional-navbar />
    
    <div class="min-h-screen flex">
        <!-- Lado Esquerdo - Bem-Vindo com Seta Diagonal -->
        <div class="flex-1 bg-gray-800 relative flex items-center justify-center p-8">
            <!-- Triângulo diagonal para a direita -->
            <div class="absolute inset-0 bg-gray-300" style="clip-path: polygon(0 0, 80% 0, 100% 50%, 80% 100%, 0 100%);"></div>
            
            <!-- Conteúdo Centralizado -->
            <div class="relative z-10 text-center text-gray-900 px-8">
                <h2 class="text-4xl font-bold mb-4">Bem-Vindo de volta</h2>
                <p class="text-lg mb-8">Ainda não tem uma conta?</p>
                <a href="{{ route('register') }}" class="inline-block bg-gray-800 text-white font-semibold py-3 px-8 rounded-lg hover:bg-gray-700 transition-colors">
                    Criar conta
                </a>
            </div>
        </div>
        
        <!-- Lado Direito - Formulário de Login -->
        <div class="flex-1 bg-gray-100 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Login</h1>
                
                <x-validation-errors class="mb-4" />
                
                @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ $value }}
                    </div>
                @endsession
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Login, emails ou bla</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                    </div>
                    
                    <button type="submit" class="w-full bg-gray-300 text-gray-900 font-semibold py-3 px-4 rounded-lg hover:bg-gray-400 transition-colors">
                        Log in
                    </button>
                </form>
                
                <!-- Separador Or -->
                <div class="flex items-center my-6">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-4 text-sm text-gray-500">Or</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>
                
                <!-- Social Login -->
                <div class="flex justify-center space-x-4 mb-6">
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="ti ti-brand-google text-gray-600"></i>
                    </div>
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="ti ti-brand-facebook text-gray-600"></i>
                    </div>
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="ti ti-brand-twitter text-gray-600"></i>
                    </div>
                </div>
                
                <p class="text-xs text-gray-500 text-center">sla coisa que normalmente se coloca aqui</p>
            </div>
        </div>
    </div>
    
    @livewireScripts
</body>
</html>
