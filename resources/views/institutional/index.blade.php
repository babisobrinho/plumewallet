@extends('institutional.layouts.app')

@section('title', 'Página Inicial')
@section('description', 'Bem-vindo ao Plume Wallet - Registe seus gastos pelo WhatsApp e acompanhe tudo com clareza num painel elegante e fácil de usar. Sem planilhas. Sem complicação.')

@section('content')
<!-- Hero Section -->
<section class="min-h-screen flex items-center justify-center px-6 py-20 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="text-center lg:text-left">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                Bem-vindo ao <span class="text-gradient">Plume Wallet</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 mb-8">
                Registe seus gastos pelo WhatsApp e acompanhe tudo com clareza num painel elegante e fácil de usar. Sem planilhas. Sem complicação. Só o controle que você merece.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('register') }}" class="px-8 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors shadow-lg transform hover:scale-[1.02]">
                    Começar agora
                </a>
                <a href="{{ route('institutional.how-it-works') }}" class="px-8 py-3 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    Saiba mais
                </a>
            </div>
        </div>
        
        <div class="relative floating-element">
            <div class="relative z-10">
                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Finanças pessoais" class="rounded-2xl shadow-2xl w-full max-w-lg mx-auto border border-gray-200 dark:border-gray-700">
            </div>
            <div class="absolute -bottom-6 -right-6 w-full h-full bg-plume-100 dark:bg-plume-900/20 rounded-2xl -z-10 opacity-60"></div>
        </div>
    </div>
</section>

<!-- Controle suas finanças Section -->
<section class="py-20 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            Controle suas finanças
        </h2>
        <p class="text-xl text-gray-700 dark:text-gray-300 mb-12">
            Com seus objetivos em mente
        </p>
        
        <!-- Carousel/Features -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-8 hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ti ti-piggy-bank text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Economia</h3>
                <p class="text-gray-700 dark:text-gray-300">Acompanhe seus gastos e identifique oportunidades de economia.</p>
            </div>
            
            <div class="bg-plume-50 dark:bg-plume-900/20 rounded-xl p-8 hover:shadow-lg transition-shadow border-2 border-plume-200 dark:border-plume-800">
                <div class="w-16 h-16 bg-plume-200 dark:bg-plume-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ti ti-plane text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Viagens do sonho</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-4">Planeje e realize suas viagens dos sonhos com controle financeiro.</p>
                <a href="#" class="text-plume-600 dark:text-plume-400 font-medium hover:underline">Saiba mais →</a>
            </div>
            
            <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-8 hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ti ti-chart-line text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Investimentos</h3>
                <p class="text-gray-700 dark:text-gray-300">Monitore seus investimentos e crescimento patrimonial.</p>
            </div>
        </div>
        
        <!-- Pagination dots -->
        <div class="flex justify-center space-x-2">
            <div class="w-3 h-3 bg-plume-600 dark:bg-plume-400 rounded-full"></div>
            <div class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
            <div class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
            <div class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
        </div>
    </div>
</section>

<!-- A solução perfeita Section -->
<section class="py-20 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <!-- Image slider placeholder -->
                <div class="bg-gray-200 dark:bg-gray-700 rounded-2xl h-96 flex items-center justify-center relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Dashboard Plume Wallet" class="w-full h-full object-cover rounded-2xl">
                    
                    <!-- Navigation arrows -->
                    <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 p-2 rounded-full hover:bg-white dark:hover:bg-gray-800 transition-colors">
                        <i class="ti ti-chevron-left text-gray-800 dark:text-gray-200"></i>
                    </button>
                    <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 p-2 rounded-full hover:bg-white dark:hover:bg-gray-800 transition-colors">
                        <i class="ti ti-chevron-right text-gray-800 dark:text-gray-200"></i>
                    </button>
                </div>
                
                <!-- User profile label -->
                <div class="mt-4 inline-block bg-plume-100 dark:bg-plume-900/20 text-plume-800 dark:text-plume-200 px-4 py-2 rounded-full text-sm font-medium">
                    Estudante
                </div>
            </div>
            
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                    A solução perfeita para a tua carteira
                </h2>
                <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
                    Explicando sobre administrar finanças e tals. Uma plataforma completa que se adapta às suas necessidades financeiras, seja você estudante, profissional ou empresário.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                            <i class="ti ti-check text-white text-sm"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Controle total dos seus gastos</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                            <i class="ti ti-check text-white text-sm"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Relatórios detalhados e insights</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                            <i class="ti ti-check text-white text-sm"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Interface intuitiva e moderna</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="py-20 px-6 bg-plume-600 dark:bg-plume-800 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center">
            <div class="inline-block bg-white/20 backdrop-blur-sm rounded-2xl p-8 max-w-2xl mx-auto">
                <div class="flex items-center justify-center mb-4">
                    <i class="ti ti-chart-bar text-4xl text-plume-200"></i>
                </div>
                <p class="text-xl md:text-2xl font-medium mb-4">
                    Os gráficos não mentem: todos os que utilizaram a Plume Wallet aprovaram a experiência.
                </p>
                <div class="flex items-center justify-center space-x-1">
                    <i class="ti ti-star-filled text-yellow-300"></i>
                    <i class="ti ti-star-filled text-yellow-300"></i>
                    <i class="ti ti-star-filled text-yellow-300"></i>
                    <i class="ti ti-star-filled text-yellow-300"></i>
                    <i class="ti ti-star-filled text-yellow-300"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative elements -->
    <div class="absolute top-0 left-0 w-full h-full">
        <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
    </div>
</section>

<!-- É fácil de começar Section -->
<section class="py-20 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                É fácil de começar
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                Em apenas alguns passos você estará controlando suas finanças
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <!-- Step illustrations -->
                <div class="relative">
                    <div class="bg-plume-100 dark:bg-plume-900/20 rounded-2xl p-8 mb-4">
                        <div class="w-16 h-16 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ti ti-layout text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Passo 1</h3>
                    </div>
                    
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl p-8 ml-8">
                        <div class="w-16 h-16 bg-gray-400 dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ti ti-phone text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Passo 2</h3>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Escolher seu layout</h3>
                            <p class="text-gray-700 dark:text-gray-300">Personalize a interface conforme suas preferências e necessidades.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Cadastre seu número</h3>
                            <p class="text-gray-700 dark:text-gray-300">Conecte seu WhatsApp para começar a registrar gastos facilmente.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Registre seus gastos</h3>
                            <p class="text-gray-700 dark:text-gray-300">Comece a registrar seus gastos e receitas de forma simples e rápida.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors shadow-lg transform hover:scale-[1.02]">
                        Comece já!
                        <i class="ti ti-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
