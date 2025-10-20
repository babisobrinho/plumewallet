<x-slot name="header">
    <x-backoffice-header
        :title="__('dashboard.title')"
        :subtitle="__('dashboard.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Métricas Principais -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-8">
            <!-- Total de Utilizadores -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-users w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                                Total de Utilizadores
                            </p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($totalUsers) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Utilizadores Ativos -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-circle-check w-6 h-6 text-green-600 dark:text-green-400"></i>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                                Utilizadores Ativos
                            </p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($activeUsers) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total de Transações -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-chart-bar w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                                Total de Transações
                            </p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($totalTransactions) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total de Contas -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-file-text w-6 h-6 text-red-600 dark:text-red-400"></i>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                                Total de Contas
                            </p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($totalAccounts) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets em Aberto -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-ticket w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                                Tickets em Aberto
                            </p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                0
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Posts Publicados -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center">
                                <i class="ti ti-file-text w-6 h-6 text-indigo-600 dark:text-indigo-400"></i>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                                Posts Publicados
                            </p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                0
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Atividade Recente -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Utilizadores Recentes -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Utilizadores Recentes
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="ti ti-users w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Novos utilizadores (7 dias)</span>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $recentUsers }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="ti ti-circle-check w-4 h-4 text-green-600 dark:text-green-400"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Utilizadores verificados</span>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $activeUsers }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets Recentes -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tickets Recentes
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="ti ti-ticket w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Tickets em aberto</span>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-white">0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center mr-3">
                                    <i class="ti ti-chart-bar w-4 h-4 text-yellow-600 dark:text-yellow-400"></i>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Novas transações (7 dias)</span>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $recentTransactions }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
