<div>
    <!-- Hero Section - Com forma geométrica igual ao wireframe -->
    <section class="min-h-screen bg-gray-100 flex items-center relative overflow-hidden">
        <!-- Triângulo geométrico - Forma igual ao segundo print -->
        <div class="absolute top-0 right-0 w-3/4 h-full bg-gray-800 z-0" 
             style="clip-path: polygon(40% 0, 100% 0, 100% 100%, 0% 100%);"></div>
        
        <div class="max-w-7xl mx-auto px-6 py-20 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
                <!-- Lado Esquerdo - Conteúdo -->
                <div class="text-gray-900">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Bem-vindo ao Plume Wallet
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 mb-8 leading-relaxed">
                        Registe seus gastos pelo WhatsApp e acompanhe tudo com clareza num painel elegante e fácil de usar. Sem planilhas. Sem complicação. Só o controle que você merece.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @guest
                            <x-link href="{{ route('register') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-700 transition-colors shadow-lg">
                                GET STARTED
                            </x-link>
                            <x-link href="{{ route('login') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-white text-gray-800 font-bold rounded-lg hover:bg-gray-100 transition-colors border border-gray-300">
                                LEARN MORE
                            </x-link>
                        @else
                            <x-link href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-gray-800 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors shadow-lg">
                                {{ __('institutional.navigation.dashboard') }}
                            </x-link>
                        @endguest
                    </div>
                </div>
                
                <!-- Lado Direito - Vazio como no wireframe -->
                <div class="relative">
                    <!-- Espaço vazio - o triângulo geométrico fica atrás -->
                </div>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">
                {{ __('institutional.welcome.title') }}
            </h2>
            <p class="text-xl text-gray-700 mb-12 leading-relaxed">
                {{ __('institutional.welcome.subtitle') }}
            </p>
            
            <!-- Call to Action Simples -->
            <div class="bg-gray-100 rounded-2xl p-8">
                <p class="text-lg text-gray-800 font-medium">
                    {{ __('institutional.welcome.call_to_action') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-6 bg-gray-50">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __('institutional.features.title') }}
            </h2>
            <p class="text-xl text-gray-700 mb-12">
                {{ __('institutional.features.subtitle') }}
            </p>
            
            <!-- Features Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="ti ti-wallet text-yellow-600" style="font-size: 3rem !important;"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('institutional.features.savings.title') }}</h3>
                    <p class="text-gray-600">{{ __('institutional.features.savings.description') }}</p>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border-2 border-teal-500 p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                            <i class="ti ti-plane text-teal-600" style="font-size: 3rem !important;"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('institutional.features.dream_trips.title') }}</h3>
                    <p class="text-gray-600 mb-4">{{ __('institutional.features.dream_trips.description') }}</p>
                    <a href="#" class="text-teal-600 font-medium hover:underline">{{ __('institutional.features.dream_trips.link') }}</a>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="ti ti-chart-bar text-red-600" style="font-size: 3rem !important;"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ __('institutional.features.investments.title') }}</h3>
                    <p class="text-gray-600">{{ __('institutional.features.investments.description') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('institutional.steps.title') }}
                </h2>
                <p class="text-xl text-gray-700">
                    {{ __('institutional.steps.subtitle') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <!-- Step illustrations -->
                    <div class="relative">
                        <div class="bg-teal-100 rounded-2xl p-8 mb-4">
                            <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ti ti-layout text-white" style="font-size: 3.5rem !important;"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 text-center">{{ __('institutional.steps.step1.label') }}</h3>
                        </div>
                        
                        <div class="bg-gray-100 rounded-2xl p-8 mb-4">
                            <div class="w-16 h-16 bg-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ti ti-phone text-white" style="font-size: 3.5rem !important;"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 text-center">{{ __('institutional.steps.step2.label') }}</h3>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-semibold text-sm">1</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('institutional.steps.step1.title') }}</h3>
                                <p class="text-gray-700">{{ __('institutional.steps.step1.description') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-semibold text-sm">2</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('institutional.steps.step2.title') }}</h3>
                                <p class="text-gray-700">{{ __('institutional.steps.step2.description') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-semibold text-sm">3</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('institutional.steps.step3.title') }}</h3>
                                <p class="text-gray-700">{{ __('institutional.steps.step3.description') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <x-link href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors shadow-lg">
                            {{ __('institutional.steps.cta') }}
                            <i class="ti ti-arrow-right w-4 h-4 ml-2"></i>
                        </x-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>