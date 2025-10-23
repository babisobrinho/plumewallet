<div>
    <!-- Hero Section - Com forma geométrica igual ao wireframe -->
    <section class="min-h-screen bg-gray-100 flex items-center relative overflow-hidden">
        <!-- Forma geométrica de seta começando do topo -->
        <div class="absolute top-0 right-0 w-3/4 h-full bg-gray-800 z-0" 
        style="clip-path: polygon(0% 0, 100% 0, 100% 100%, 30% 100%);"></div>
        
        <div class="max-w-7xl mx-auto px-6 py-20 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
                <!-- Lado Esquerdo - Conteúdo -->
                <div class="text-gray-900">
                    <!-- Texto "Welcome to Plume" adicionado aqui -->
                    <div class="mb-4">
                        <span class="text-xl md:text-2xl font-semibold text-gray-700">
                            Welcome to Plume
                        </span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        {{ __('institutional.hero.title') }}
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 mb-8 leading-relaxed">
                        {{ __('institutional.hero.subtitle') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @guest
                            <x-link href="{{ route('register') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-700 transition-colors shadow-lg">
                                GET STARTED
                            </x-link>
                            <x-link href="{{ route('login') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-700 transition-colors shadow-lg">
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

    <!-- Features Section - Carrossel funcional como no wireframe -->
    <section class="py-20 px-6 bg-gray-100">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __('institutional.features.title') }}
            </h2>
            <p class="text-xl text-gray-700 mb-12">
                {{ __('institutional.features.subtitle') }}
            </p>
            
            <!-- Carrossel Container -->
            <div class="relative" 
                 x-data="{ 
                     currentSlide: 1,
                     goToSlide(slide) { this.currentSlide = slide; },
                     nextSlide() { this.currentSlide = (this.currentSlide + 1) % 3; },
                     previousSlide() { this.currentSlide = (this.currentSlide - 1 + 3) % 3; }
                 }">
                <!-- Cards Container -->
                <div class="relative h-96 flex items-center justify-center overflow-hidden">
                    <!-- Card 1 - Economia Inteligente -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentSlide === 0 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-gray-800 rounded-xl shadow-2xl scale-100 opacity-100 z-30' : 'left-0 w-96 bg-white rounded-xl shadow-lg opacity-70 scale-90 z-20'"
                         @click="goToSlide(0)">
                        <div class="p-8 text-left h-full flex flex-col" :class="currentSlide === 0 ? 'text-white' : 'text-gray-700'">
                            <!-- Título Principal -->
                            <div>
                                <h1 class="text-2xl font-bold mb-2">Economia Inteligente</h1>
                                <p class="text-sm mb-6" :class="currentSlide === 0 ? 'text-gray-300' : 'text-gray-600'">Identifique oportunidades de poupança</p>
                                
                                <!-- Linha divisória -->
                                <div class="border-t mb-6" :class="currentSlide === 0 ? 'border-gray-600' : 'border-gray-300'"></div>
                                
                                <!-- Seção de conteúdo -->
                                <h2 class="text-xl font-semibold mb-3">Poupança Automática</h2>
                                <p class="text-sm mb-6" :class="currentSlide === 0 ? 'text-gray-300' : 'text-gray-600'">Configure metas de poupança e veja seu dinheiro crescer automaticamente.</p>
                            </div>
                            
                            <!-- Botão no final -->
                            <div class="mt-auto flex justify-end">
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2 - Viagens do Sonho (CENTRO) -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentSlide === 1 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-gray-800 rounded-xl shadow-2xl scale-100 opacity-100 z-30' : 'left-0 w-96 bg-white rounded-xl shadow-lg opacity-70 scale-90 z-20'"
                         @click="goToSlide(1)">
                        <div class="p-8 text-white text-left h-full flex flex-col">
                            <!-- Título Principal -->
                            <div>
                                <h1 class="text-2xl font-bold mb-2">Controle suas finanças</h1>
                                <p class="text-gray-300 text-sm mb-6">Com seus objetivos em mente</p>
                                
                                <!-- Linha divisória -->
                                <div class="border-t border-gray-600 mb-6"></div>
                                
                                <!-- Seção Dream trips -->
                                <h2 class="text-xl font-semibold mb-3">Viagens do sonho</h2>
                                <p class="text-gray-300 text-sm mb-6">Plan and realize your dream trips with financial control.</p>
                            </div>
                            
                            <!-- Botão no final -->
                            <div class="mt-auto flex justify-end">
                              
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 3 - Investimentos -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentSlide === 2 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-gray-800 rounded-xl shadow-2xl scale-100 opacity-100 z-30' : 'right-0 w-96 bg-white rounded-xl shadow-lg opacity-90 z-20'"
                         @click="goToSlide(2)">
                        <div class="p-8 text-left h-full flex flex-col" :class="currentSlide === 2 ? 'text-white' : 'text-gray-700'">
                            <!-- Título Principal -->
                            <div>
                                <h1 class="text-2xl font-bold mb-2">{{ __('institutional.features.investments.title') }}</h1>
                                <p class="text-sm mb-6" :class="currentSlide === 2 ? 'text-gray-300' : 'text-gray-600'">{{ __('institutional.features.investments.description') }}</p>
                                
                                <!-- Linha divisória -->
                                <div class="border-t mb-6" :class="currentSlide === 2 ? 'border-gray-600' : 'border-gray-300'"></div>
                                
                                <!-- Seção de conteúdo -->
                                <h2 class="text-xl font-semibold mb-3">Crescimento Inteligente</h2>
                                <p class="text-sm mb-6" :class="currentSlide === 2 ? 'text-gray-300' : 'text-gray-600'">Invista seu dinheiro de forma inteligente e veja seus rendimentos crescerem.</p>
                            </div>
                            
                            <!-- Botão no final -->
                            <div class="mt-auto flex justify-end">
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Indicadores do Carrossel -->
                <div class="flex justify-center items-center mt-12 space-x-2">
                    <button class="rounded-full transition-all duration-300 hover:bg-gray-400"
                            :class="currentSlide === 0 ? 'w-8 h-2 bg-gray-800' : 'w-2 h-2 bg-gray-300'"
                            @click="goToSlide(0)"></button>
                    <button class="rounded-full transition-all duration-300 hover:bg-gray-400"
                            :class="currentSlide === 1 ? 'w-8 h-2 bg-gray-800' : 'w-2 h-2 bg-gray-300'"
                            @click="goToSlide(1)"></button>
                    <button class="rounded-full transition-all duration-300 hover:bg-gray-400"
                            :class="currentSlide === 2 ? 'w-8 h-2 bg-gray-800' : 'w-2 h-2 bg-gray-300'"
                            @click="goToSlide(2)"></button>
                </div>
                
                <!-- Botões de navegação -->
                <div class="flex justify-center items-center mt-6 space-x-4">
                    <button class="p-3 rounded-full bg-gray-800 shadow-lg hover:bg-gray-700 transition-colors"
                            @click="previousSlide()">
                        <i class="ti ti-chevron-left text-white text-lg"></i>
                    </button>
                    <button class="p-3 rounded-full bg-gray-800 shadow-lg hover:bg-gray-700 transition-colors"
                            @click="nextSlide()">
                        <i class="ti ti-chevron-right text-white text-lg"></i>
                    </button>
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

    <!-- Seção de Perfis Financeiros -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Título da Seção -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    A solução perfeita para a tua carteira
                </h2>
                <p class="text-gray-600 text-lg">
                    Explicando sobre administrar finanças e tals
                </p>
            </div>

            <!-- Carrossel de Perfis -->
            <div class="relative" 
                 x-data="{ 
                     currentProfile: 0,
                     profiles: [
                         {
                             title: 'Família',
                             subtitle: 'Gestão financeira familiar',
                             income: ['Salário Cônjuge 1', 'Salário Cônjuge 2', 'Outros Rendimentos'],
                             expenses: ['Habitação', 'Utilidades', 'Alimentação', 'Transporte', 'Educação (crianças)', 'Saúde', 'Seguros', 'Poupanças', 'Entretenimento Familiar', 'Cuidados Infantis'],
                             accounts: ['Conta Conjunta', 'Poupança Familiar'],
                             icon: 'ti ti-users',
                             color: 'bg-blue-600'
                         },
                         {
                             title: 'Estudante',
                             subtitle: 'Gestão financeira para estudantes',
                             income: ['Bolsa de Estudos', 'Trabalho Part-time', 'Apoio Familiar', 'Outros Rendimentos'],
                             expenses: ['Propinas', 'Material Escolar', 'Transporte', 'Alimentação', 'Alojamento', 'Entretenimento', 'Saúde'],
                             accounts: ['Carteira Principal', 'Conta Bancária'],
                             icon: 'ti ti-school',
                             color: 'bg-green-600'
                         },
                         {
                             title: 'Profissional Empregado',
                             subtitle: 'Organização financeira profissional',
                             income: ['Salário', 'Prémios/Bónus', 'Outros Rendimentos'],
                             expenses: ['Habitação (renda/empréstimo)', 'Utilidades (água, luz, gás)', 'Telecomunicações', 'Alimentação', 'Transporte', 'Saúde', 'Seguros', 'Poupanças', 'Entretenimento', 'Vestuário'],
                             accounts: ['Conta Corrente', 'Poupança', 'Carteira'],
                             icon: 'ti ti-briefcase',
                             color: 'bg-purple-600'
                         }
                     ],
                     nextProfile() { this.currentProfile = (this.currentProfile + 1) % this.profiles.length; },
                     previousProfile() { this.currentProfile = (this.currentProfile - 1 + this.profiles.length) % this.profiles.length; },
                     goToProfile(index) { this.currentProfile = index; }
                 }">
                
                <!-- Cards Container -->
                <div class="relative h-96 flex items-center justify-center overflow-hidden">
                    <!-- Card 1 - Família -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentProfile === 0 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-white rounded-xl shadow-2xl scale-100 opacity-100 z-30' : 'left-0 w-96 bg-white rounded-xl shadow-lg opacity-70 scale-90 z-20'"
                         @click="goToProfile(0)">
                        <div class="p-8 text-left h-full flex flex-col">
                            <!-- Header do Card -->
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="ti ti-users text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Família</h3>
                                    <p class="text-sm text-gray-600">Gestão financeira familiar</p>
                                </div>
                            </div>
                            
                            <!-- Conteúdo do Card -->
                            <div class="flex-1">
                                <!-- Receitas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Receitas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Salário Cônjuge 1</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Salário Cônjuge 2</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Outros</span>
                                    </div>
                                </div>
                                
                                <!-- Despesas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Despesas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Habitação</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Educação</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Cuidados</span>
                                    </div>
                                </div>
                                
                                <!-- Contas -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Contas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Conta Conjunta</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Poupança</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 - Estudante (CENTRO) -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentProfile === 1 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-white rounded-xl shadow-2xl scale-100 opacity-100 z-30' : 'left-0 w-96 bg-white rounded-xl shadow-lg opacity-70 scale-90 z-20'"
                         @click="goToProfile(1)">
                        <div class="p-8 text-left h-full flex flex-col">
                            <!-- Header do Card -->
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="ti ti-school text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Estudante</h3>
                                    <p class="text-sm text-gray-600">Gestão financeira para estudantes</p>
                                </div>
                            </div>
                            
                            <!-- Conteúdo do Card -->
                            <div class="flex-1">
                                <!-- Receitas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Receitas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Bolsa de Estudos</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Trabalho Part-time</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Apoio Familiar</span>
                                    </div>
                                </div>
                                
                                <!-- Despesas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Despesas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Propinas</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Material Escolar</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Alojamento</span>
                                    </div>
                                </div>
                                
                                <!-- Contas -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Contas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Carteira Principal</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Conta Bancária</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 - Profissional Empregado -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentProfile === 2 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-white rounded-xl shadow-2xl scale-100 opacity-100 z-30' : 'right-0 w-96 bg-white rounded-xl shadow-lg opacity-70 scale-90 z-20'"
                         @click="goToProfile(2)">
                        <div class="p-8 text-left h-full flex flex-col">
                            <!-- Header do Card -->
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="ti ti-briefcase text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Profissional Empregado</h3>
                                    <p class="text-sm text-gray-600">Organização financeira profissional</p>
                                </div>
                            </div>
                            
                            <!-- Conteúdo do Card -->
                            <div class="flex-1">
                                <!-- Receitas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Receitas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Salário</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Prémios/Bónus</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Outros</span>
                                    </div>
                                </div>
                                
                                <!-- Despesas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Despesas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Habitação</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Utilidades</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Seguros</span>
                                    </div>
                                </div>
                                
                                <!-- Contas -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Contas:</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Conta Corrente</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Poupança</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Carteira</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indicadores -->
                <div class="flex justify-center mt-8 space-x-2">
                    <template x-for="(profile, index) in profiles" :key="index">
                        <button @click="goToProfile(index)"
                                class="w-3 h-3 rounded-full transition-colors"
                                :class="currentProfile === index ? 'bg-teal-600' : 'bg-gray-300'">
                        </button>
                    </template>
                </div>

                <!-- Botões de Navegação -->
                <button @click="previousProfile()" 
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white hover:bg-gray-50 text-gray-600 hover:text-gray-900 p-3 rounded-full shadow-lg transition-colors">
                    <i class="ti ti-chevron-left text-xl"></i>
                </button>
                <button @click="nextProfile()" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white hover:bg-gray-50 text-gray-600 hover:text-gray-900 p-3 rounded-full shadow-lg transition-colors">
                    <i class="ti ti-chevron-right text-xl"></i>
                </button>

                <!-- Botão CTA -->
                <div class="text-center mt-12">
                    
                </div>
            </div>
        </div>
    </section>
</div>

@once
@push('scripts')
<script>
    // Carrossel agora está definido inline no x-data
    console.log('Carrossel carregado com Alpine.js inline');
</script>
@endpush
@endonce