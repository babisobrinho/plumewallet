<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-gradient-to-br from-plume-blue-600 to-plume-teal-600 rounded-full flex items-center justify-center mb-4">
                    <i class="ti ti-wallet text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                    Bem-vindo ao Plume Wallet! 🎉
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                    Vamos configurar a sua conta para começar a organizar as suas finanças.
                </p>
            </div>

            <!-- Options -->
            <div class="space-y-4">
                <!-- Template Pré-definido -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-plume-blue-300 dark:hover:border-plume-blue-500 transition-colors">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-plume-blue-100 dark:bg-plume-blue-900 rounded-full flex items-center justify-center">
                                <i class="ti ti-check text-plume-blue-600 dark:text-plume-blue-400"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Template Pré-definido</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Recomendado - Responda a algumas perguntas e criamos a configuração ideal para si</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('onboarding.questionnaire') }}" 
                           class="w-full bg-plume-blue-600 hover:bg-plume-blue-700 text-white py-2 px-4 rounded-lg transition-colors inline-block text-center font-medium">
                            Começar Configuração
                        </a>
                    </div>
                </div>

                <!-- Configuração Mínima -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-plume-teal-300 dark:hover:border-plume-teal-500 transition-colors">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-plume-teal-100 dark:bg-plume-teal-900 rounded-full flex items-center justify-center">
                                <i class="ti ti-bolt text-plume-teal-600 dark:text-plume-teal-400"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Configuração Rápida</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Criar configuração básica agora e personalizar depois</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <form method="POST" action="{{ route('onboarding.quick-setup') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-plume-teal-600 hover:bg-plume-teal-700 text-white py-2 px-4 rounded-lg transition-colors font-medium">
                                Configuração Mínima
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Pode sempre alterar estas configurações mais tarde nas definições da sua conta.
                </p>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm w-full mx-4 shadow-xl">
            <div class="flex items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-plume-blue-600 mr-3"></div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">A configurar...</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Por favor aguarde</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show loading overlay when form is submitted
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                document.getElementById('loading-overlay').classList.remove('hidden');
            });
        });

        // Show loading overlay when clicking questionnaire link
        document.querySelector('a[href="{{ route('onboarding.questionnaire') }}"]').addEventListener('click', function() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        });
    </script>
</x-app-layout>
