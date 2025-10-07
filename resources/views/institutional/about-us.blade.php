@extends('institutional.layouts.app')

@section('title', 'Sobre Nós')
@section('description', 'Conheça a história da Plume Wallet e nossa missão de simplificar o controle financeiro pessoal. Descubra nossa equipe e valores.')

@section('content')
<!-- Hero Section -->
<section class="py-20 px-6 bg-gradient-to-br from-plume-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
            Sobre Nós
        </h1>
        <p class="text-xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
            Conheça a história da Plume Wallet e nossa missão de revolucionar o controle financeiro pessoal
        </p>
    </div>
</section>

<!-- Nossa História Section -->
<section class="py-20 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Nossa História
            </h2>
        </div>
        
        <!-- Timeline -->
        <div class="relative">
            <!-- Timeline line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-plume-200 dark:bg-plume-800"></div>
            
            <!-- Timeline items -->
            <div class="space-y-16">
                <!-- Item 1 -->
                <div class="relative flex items-center">
                    <div class="w-1/2 pr-8 text-right">
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">O Início</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                A Plume Wallet nasceu da necessidade de simplificar o controle financeiro pessoal. 
                                Observamos que muitas pessoas lutavam com planilhas complexas e aplicativos complicados 
                                para gerenciar suas finanças.
                            </p>
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-plume-600 dark:bg-plume-400 rounded-full border-4 border-white dark:border-gray-800"></div>
                    <div class="w-1/2 pl-8">
                        <div class="bg-gray-200 dark:bg-gray-600 rounded-xl h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Início da Plume Wallet" class="w-full h-full object-cover rounded-xl">
                        </div>
                    </div>
                </div>
                
                <!-- Item 2 -->
                <div class="relative flex items-center">
                    <div class="w-1/2 pr-8">
                        <div class="bg-gray-200 dark:bg-gray-600 rounded-xl h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Crescimento da Plume Wallet" class="w-full h-full object-cover rounded-xl">
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-plume-600 dark:bg-plume-400 rounded-full border-4 border-white dark:border-gray-800"></div>
                    <div class="w-1/2 pl-8 text-left">
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">O Crescimento</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Desenvolvemos uma solução inovadora que combina a simplicidade do WhatsApp com 
                                um painel elegante e funcional. Nossa plataforma cresceu rapidamente, 
                                ajudando milhares de usuários a organizarem suas finanças.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-20 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Contact us -->
            <div class="text-center">
                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ti ti-mail text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Contacte-nos</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    Tem alguma dúvida ou sugestão? Estamos aqui para ajudar você.
                </p>
                <a href="{{ route('institutional.contact') }}" class="inline-flex items-center px-6 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors">
                    Contactar
                </a>
            </div>
            
            <!-- O que fazemos -->
            <div class="text-center">
                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ti ti-bulb text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">O que fazemos</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    Simplificamos o controle financeiro pessoal com tecnologia inovadora e design intuitivo.
                </p>
                <a href="{{ route('institutional.how-it-works') }}" class="inline-flex items-center px-6 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors">
                    Saiba mais
                </a>
            </div>
            
            <!-- FAQ -->
            <div class="text-center">
                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ti ti-help text-2xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Alguma dúvida?</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    Consulte nossas perguntas frequentes para encontrar respostas rápidas.
                </p>
                <a href="{{ route('institutional.faq') }}" class="inline-flex items-center px-6 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors">
                    FAQ
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Nossa Equipe Section -->
<section class="py-20 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Nossa Equipe
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                Conheça as pessoas por trás da Plume Wallet
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="text-center">
                <div class="w-32 h-32 bg-gray-200 dark:bg-gray-600 rounded-full mx-auto mb-6 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Membro da equipe" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">João Silva</h3>
                <p class="text-plume-600 dark:text-plume-400 font-medium mb-4">CEO & Fundador</p>
                <blockquote class="text-gray-700 dark:text-gray-300 italic mb-4">
                    "Acreditamos que o controle financeiro deve ser simples e acessível para todos."
                </blockquote>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-linkedin text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-twitter text-xl"></i>
                    </a>
                </div>
            </div>
            
            <!-- Team Member 2 -->
            <div class="text-center">
                <div class="w-32 h-32 bg-gray-200 dark:bg-gray-600 rounded-full mx-auto mb-6 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Membro da equipe" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Maria Santos</h3>
                <p class="text-plume-600 dark:text-plume-400 font-medium mb-4">CTO & Co-fundadora</p>
                <blockquote class="text-gray-700 dark:text-gray-300 italic mb-4">
                    "Tecnologia deve servir às pessoas, não complicar suas vidas."
                </blockquote>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-linkedin text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-github text-xl"></i>
                    </a>
                </div>
            </div>
            
            <!-- Team Member 3 -->
            <div class="text-center">
                <div class="w-32 h-32 bg-gray-200 dark:bg-gray-600 rounded-full mx-auto mb-6 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Membro da equipe" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Pedro Costa</h3>
                <p class="text-plume-600 dark:text-plume-400 font-medium mb-4">Head of Design</p>
                <blockquote class="text-gray-700 dark:text-gray-300 italic mb-4">
                    "Design não é apenas como algo parece, é como funciona."
                </blockquote>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-linkedin text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                        <i class="ti ti-brand-dribbble text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Final Section -->
<section class="py-20 px-6 bg-plume-600 dark:bg-plume-800 text-white">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    Junte-se à nossa jornada
                </h2>
                <p class="text-xl text-plume-100 mb-8">
                    Faça parte da revolução do controle financeiro pessoal. 
                    Comece hoje mesmo a transformar sua relação com o dinheiro.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-white text-plume-600 font-medium rounded-lg hover:bg-gray-100 transition-colors">
                        Criar conta
                        <i class="ti ti-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3 border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-plume-600 transition-colors">
                        Entrar
                    </a>
                </div>
            </div>
            
            <div class="relative">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <i class="ti ti-users text-2xl text-plume-200"></i>
                            <div>
                                <p class="text-2xl font-bold">10,000+</p>
                                <p class="text-plume-200">Usuários ativos</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="ti ti-chart-line text-2xl text-plume-200"></i>
                            <div>
                                <p class="text-2xl font-bold">95%</p>
                                <p class="text-plume-200">Satisfação do cliente</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="ti ti-star text-2xl text-plume-200"></i>
                            <div>
                                <p class="text-2xl font-bold">4.8/5</p>
                                <p class="text-plume-200">Avaliação média</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
