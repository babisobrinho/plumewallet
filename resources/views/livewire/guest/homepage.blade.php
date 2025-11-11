<div>
    <!-- Hero Section -->
    <section class="relative bg-slate-900 min-h-screen flex items-center overflow-hidden">
        <!-- Subtle Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-2xl"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-white rounded-full blur-2xl"></div>
            <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-white rounded-full blur-2xl"></div>
        </div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="h-full w-full" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 20px 20px;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    {{ __('guest.hero.title') }}
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-slate-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                    {{ __('guest.hero.subtitle') }}
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <x-link href="{{ route('register') }}" 
                               class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                            {{ __('guest.hero.get_started') }}
                        </x-link>
                        <button @click="document.getElementById('content-section').scrollIntoView({ behavior: 'smooth' })" 
                               class="inline-flex items-center justify-center px-8 py-3 border-2 border-slate-400 text-slate-300 font-medium rounded-lg hover:border-slate-300 hover:text-white transition-colors">
                            {{ __('guest.hero.learn_more') }}
                        </button>
                    @else
                        <x-link href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}" 
                               class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                            {{ __('guest.navigation.dashboard') }}
                        </x-link>
                    @endguest
                </div>

                <!-- Decorative Line -->
                <div class="mt-16 flex justify-center">
                    <div class="w-24 h-0.5 bg-gradient-to-r from-transparent via-blue-400 to-transparent"></div>
                </div>
            </div>
        </div>

        <!-- Bottom Gradient -->
        <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- Welcome Section -->
    <section id="content-section" class="py-20 px-6 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">
                {{ __('guest.welcome.title') }}
            </h2>
            <p class="text-xl text-gray-700 mb-12 leading-relaxed">
                {{ __('guest.welcome.subtitle') }}
            </p>
            
            <!-- Call to Action Simples -->
            <div class="bg-gray-100 rounded-2xl p-8">
                <p class="text-lg text-gray-800 font-medium">
                    {{ __('guest.welcome.call_to_action') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Features Section - Carrossel funcional como no wireframe -->
    <section class="py-20 px-6 bg-gray-100">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ __('guest.features.title') }}
            </h2>
            <p class="text-xl text-gray-700 mb-12">
                {{ __('guest.features.subtitle') }}
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
                         :class="currentSlide === 0 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-gray-800 rounded-xl shadow-2xl border border-gray-700 scale-100 opacity-100 z-30' : 'left-0 w-96 bg-white rounded-xl shadow-lg border border-gray-100 opacity-70 scale-90 z-20'"
                         @click="goToSlide(0)">
                        <div class="p-8 text-left h-full flex flex-col" :class="currentSlide === 0 ? 'text-white' : 'text-gray-700'">
                            <!-- Título Principal -->
                            <div>
                                <h1 class="text-2xl font-bold mb-2">{{ __('guest.features.smart_savings.title') }}</h1>
                                <p class="text-sm mb-6" :class="currentSlide === 0 ? 'text-gray-300' : 'text-gray-600'">{{ __('guest.features.smart_savings.subtitle') }}</p>
                                
                                <!-- Linha divisória -->
                                <div class="border-t mb-6" :class="currentSlide === 0 ? 'border-gray-600' : 'border-gray-300'"></div>
                                
                                <!-- Seção de conteúdo -->
                                <h2 class="text-xl font-semibold mb-3">{{ __('guest.features.smart_savings.section_title') }}</h2>
                                <p class="text-sm mb-6" :class="currentSlide === 0 ? 'text-gray-300' : 'text-gray-600'">{{ __('guest.features.smart_savings.description') }}</p>
                            </div>
                            
                            <!-- Botão no final -->
                            <div class="mt-auto flex justify-end">
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2 - Viagens do Sonho (CENTRO) -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentSlide === 1 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-gray-800 rounded-xl shadow-2xl border border-gray-700 scale-100 opacity-100 z-30' : 'left-0 w-96 bg-white rounded-xl shadow-lg border border-gray-100 opacity-70 scale-90 z-20'"
                         @click="goToSlide(1)">
                        <div class="p-8 text-white text-left h-full flex flex-col">
                            <!-- Título Principal -->
                            <div>
                                <h1 class="text-2xl font-bold mb-2">{{ __('guest.features.dream_trips.title') }}</h1>
                                <p class="text-gray-300 text-sm mb-6">{{ __('guest.features.dream_trips.subtitle') }}</p>
                                
                                <!-- Linha divisória -->
                                <div class="border-t border-gray-600 mb-6"></div>
                                
                                <!-- Seção Dream trips -->
                                <h2 class="text-xl font-semibold mb-3">{{ __('guest.features.dream_trips.section_title') }}</h2>
                                <p class="text-gray-300 text-sm mb-6">{{ __('guest.features.dream_trips.description') }}</p>
                            </div>
                            
                            <!-- Botão no final -->
                            <div class="mt-auto flex justify-end">
                              
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 3 - Investimentos -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentSlide === 2 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-gray-800 rounded-xl shadow-2xl border border-gray-700 scale-100 opacity-100 z-30' : 'right-0 w-96 bg-white rounded-xl shadow-lg border border-gray-100 opacity-90 z-20'"
                         @click="goToSlide(2)">
                        <div class="p-8 text-left h-full flex flex-col" :class="currentSlide === 2 ? 'text-white' : 'text-gray-700'">
                            <!-- Título Principal -->
                            <div>
                                <h1 class="text-2xl font-bold mb-2">{{ __('guest.features.investments.title') }}</h1>
                                <p class="text-sm mb-6" :class="currentSlide === 2 ? 'text-gray-300' : 'text-gray-600'">{{ __('guest.features.investments.description') }}</p>
                                
                                <!-- Linha divisória -->
                                <div class="border-t mb-6" :class="currentSlide === 2 ? 'border-gray-600' : 'border-gray-300'"></div>
                                
                                <!-- Seção de conteúdo -->
                                <h2 class="text-xl font-semibold mb-3">{{ __('guest.features.investments.section_title') }}</h2>
                                <p class="text-sm mb-6" :class="currentSlide === 2 ? 'text-gray-300' : 'text-gray-600'">{{ __('guest.features.investments.section_description') }}</p>
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

 <!-- Seção Como Funciona -->
 <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Título da Seção -->
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ __('guest.steps.title') }}
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    {{ __('guest.steps.subtitle') }}
                </p>
            </div>

            <!-- Cards de Steps Centralizados -->
            <div class="max-w-4xl mx-auto">
                <div class="space-y-6 mb-12">
                    <!-- Step 1 -->
                    <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-2xl p-8 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mr-6">
                                <i class="ti ti-user-plus text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('guest.steps.step1.title') }}</h3>
                                <p class="text-gray-600">{{ __('guest.steps.step1.description') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-8 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mr-6">
                                <i class="ti ti-wallet text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('guest.steps.step2.title') }}</h3>
                                <p class="text-gray-600">{{ __('guest.steps.step2.description') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-8 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mr-6">
                                <i class="ti ti-trending-up text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('guest.steps.step3.title') }}</h3>
                                <p class="text-gray-600">{{ __('guest.steps.step3.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botão CTA Centralizado -->
                <div class="text-center">
                    <x-link href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gray-700 text-white font-bold text-lg rounded-lg hover:bg-gray-600 transition-colors shadow-lg">
                        {{ __('guest.steps.cta') }}
                        <i class="ti ti-arrow-right w-5 h-5 ml-2"></i>
                    </x-link>
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
                    {{ __('guest.profiles.title') }}
                </h2>
                <p class="text-gray-600 text-lg">
                    {{ __('guest.profiles.subtitle') }}
                </p>
            </div>

            <!-- Carrossel de Perfis -->
            <div class="relative" 
                 x-data="{ 
                     currentProfile: 1,
                     goToProfile(profile) { this.currentProfile = profile; },
                     nextProfile() { this.currentProfile = (this.currentProfile + 1) % 3; },
                     previousProfile() { this.currentProfile = (this.currentProfile - 1 + 3) % 3; }
                 }">
                
                <!-- Cards Container -->
                <div class="relative h-96 flex items-center justify-center overflow-hidden">
                    <!-- Card 1 - Estudante -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentProfile === 0 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-white rounded-xl shadow-2xl border border-gray-100 scale-100 opacity-100 z-30' : 'left-0 w-96 bg-white rounded-xl shadow-lg border border-gray-100 opacity-70 scale-90 z-20'"
                         @click="goToProfile(0)">
                        <div class="p-8 text-left h-full flex flex-col">
                            <!-- Header do Card -->
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center mr-4">
                                    <i class="ti ti-school text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ __('guest.profiles.student.title') }}</h3>
                                    <p class="text-sm text-gray-600">{{ __('guest.profiles.student.subtitle') }}</p>
                                </div>
                            </div>
                            
                            <!-- Conteúdo do Card -->
                            <div class="flex-1">
                                <!-- Receitas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.income') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.student.income.0') }}</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.student.income.1') }}</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.student.income.2') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Despesas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.expenses') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.student.expenses.0') }}</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.student.expenses.1') }}</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.student.expenses.2') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Contas -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.accounts') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ __('guest.profiles.student.accounts.0') }}</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ __('guest.profiles.student.accounts.1') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 - Família (CENTRO) -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentProfile === 1 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-white rounded-xl shadow-2xl border border-gray-100 scale-100 opacity-100 z-30' : 'left-0 w-96 bg-white rounded-xl shadow-lg border border-gray-100 opacity-70 scale-90 z-20'"
                         @click="goToProfile(1)">
                        <div class="p-8 text-left h-full flex flex-col">
                            <!-- Header do Card -->
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center mr-4">
                                    <i class="ti ti-users text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ __('guest.profiles.family.title') }}</h3>
                                    <p class="text-sm text-gray-600">{{ __('guest.profiles.family.subtitle') }}</p>
                                </div>
                            </div>
                            
                            <!-- Conteúdo do Card -->
                            <div class="flex-1">
                                <!-- Receitas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.income') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.family.income.0') }}</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.family.income.1') }}</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.family.income.2') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Despesas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.expenses') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.family.expenses.0') }}</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.family.expenses.1') }}</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.family.expenses.2') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Contas -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.accounts') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ __('guest.profiles.family.accounts.0') }}</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ __('guest.profiles.family.accounts.1') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 - Profissional Empregado -->
                    <div class="absolute transition-all duration-500 ease-in-out cursor-pointer"
                         :class="currentProfile === 2 ? 'left-1/2 transform -translate-x-1/2 w-96 bg-white rounded-xl shadow-2xl border border-gray-100 scale-100 opacity-100 z-30' : 'right-0 w-96 bg-white rounded-xl shadow-lg border border-gray-100 opacity-70 scale-90 z-20'"
                         @click="goToProfile(2)">
                        <div class="p-8 text-left h-full flex flex-col">
                            <!-- Header do Card -->
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center mr-4">
                                    <i class="ti ti-briefcase text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ __('guest.profiles.professional.title') }}</h3>
                                    <p class="text-sm text-gray-600">{{ __('guest.profiles.professional.subtitle') }}</p>
                                </div>
                            </div>
                            
                            <!-- Conteúdo do Card -->
                            <div class="flex-1">
                                <!-- Receitas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.income') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.professional.income.0') }}</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.professional.income.1') }}</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ __('guest.profiles.professional.income.2') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Despesas -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.expenses') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.professional.expenses.0') }}</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.professional.expenses.1') }}</span>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ __('guest.profiles.professional.expenses.2') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Contas -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('guest.common.accounts') }}</h4>
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ __('guest.profiles.professional.accounts.0') }}</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ __('guest.profiles.professional.accounts.1') }}</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ __('guest.profiles.professional.accounts.2') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indicadores do Carrossel -->
                <div class="flex justify-center items-center mt-12 space-x-2">
                    <button class="rounded-full transition-all duration-300 hover:bg-gray-400"
                            :class="currentProfile === 0 ? 'w-8 h-2 bg-gray-800' : 'w-2 h-2 bg-gray-300'"
                            @click="goToProfile(0)"></button>
                    <button class="rounded-full transition-all duration-300 hover:bg-gray-400"
                            :class="currentProfile === 1 ? 'w-8 h-2 bg-gray-800' : 'w-2 h-2 bg-gray-300'"
                            @click="goToProfile(1)"></button>
                    <button class="rounded-full transition-all duration-300 hover:bg-gray-400"
                            :class="currentProfile === 2 ? 'w-8 h-2 bg-gray-800' : 'w-2 h-2 bg-gray-300'"
                            @click="goToProfile(2)"></button>
                </div>

                <!-- Botões de navegação -->
                <div class="flex justify-center items-center mt-6 space-x-4">
                    <button class="p-3 rounded-full bg-gray-800 shadow-lg hover:bg-gray-700 transition-colors"
                            @click="previousProfile()">
                        <i class="ti ti-chevron-left text-white text-lg"></i>
                    </button>
                    <button class="p-3 rounded-full bg-gray-800 shadow-lg hover:bg-gray-700 transition-colors"
                            @click="nextProfile()">
                        <i class="ti ti-chevron-right text-white text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

   
</div>

@once
@push('scripts')
<script>
    function profileCarousel() {
        return {
            currentProfile: 0,
            profiles: [
                {
                    title: '{{ __('guest.profiles.student.title') }}',
                    subtitle: '{{ __('guest.profiles.student.subtitle') }}',
                    income: @json(__('guest.profiles.student.income')),
                    expenses: @json(__('guest.profiles.student.expenses')),
                    accounts: @json(__('guest.profiles.student.accounts')),
                    icon: 'ti ti-school',
                    color: 'bg-green-600'
                },
                {
                    title: '{{ __('guest.profiles.family.title') }}',
                    subtitle: '{{ __('guest.profiles.family.subtitle') }}',
                    income: @json(__('guest.profiles.family.income')),
                    expenses: @json(__('guest.profiles.family.expenses')),
                    accounts: @json(__('guest.profiles.family.accounts')),
                    icon: 'ti ti-users',
                    color: 'bg-blue-600'
                },
                {
                    title: '{{ __('guest.profiles.professional.title') }}',
                    subtitle: '{{ __('guest.profiles.professional.subtitle') }}',
                    income: @json(__('guest.profiles.professional.income')),
                    expenses: @json(__('guest.profiles.professional.expenses')),
                    accounts: @json(__('guest.profiles.professional.accounts')),
                    icon: 'ti ti-briefcase',
                    color: 'bg-purple-600'
                }
            ],
            nextProfile() { 
                this.currentProfile = (this.currentProfile + 1) % this.profiles.length; 
            },
            previousProfile() { 
                this.currentProfile = (this.currentProfile - 1 + this.profiles.length) % this.profiles.length; 
            },
            goToProfile(index) { 
                this.currentProfile = index; 
            },
            init() {
                console.log('Profile carousel initialized:', this.profiles);
            }
        }
    }
</script>
@endpush
@endonce
