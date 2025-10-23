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
        <!-- Lado Esquerdo - Formulário de Registro -->
        <div class="flex-1 bg-gray-100 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Sing up</h1>
                
                <x-validation-errors class="mb-4" />
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full name</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Login, emails ou bla</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                        Sing up
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
        
        <!-- Lado Direito - Bem-Vindo com Seta Diagonal -->
        <div class="flex-1 bg-blue-900 relative flex items-center justify-center p-8">
            <!-- Triângulo diagonal para a esquerda -->
            <div class="absolute inset-0 bg-blue-700" style="clip-path: polygon(100% 0, 20% 0, 0% 50%, 20% 100%, 100% 100%);"></div>
            
            <!-- Conteúdo Centralizado -->
            <div class="relative z-10 text-center text-white px-8">
                <h2 class="text-4xl font-bold mb-4">Bem-Vindo!</h2>
                <h3 class="text-2xl font-semibold mb-6">A Plume</h3>
                <p class="text-lg mb-8">Já tem uma conta?</p>
                <a href="{{ route('login') }}" class="inline-block bg-white text-blue-900 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition-colors">
                    Entrar
                </a>
            </div>
        </div>
    </div>
    
    @livewireScripts
</body>
</html>