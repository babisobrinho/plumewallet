<div class="scroll-smooth">

    <!-- Seção Nossa História -->
    <section id="historia" class="py-20 px-6 bg-gray-200">
        <div class="max-w-6xl mx-auto">
            <!-- Título da Seção -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    {{ __('institutional.about_us.history.title') }}
                </h2>
            </div>

            <!-- Timeline -->
            <div class="relative">
                <!-- Linha central vertical -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-2 h-full bg-gray-800"></div>
                
                <!-- Item 1 - O Início -->
                <div class="relative mb-20">
                    <!-- Linha horizontal esquerda -->
                    <div class="absolute left-0 right-1/2 h-0.5 bg-gray-800 top-1/2 transform -translate-y-1/2"></div>
                    <!-- Linha horizontal direita -->
                    <div class="absolute left-1/2 right-0 h-0.5 bg-gray-800 top-1/2 transform -translate-y-1/2"></div>
                    
                    <div class="flex items-center">
                        <!-- Texto à esquerda -->
                        <div class="w-1/2 pr-8">
                            <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100 h-48 flex flex-col justify-center">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('institutional.about_us.history.beginning.title') }}</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('institutional.about_us.history.beginning.description') }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Marcador da timeline -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-white rounded-full border-4 border-gray-800 z-10"></div>
                        
                        <!-- Ícone à direita -->
                        <div class="w-1/2 pl-8">
                            <div class="bg-gray-800 rounded-xl h-48 flex flex-col items-center justify-center shadow-lg">
                                <i class="ti ti-bulb text-white text-6xl mb-3"></i>
                                <p class="text-white text-sm font-medium text-center">{{ __('institutional.about_us.history.beginning.icon_label') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 2 - Desenvolvimento -->
                <div class="relative mb-20">
                    <!-- Linha horizontal esquerda -->
                    <div class="absolute left-0 right-1/2 h-0.5 bg-gray-800 top-1/2 transform -translate-y-1/2"></div>
                    <!-- Linha horizontal direita -->
                    <div class="absolute left-1/2 right-0 h-0.5 bg-gray-800 top-1/2 transform -translate-y-1/2"></div>
                    
                    <div class="flex items-center">
                        <!-- Ícone à esquerda -->
                        <div class="w-1/2 pr-8">
                            <div class="bg-gray-800 rounded-xl h-48 flex flex-col items-center justify-center shadow-lg">
                                <i class="ti ti-code text-white text-6xl mb-3"></i>
                                <p class="text-white text-sm font-medium text-center">{{ __('institutional.about_us.history.development.icon_label') }}</p>
                            </div>
                        </div>
                        
                        <!-- Marcador da timeline -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-white rounded-full border-4 border-gray-800 z-10"></div>
                        
                        <!-- Texto à direita -->
                        <div class="w-1/2 pl-8">
                            <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100 h-48 flex flex-col justify-center">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('institutional.about_us.history.development.title') }}</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('institutional.about_us.history.development.description') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 3 - Lançamento -->
                <div class="relative mb-20">
                    <!-- Linha horizontal esquerda -->
                    <div class="absolute left-0 right-1/2 h-0.5 bg-gray-800 top-1/2 transform -translate-y-1/2"></div>
                    <!-- Linha horizontal direita -->
                    <div class="absolute left-1/2 right-0 h-0.5 bg-gray-800 top-1/2 transform -translate-y-1/2"></div>
                    
                    <div class="flex items-center">
                        <!-- Texto à esquerda -->
                        <div class="w-1/2 pr-8">
                            <div class="bg-white rounded-xl p-8 shadow-lg border border-gray-100 h-48 flex flex-col justify-center">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('institutional.about_us.history.launch.title') }}</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('institutional.about_us.history.launch.description') }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Marcador da timeline -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-white rounded-full border-4 border-gray-800 z-10"></div>
                        
                        <!-- Ícone à direita -->
                        <div class="w-1/2 pl-8">
                            <div class="bg-gray-800 rounded-xl h-48 flex flex-col items-center justify-center shadow-lg">
                                <i class="ti ti-rocket text-white text-6xl mb-3"></i>
                                <p class="text-white text-sm font-medium text-center">{{ __('institutional.about_us.history.launch.icon_label') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Coluna 1 - Contact us -->
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('institutional.about_us.footer.contact_us.title') }}</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        {{ __('institutional.about_us.footer.contact_us.description') }}
                    </p>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition-colors">
                        {{ __('institutional.about_us.footer.contact_us.button') }}
                    </button>
                </div>

                <!-- Coluna 2 - O que fazemos -->
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('institutional.about_us.footer.what_we_do.title') }}</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        {{ __('institutional.about_us.footer.what_we_do.description') }}
                    </p>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition-colors">
                        {{ __('institutional.about_us.footer.what_we_do.button') }}
                    </button>
                </div>

                <!-- Coluna 3 - Alguma dúvida -->
                <div class="text-center md:text-left">
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('institutional.about_us.footer.any_questions.title') }}</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        {{ __('institutional.about_us.footer.any_questions.description') }}
                    </p>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition-colors">
                        {{ __('institutional.about_us.footer.any_questions.button') }}
                    </button>
                </div>
            </div>
        </div>
</section>
    <!-- Seção Nossa Equipa -->
    <section id="equipa" class="py-20 px-6 bg-gray-100">
        <div class="max-w-6xl mx-auto">
            <!-- Título da Seção -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    {{ __('institutional.about_us.team.title') }}
                </h2>
            </div>

            <!-- Cards da Equipa -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

             <!-- Membro 1 - Babi -->
             <div class="bg-white rounded-lg p-8 text-center shadow-lg">
                    <div class="mb-6">
                        <img src="https://github.com/babisobrinho.png" 
                             alt="Babi Sobrinho" 
                             class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-gray-200">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('institutional.about_us.team.babi.name') }}</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ __('institutional.about_us.team.babi.description') }}
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="https://github.com/babisobrinho" target="_blank" 
                           class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="ti ti-brand-github text-white text-sm"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/babisobrinho/" target="_blank" 
                           class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="ti ti-brand-linkedin text-white text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Membro 2 - Lenice -->
                <div class="bg-white rounded-lg p-8 text-center shadow-lg">
                    <div class="mb-6">
                        <img src="https://github.com/lenicesoaares.png" 
                             alt="Lenice Soares" 
                             class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-gray-200">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('institutional.about_us.team.lenice.name') }}</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ __('institutional.about_us.team.lenice.description') }}
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="https://github.com/lenicesoaares" target="_blank" 
                           class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="ti ti-brand-github text-white text-sm"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/lenicesoaares/" target="_blank" 
                           class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="ti ti-brand-linkedin text-white text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Membro 3 - Rebeca -->
                <div class="bg-white rounded-lg p-8 text-center shadow-lg">
                    <div class="mb-6">
                        <img src="https://github.com/RebecaSantosb.png" 
                             alt="Rebeca Santos" 
                             class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-gray-200">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('institutional.about_us.team.rebeca.name') }}</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ __('institutional.about_us.team.rebeca.description') }}
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="https://github.com/RebecaSantosb" target="_blank" 
                           class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="ti ti-brand-github text-white text-sm"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/rebeca-santos26/" target="_blank" 
                           class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="ti ti-brand-linkedin text-white text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</div>
