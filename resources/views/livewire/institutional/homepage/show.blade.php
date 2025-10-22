<div>
    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center px-6 py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('institutional.hero.title') }} <span class="text-teal-600">PlumeWallet</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 mb-8">
                    {{ __('institutional.hero.subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    @guest
                        <x-link href="{{ route('register') }}" class="px-8 py-3 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors shadow-lg">
                            {{ __('institutional.hero.get_started') }}
                        </x-link>
                        <x-link href="{{ route('login') }}" class="px-8 py-3 border border-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-100 transition-colors">
                            {{ __('institutional.hero.learn_more') }}
                        </x-link>
                    @else
                        <x-link href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}" class="px-8 py-3 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors shadow-lg">
                            {{ __('institutional.navigation.dashboard') }}
                        </x-link>
                    @endguest
                </div>
            </div>
            
            <div class="relative floating-element">
                <div class="relative z-10">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Finanças pessoais" class="rounded-2xl shadow-2xl w-full max-w-lg mx-auto border border-gray-200 dark:border-gray-700">
                </div>
                <div class="absolute -bottom-6 -right-6 w-full h-full bg-teal-100 rounded-2xl -z-10 opacity-60"></div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-6 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('institutional.features.title') }}
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300 mb-12">
                {{ __('institutional.features.subtitle') }}
            </p>
            
            <!-- Features Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-piggy-bank text-2xl text-teal-600 dark:text-teal-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.features.savings.title') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ __('institutional.features.savings.description') }}</p>
                </div>
                
                <div class="bg-teal-50 dark:bg-teal-900/20 rounded-xl p-8 hover:shadow-lg transition-shadow border-2 border-teal-200 dark:border-teal-800">
                    <div class="w-16 h-16 bg-teal-200 dark:bg-teal-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-plane text-2xl text-teal-600 dark:text-teal-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.features.dream_trips.title') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">{{ __('institutional.features.dream_trips.description') }}</p>
                    <a href="#" class="text-teal-600 dark:text-teal-400 font-medium hover:underline">{{ __('institutional.features.dream_trips.link') }}</a>
                </div>
                
                <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-chart-line text-2xl text-teal-600 dark:text-teal-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.features.investments.title') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ __('institutional.features.investments.description') }}</p>
                </div>
            </div>
            
            <!-- Pagination dots -->
            <div class="flex justify-center space-x-2">
                <div class="w-3 h-3 bg-teal-600 dark:bg-teal-400 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
            </div>
        </div>
    </section>

    <!-- Solution Section -->
    <section class="py-20 px-6 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <!-- Dashboard Image -->
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-2xl h-96 flex items-center justify-center relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Dashboard PlumeWallet" class="w-full h-full object-cover rounded-2xl">
                        
                        <!-- Navigation arrows -->
                        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 p-2 rounded-full hover:bg-white dark:hover:bg-gray-800 transition-colors">
                            <i class="ti ti-chevron-left text-gray-800 dark:text-gray-200"></i>
                        </button>
                        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 p-2 rounded-full hover:bg-white dark:hover:bg-gray-800 transition-colors">
                            <i class="ti ti-chevron-right text-gray-800 dark:text-gray-200"></i>
                        </button>
                    </div>
                    
                    <!-- User profile label -->
                    <div class="mt-4 inline-block bg-teal-100 dark:bg-teal-900/20 text-teal-800 dark:text-teal-200 px-4 py-2 rounded-full text-sm font-medium">
                        Estudante
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
                                <i class="ti ti-check text-white text-sm"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300">{{ __('institutional.solution.features.total_control') }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center">
                                <i class="ti ti-check text-white text-sm"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300">{{ __('institutional.solution.features.detailed_reports') }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-teal-600 dark:bg-teal-400 rounded-full flex items-center justify-center">
                                <i class="ti ti-check text-white text-sm"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300">{{ __('institutional.solution.features.intuitive_interface') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-20 px-6 bg-teal-600 dark:bg-teal-800 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center">
                <div class="inline-block bg-white/20 backdrop-blur-sm rounded-2xl p-8 max-w-2xl mx-auto">
                    <div class="flex items-center justify-center mb-4">
                        <i class="ti ti-chart-bar text-4xl text-teal-200"></i>
                    </div>
                    <p class="text-xl md:text-2xl font-medium mb-4">
                        {{ __('institutional.testimonial.text') }}
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

    <!-- Steps Section -->
    <section class="py-20 px-6 bg-white dark:bg-gray-800">
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
                        <x-link href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-teal-600 dark:bg-teal-700 text-white font-medium rounded-lg hover:bg-teal-700 dark:hover:bg-teal-600 transition-colors shadow-lg transform hover:scale-[1.02]">
                            {{ __('institutional.steps.cta') }}
                            <i class="ti ti-arrow-right ml-2"></i>
                        </x-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>