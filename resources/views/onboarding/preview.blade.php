<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-gray-800 dark:to-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto h-16 w-16 bg-gradient-to-br from-plume-teal-600 to-plume-blue-600 rounded-full flex items-center justify-center mb-4">
                    <i class="ti ti-check text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                    Configuração Personalizada Criada! ✨
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 dark:text-gray-400">
                    Baseado nas suas respostas, criámos esta configuração ideal para si
                </p>
            </div>

            <!-- Template Preview -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8 mb-8 border border-gray-200 dark:border-gray-700">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">{{ $template->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $template->description }}</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Categories Preview -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <i class="ti ti-tag text-plume-blue-600 dark:text-plume-blue-400 mr-2"></i>
                            Categorias ({{ count($template->categories) }})
                        </h4>
                        <div class="space-y-2">
                            @foreach($template->categories as $category)
                                <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-4 h-4 rounded-full {{ $category['color'] }} mr-3"></div>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-800 dark:text-gray-200">{{ $category['name'] }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 capitalize">{{ $category['type'] }}</div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        @if($category['type'] === 'income')
                                            <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Accounts Preview -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <i class="ti ti-wallet text-plume-teal-600 dark:text-plume-teal-400 mr-2"></i>
                            Contas ({{ count($template->accounts) }})
                        </h4>
                        <div class="space-y-2">
                            @foreach($template->accounts as $account)
                                <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="w-4 h-4 rounded-full {{ $account['color'] }} mr-3"></div>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-800 dark:text-gray-200">{{ $account['name'] }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            @if($account['is_balance_effective'])
                                                Saldo efetivo
                                            @else
                                                Saldo não efetivo
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <form method="POST" action="{{ route('onboarding.apply-template') }}" class="flex-1 max-w-xs">
                    @csrf
                    <input type="hidden" name="template_id" value="{{ $template->id }}">
                    <button type="submit" 
                            class="w-full bg-plume-teal-600 hover:bg-plume-teal-700 text-white py-3 px-6 rounded-lg transition-colors font-semibold">
                        <i class="ti ti-check mr-2"></i>Aplicar Esta Configuração
                    </button>
                </form>
                
                <a href="{{ route('onboarding.questionnaire') }}" 
                   class="flex-1 max-w-xs bg-gray-600 hover:bg-gray-700 text-white py-3 px-6 rounded-lg transition-colors font-semibold text-center">
                    <i class="ti ti-refresh mr-2"></i>Responder Novamente
                </a>
                
                <a href="{{ route('onboarding.welcome') }}" 
                   class="flex-1 max-w-xs bg-plume-blue-600 hover:bg-plume-blue-700 text-white py-3 px-6 rounded-lg transition-colors font-semibold text-center">
                    <i class="ti ti-bolt mr-2"></i>Configuração Rápida
                </a>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-plume-blue-50 dark:bg-plume-blue-900 border border-plume-blue-200 dark:border-plume-blue-700 rounded-lg p-6">
                <div class="flex items-start">
                    <i class="ti ti-info-circle text-plume-blue-600 dark:text-plume-blue-400 mt-0.5 mr-3 text-xl"></i>
                    <div>
                        <h4 class="font-semibold text-plume-blue-900 dark:text-plume-blue-100 mb-2">Informação Importante</h4>
                        <p class="text-plume-blue-800 dark:text-plume-blue-200 text-sm">
                            Após aplicar esta configuração, poderá sempre editar, adicionar ou remover categorias e contas 
                            nas definições da sua conta. Esta é apenas uma base para começar!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm w-full mx-4 shadow-xl">
            <div class="flex items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-plume-teal-600 mr-3"></div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">A configurar...</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">A criar as suas categorias e contas</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show loading overlay when form is submitted
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        });
    </script>
</x-app-layout>
