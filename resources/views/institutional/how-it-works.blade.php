@extends('institutional.layouts.app')

@section('title', __('institutional.how_it_works_title'))
@section('description', __('institutional.how_it_works_subtitle'))

@section('content')
<!-- Hero Section -->
<section class="py-20 px-6 bg-gradient-to-br from-plume-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
            {{ __('institutional.how_it_works_title') }}
        </h1>
        <p class="text-xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
            {{ __('institutional.how_it_works_subtitle') }}
        </p>
    </div>
</section>

<!-- Processo em 3 Passos -->
<section class="py-20 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('institutional.step_by_step') }}
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                {{ __('institutional.easy_start_subtitle') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Passo 1 -->
            <div class="text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-user-plus text-3xl text-plume-600 dark:text-plume-400"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">1</span>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('institutional.step_1_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    {{ __('institutional.step_1_description') }}
                </p>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_1_feature_1') }}
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_1_feature_2') }}
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_1_feature_3') }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Passo 2 -->
            <div class="text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-phone text-3xl text-plume-600 dark:text-plume-400"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">2</span>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('institutional.step_2_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    {{ __('institutional.step_2_description') }}
                </p>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_2_feature_1') }}
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_2_feature_2') }}
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_2_feature_3') }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Passo 3 -->
            <div class="text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-chart-line text-3xl text-plume-600 dark:text-plume-400"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">3</span>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('institutional.step_3_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    {{ __('institutional.step_3_description') }}
                </p>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_3_feature_1') }}
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_3_feature_2') }}
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            {{ __('institutional.step_3_feature_3') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- CTA -->
        <div class="text-center mt-16">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors shadow-lg transform hover:scale-[1.02]">
                {{ __('institutional.get_started') }}
                <i class="ti ti-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Funcionalidades Principais -->
<section class="py-20 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('institutional.features_title') }}
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                {{ __('institutional.features_subtitle') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Funcionalidade 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-message-circle text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.feature_whatsapp_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.feature_whatsapp_description') }}
                </p>
            </div>
            
            <!-- Funcionalidade 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-dashboard text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.feature_dashboard_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.feature_dashboard_description') }}
                </p>
            </div>
            
            <!-- Funcionalidade 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-category text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.feature_categorization_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.feature_categorization_description') }}
                </p>
            </div>
            
            <!-- Funcionalidade 4 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-chart-pie text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.feature_reports_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.feature_reports_description') }}
                </p>
            </div>
            
            <!-- Funcionalidade 5 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-bell text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.feature_alerts_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.feature_alerts_description') }}
                </p>
            </div>
            
            <!-- Funcionalidade 6 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-shield-check text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('institutional.feature_security_title') }}</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.feature_security_description') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Demonstração Visual -->
<section class="py-20 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('institutional.demo_title') }}
                </h2>
                <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
                    {{ __('institutional.demo_subtitle') }}
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.demo_step_1_title') }}</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ __('institutional.demo_step_1_description') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.demo_step_2_title') }}</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ __('institutional.demo_step_2_description') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('institutional.demo_step_3_title') }}</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ __('institutional.demo_step_3_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <!-- Mockup do WhatsApp -->
                <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl p-6 max-w-sm mx-auto">
                    <div class="bg-green-500 text-white p-3 rounded-t-lg text-center text-sm font-medium">
                        {{ __('institutional.whatsapp_bot_name') }}
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-b-lg">
                        <div class="space-y-3">
                            <div class="bg-gray-200 dark:bg-gray-600 p-3 rounded-lg text-sm">
                                {{ __('institutional.whatsapp_message_example') }}
                            </div>
                            <div class="bg-plume-100 dark:bg-plume-900/20 p-3 rounded-lg text-sm">
                                ✅ {{ __('institutional.whatsapp_response_registered') }}<br>
                                📊 {{ __('institutional.whatsapp_response_category') }}<br>
                                📅 {{ __('institutional.whatsapp_response_date') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Arrow pointing to dashboard -->
                <div class="absolute -right-8 top-1/2 transform -translate-y-1/2 hidden lg:block">
                    <i class="ti ti-arrow-right text-4xl text-plume-600 dark:text-plume-400"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Rápido -->
<section class="py-20 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('institutional.faq_title') }}
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                {{ __('institutional.faq_subtitle') }}
            </p>
        </div>
        
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    {{ __('institutional.faq_free_question') }}
                </h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.faq_free_answer') }}
                </p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    {{ __('institutional.faq_security_question') }}
                </h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.faq_security_answer') }}
                </p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    {{ __('institutional.faq_app_question') }}
                </h3>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ __('institutional.faq_app_answer') }}
                </p>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('institutional.faq') }}" class="inline-flex items-center px-6 py-3 border-2 border-plume-600 dark:border-plume-400 text-plume-600 dark:text-plume-400 font-medium rounded-lg hover:bg-plume-600 dark:hover:bg-plume-400 hover:text-white transition-colors">
                {{ __('institutional.view_all_questions') }}
                <i class="ti ti-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 px-6 bg-plume-600 dark:bg-plume-800 text-white">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            {{ __('institutional.ready_to_start') }}
        </h2>
        <p class="text-xl text-plume-100 mb-8">
            {{ __('institutional.join_thousands') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-plume-600 font-medium rounded-lg hover:bg-gray-100 transition-colors shadow-lg transform hover:scale-[1.02]">
                {{ __('institutional.create_free_account') }}
                <i class="ti ti-arrow-right ml-2"></i>
            </a>
            <a href="{{ route('institutional.contact') }}" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-plume-600 transition-colors">
                {{ __('institutional.talk_to_support') }}
            </a>
        </div>
    </div>
</section>
@endsection
