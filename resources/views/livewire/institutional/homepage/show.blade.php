<div>
    <!-- Hero Section - YNAB/Mobills Style -->
    <section class="relative bg-gradient-to-r from-blue-500 to-blue-700 dark:from-blue-600 dark:to-blue-800 min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Text Content -->
                <div class="text-white">
                    <h1 class="text-5xl sm:text-6xl font-bold mb-6 leading-tight">
                        {{ __('institutional.hero.title') }}
                    </h1>
                    <p class="text-xl sm:text-2xl mb-8 text-blue-100 leading-relaxed">
                        {{ __('institutional.hero.subtitle') }}
                    </p>
                    
                    @guest
                        <div class="flex flex-col sm:flex-row gap-4 mb-6">
                            <x-link href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-lg font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-200">
                                {{ __('institutional.hero.get_started') }}
                            </x-link>
                            <x-link href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-200">
                                {{ __('institutional.navigation.log_in') }}
                            </x-link>
                        </div>
                        <p class="text-blue-200 text-sm">
                            {{ __('institutional.hero.no_credit_card') }}
                        </p>
                    @else
                        <x-link href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}" class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-lg font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-200">
                            {{ __('institutional.navigation.dashboard') }}
                        </x-link>
                    @endguest
                </div>
                
                <!-- Right Side - App Mockup -->
                <div class="relative flex justify-center">
                    <!-- Phone Mockup -->
                    <div class="relative w-72 h-[580px] bg-gray-900 rounded-[2.5rem] p-3 shadow-2xl">
                        <!-- Screen -->
                        <div class="w-full h-full bg-gray-100 rounded-[2rem] overflow-hidden relative">
                            <!-- Status Bar -->
                            <div class="bg-white h-8 flex justify-between items-center px-6 text-xs font-medium text-gray-900">
                                <span>9:41</span>
                                <div class="flex items-center gap-1">
                                    <div class="w-4 h-2 bg-gray-900 rounded-sm"></div>
                                    <div class="w-4 h-2 bg-gray-900 rounded-sm"></div>
                                    <div class="w-6 h-3 bg-gray-900 rounded-sm"></div>
                                </div>
                            </div>
                            
                            <!-- App Header -->
                            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4">
                                <h2 class="text-lg font-bold">{{ config('app.name') }}</h2>
                            </div>
                            
                            <!-- App Content -->
                            <div class="px-4 py-4 space-y-3 bg-gray-50 h-full">
                                <!-- New Transactions -->
                                <div class="bg-white rounded-xl p-4 shadow-sm">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-700">{{ __('institutional.mockup.new_transactions') }}</span>
                                        <button class="bg-blue-500 text-white px-3 py-1 rounded-lg text-xs font-medium">{{ __('institutional.mockup.review') }}</button>
                                    </div>
                                </div>
                                
                                <!-- Ready to Assign -->
                                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 shadow-sm border border-green-200">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700">{{ __('institutional.mockup.ready_to_assign') }}</span>
                                        <button class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs font-medium">{{ __('institutional.mockup.assign') }}</button>
                                    </div>
                                    <div class="text-3xl font-bold text-green-600">€2,450.00</div>
                                </div>
                                
                                <!-- Categories -->
                                <div class="bg-white rounded-xl p-4 shadow-sm">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-3">{{ __('institutional.mockup.top_priorities') }}</h3>
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <span class="text-blue-600 text-sm">🛒</span>
                                                </div>
                                                <span class="text-sm font-medium text-gray-700">{{ __('institutional.mockup.groceries') }}</span>
                                            </div>
                                            <span class="text-sm font-bold text-gray-900">€200</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center">
                                                    <span class="text-pink-600 text-sm">💕</span>
                                                </div>
                                                <span class="text-sm font-medium text-gray-700">{{ __('institutional.mockup.date_nights') }}</span>
                                            </div>
                                            <span class="text-sm font-bold text-gray-900">€150</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                                    <span class="text-orange-600 text-sm">🍽️</span>
                                                </div>
                                                <span class="text-sm font-medium text-gray-700">{{ __('institutional.mockup.dining_out') }}</span>
                                            </div>
                                            <span class="text-sm font-bold text-gray-900">€100</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Summary -->
                                <div class="bg-white rounded-xl p-4 shadow-sm">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-3">{{ __('institutional.mockup.month_summary') }}</h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">{{ __('institutional.mockup.assets') }}</span>
                                            <span class="font-bold text-gray-900">€5,230.00</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">{{ __('institutional.mockup.underfunded') }}</span>
                                            <span class="font-bold text-gray-900">€0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Bottom Navigation -->
                            <div class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-200 rounded-b-[2rem]">
                                <div class="flex justify-around py-3">
                                    <div class="text-center">
                                        <div class="text-blue-600 text-lg mb-1">🏠</div>
                                        <div class="text-xs text-blue-600 font-medium">{{ __('institutional.mockup.home') }}</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-gray-400 text-lg mb-1">📊</div>
                                        <div class="text-xs text-gray-400">{{ __('institutional.mockup.reports') }}</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-gray-400 text-lg mb-1">🏦</div>
                                        <div class="text-xs text-gray-400">{{ __('institutional.mockup.accounts') }}</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-gray-400 text-lg mb-1">⚙️</div>
                                        <div class="text-xs text-gray-400">{{ __('institutional.mockup.more') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-6 -right-6 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-xl animate-bounce">
                        €
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-xl animate-pulse">
                        €
                    </div>
                    <div class="absolute top-1/2 -right-10 w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold shadow-xl animate-bounce" style="animation-delay: 0.5s;">
                        €
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Simple Features Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                {{ __('institutional.how_it_works.title') }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">💰</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.how_it_works.step1.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ __('institutional.how_it_works.step1.description') }}</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📊</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.how_it_works.step2.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ __('institutional.how_it_works.step2.description') }}</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📈</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.how_it_works.step3.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ __('institutional.how_it_works.step3.description') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-16 bg-blue-600 dark:bg-blue-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">
                {{ __('institutional.cta.title') }}
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                {{ __('institutional.cta.subtitle') }}
            </p>
            @guest
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <x-link href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-semibold text-lg">
                        {{ __('institutional.hero.get_started') }}
                    </x-link>
                    <x-link href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg font-semibold text-lg">
                        {{ __('institutional.navigation.log_in') }}
                    </x-link>
                </div>
            @else
                <x-link href="{{ Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show') }}" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-semibold text-lg">
                    {{ __('institutional.navigation.dashboard') }}
                </x-link>
            @endguest
        </div>
    </section>
</div>
