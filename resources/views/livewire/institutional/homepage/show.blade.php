<div>
    <!-- Hero Section - Layout em duas colunas como nos prints -->
    <section class="min-h-screen bg-gradient-to-br from-indigo-900 via-blue-900 to-indigo-900 flex items-center px-6 py-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Lado Esquerdo - Texto -->
            <div class="text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    {{ __('institutional.hero.title') }} <span class="text-teal-400">PlumeWallet</span>
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-12 leading-relaxed">
                    {{ __('institutional.hero.subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    @guest
                        <x-link href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-900 font-semibold rounded-lg hover:bg-gray-100 transition-colors shadow-lg">
                            {{ __('institutional.hero.get_started') }}
                        </x-link>
                        <x-link href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-indigo-900 transition-colors">
                            {{ __('institutional.hero.learn_more') }}
                        </x-link>
                    @else
                        <x-link href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-900 font-semibold rounded-lg hover:bg-gray-100 transition-colors shadow-lg">
                            {{ __('institutional.navigation.dashboard') }}
                        </x-link>
                    @endguest
                </div>
            </div>
            
            <!-- Lado Direito - Imagem -->
            <div class="relative">
                <div class="relative z-10">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="{{ __('institutional.hero.image_alt') }}" class="rounded-2xl shadow-2xl w-full max-w-lg mx-auto border border-gray-200">
                </div>
                <div class="absolute -bottom-6 -right-6 w-full h-full bg-teal-500/20 rounded-2xl -z-10 blur-xl"></div>
            </div>
        </div>
    </section>

    <!-- Welcome Section - Como nos prints -->
    <section class="py-20 px-6 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-8">
                    {{ __('institutional.welcome.title') }}
                </h2>
                <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 mb-12 leading-relaxed">
                    {{ __('institutional.welcome.subtitle') }}
                </p>
                
                <!-- Features Grid - Design como backoffice -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 p-8">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-shield w-6 h-6 text-green-600 dark:text-green-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.welcome.feature1.title') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('institutional.welcome.feature1.description') }}</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 p-8">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-device-mobile w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.welcome.feature2.title') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('institutional.welcome.feature2.description') }}</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 p-8">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-chart-pie w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.welcome.feature3.title') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('institutional.welcome.feature3.description') }}</p>
                    </div>
                </div>
                
                <!-- Call to Action -->
                <div class="bg-teal-50 dark:bg-teal-900/20 rounded-2xl p-8 border border-teal-200 dark:border-teal-800">
                    <p class="text-lg text-gray-800 dark:text-gray-200 font-medium">
                        {{ __('institutional.welcome.call_to_action') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section - Cards como nos prints -->
    <section class="py-20 px-6 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('institutional.features.title') }}
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300 mb-12">
                {{ __('institutional.features.subtitle') }}
            </p>
            
            <!-- Features Cards - Design limpo -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                            <i class="ti ti-wallet w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.features.savings.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ __('institutional.features.savings.description') }}</p>
                </div>
                
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-xl border-2 border-teal-500 dark:border-teal-400 p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900 rounded-lg flex items-center justify-center">
                            <i class="ti ti-plane w-6 h-6 text-teal-600 dark:text-teal-400"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.features.dream_trips.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('institutional.features.dream_trips.description') }}</p>
                    <a href="#" class="text-teal-600 dark:text-teal-400 font-medium hover:underline">{{ __('institutional.features.dream_trips.link') }}</a>
                </div>
                
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                            <i class="ti ti-chart-bar w-6 h-6 text-red-600 dark:text-red-400"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.features.investments.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ __('institutional.features.investments.description') }}</p>
                </div>
            </div>
            
            <!-- Pagination dots -->
            <div class="flex justify-center space-x-2">
                <div class="w-3 h-3 bg-teal-600 dark:bg-teal-400 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
            </div>
        </div>
    </section>

    <!-- Solution Section - Layout em duas colunas -->
    <section class="py-20 px-6 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <!-- Dashboard Image -->
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-2xl h-96 flex items-center justify-center relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="{{ __('institutional.solution.image_alt') }}" class="w-full h-full object-cover rounded-2xl">
                        
                        <!-- Navigation arrows -->
                        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 p-2 rounded-full hover:bg-white dark:hover:bg-gray-800 transition-colors">
                            <i class="ti ti-chevron-left w-4 h-4 text-gray-800 dark:text-gray-200"></i>
                        </button>
                        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 p-2 rounded-full hover:bg-white dark:hover:bg-gray-800 transition-colors">
                            <i class="ti ti-chevron-right w-4 h-4 text-gray-800 dark:text-gray-200"></i>
                        </button>
                    </div>
                    
                    <!-- User profile label -->
                    <div class="mt-4 inline-block bg-teal-100 dark:bg-teal-900/20 text-teal-800 dark:text-teal-200 px-4 py-2 rounded-full text-sm font-medium">
                        {{ __('institutional.solution.user_type') }}
                    </div>
                </div>
                
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                        {{ __('institutional.solution.title') }}
                    </h2>
                    <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
                        {{ __('institutional.solution.description') }}
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center">
                                <i class="ti ti-check w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300">{{ __('institutional.solution.features.total_control') }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center">
                                <i class="ti ti-check w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300">{{ __('institutional.solution.features.detailed_reports') }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center">
                                <i class="ti ti-check w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300">{{ __('institutional.solution.features.intuitive_interface') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-20 px-6 bg-indigo-600 dark:bg-indigo-800 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center">
                <div class="inline-block bg-white/20 backdrop-blur-sm rounded-2xl p-8 max-w-2xl mx-auto">
                    <div class="flex items-center justify-center mb-4">
                        <i class="ti ti-chart-bar w-8 h-8 text-indigo-200"></i>
                    </div>
                    <p class="text-xl md:text-2xl font-medium mb-4">
                        {{ __('institutional.testimonial.text') }}
                    </p>
                    <div class="flex items-center justify-center space-x-1">
                        <i class="ti ti-star-filled w-5 h-5 text-yellow-300"></i>
                        <i class="ti ti-star-filled w-5 h-5 text-yellow-300"></i>
                        <i class="ti ti-star-filled w-5 h-5 text-yellow-300"></i>
                        <i class="ti ti-star-filled w-5 h-5 text-yellow-300"></i>
                        <i class="ti ti-star-filled w-5 h-5 text-yellow-300"></i>
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

    <!-- Steps Section -->
    <section class="py-20 px-6 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('institutional.steps.title') }}
                </h2>
                <p class="text-xl text-gray-700 dark:text-gray-300">
                    {{ __('institutional.steps.subtitle') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <!-- Step illustrations -->
                    <div class="relative">
                        <div class="bg-teal-100 dark:bg-teal-900/20 rounded-2xl p-8 mb-4">
                            <div class="w-16 h-16 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ti ti-layout w-8 h-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">{{ __('institutional.steps.step1.label') }}</h3>
                        </div>
                        
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl p-8 mb-4">
                            <div class="w-16 h-16 bg-gray-400 dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ti ti-phone w-8 h-8 text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">{{ __('institutional.steps.step2.label') }}</h3>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-semibold text-sm">1</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.steps.step1.title') }}</h3>
                                <p class="text-gray-700 dark:text-gray-300">{{ __('institutional.steps.step1.description') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-semibold text-sm">2</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.steps.step2.title') }}</h3>
                                <p class="text-gray-700 dark:text-gray-300">{{ __('institutional.steps.step2.description') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-semibold text-sm">3</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.steps.step3.title') }}</h3>
                                <p class="text-gray-700 dark:text-gray-300">{{ __('institutional.steps.step3.description') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <x-link href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-teal-600 dark:bg-teal-700 text-white font-medium rounded-lg hover:bg-teal-700 dark:hover:bg-teal-600 transition-colors shadow-lg">
                            {{ __('institutional.steps.cta') }}
                            <i class="ti ti-arrow-right w-4 h-4 ml-2"></i>
                        </x-link>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>