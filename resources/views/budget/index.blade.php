<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Budget
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $currentBudget->getMonthName() }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <button id="month-selector" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                    <span>{{ $currentBudget->getMonthName() }}</span>
                    <i class="ti ti-chevron-down ml-1"></i>
                </button>
                <a href="{{ route('budget.edit', $currentBudget) }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="ti ti-edit mr-2"></i>Editar Budget
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <!-- Resumo do Budget -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Receita do Mês -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-emerald-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-emerald-100 dark:bg-emerald-900/20 mr-4">
                        <i class="ti ti-trending-up text-2xl text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Receita do Mês</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">€{{ number_format($totalIncome, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Alocado -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/20 mr-4">
                        <i class="ti ti-wallet text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Alocado</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">€{{ number_format($currentBudget->total_budgeted, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Gasto -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-red-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 dark:bg-red-900/20 mr-4">
                        <i class="ti ti-trending-down text-2xl text-red-600 dark:text-red-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Gasto</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">€{{ number_format($totalSpent, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Disponível -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-teal-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-teal-100 dark:bg-teal-900/20 mr-4">
                        <i class="ti ti-check text-2xl text-teal-600 dark:text-teal-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Disponível</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">€{{ number_format($currentBudget->total_available, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barra de Progresso Geral -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Progresso do Budget</h3>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    @if($currentBudget->total_income > 0)
                        {{ number_format(($currentBudget->total_budgeted / $currentBudget->total_income) * 100, 1) }}% alocado
                    @else
                        0% alocado
                    @endif
                </span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                <div class="bg-teal-600 h-3 rounded-full transition-all duration-300" 
                     style="width: {{ $currentBudget->total_income > 0 ? min(($currentBudget->total_budgeted / $currentBudget->total_income) * 100, 100) : 0 }}%"></div>
            </div>
        </div>

        <!-- Envelopes do Budget -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Envelopes do Budget</h3>
                <div class="flex space-x-3">
                    <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="ti ti-plus mr-2"></i>Nova Categoria
                    </a>
                    <a href="{{ route('expenses.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="ti ti-plus mr-2"></i>Nova Despesa
                    </a>
                </div>
            </div>

            @if($currentBudget->envelopes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($currentBudget->envelopes as $envelope)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" 
                                         style="background-color: {{ $envelope->category->color }}">
                                        <i class="{{ $envelope->category->icon }} text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800 dark:text-white">{{ $envelope->category->name }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($envelope->category->type) }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs px-2 py-1 rounded-full text-xs font-medium
                                        @if($envelope->status === 'overspent') bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400
                                        @elseif($envelope->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400
                                        @else bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400 @endif">
                                        {{ ucfirst($envelope->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Valores -->
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Alocado:</span>
                                    <span class="font-medium text-gray-800 dark:text-white">€{{ number_format($envelope->budgeted_amount, 2, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Gasto:</span>
                                    <span class="font-medium text-gray-800 dark:text-white">€{{ number_format($envelope->spent_amount, 2, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Disponível:</span>
                                    <span class="font-medium @if($envelope->available_amount < 0) text-red-600 dark:text-red-400 @else text-gray-800 dark:text-white @endif">
                                        €{{ number_format($envelope->available_amount, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Barra de Progresso -->
                            <div class="mb-3">
                                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                                    <span>0%</span>
                                    <span>{{ $envelope->getUsagePercentage() }}%</span>
                                    <span>100%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="h-2 rounded-full transition-all duration-300
                                        @if($envelope->available_amount < 0) bg-red-500
                                        @elseif($envelope->getUsagePercentage() >= 100) bg-green-500
                                        @else bg-blue-500 @endif"
                                         style="width: {{ min($envelope->getUsagePercentage(), 100) }}%"></div>
                                </div>
                            </div>

                            <!-- Ações -->
                            <div class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('expenses.create') }}?category={{ $envelope->category_id }}" 
                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                    <i class="ti ti-plus mr-1"></i>Adicionar Despesa
                                </a>
                                <a href="{{ route('categories.transactions', $envelope->category) }}" 
                                   class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300 text-sm">
                                    <i class="ti ti-eye mr-1"></i>Ver Transações
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Botão para Alocar Dinheiro -->
                <div class="mt-8 text-center">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-2">
                            🎯 Próximo Passo: Alocar seu Dinheiro
                        </h4>
                        <p class="text-blue-600 dark:text-blue-300 mb-4">
                            Agora que você tem €{{ number_format($currentBudget->total_available, 2, ',', '.') }} disponível, 
                            clique em "Editar Budget" para distribuir esse dinheiro entre suas categorias!
                        </p>
                        <a href="{{ route('budget.edit', $currentBudget) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-lg font-medium transition-colors">
                            <i class="ti ti-edit mr-2"></i>Alocar Dinheiro às Categorias
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <i class="ti ti-wallet text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhum envelope criado</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Crie categorias e configure seu budget para começar.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="ti ti-plus mr-2"></i>Criar Categoria
                        </a>
                        <a href="{{ route('budget.edit', $currentBudget) }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="ti ti-edit mr-2"></i>Configurar Budget
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Dicas YNAB -->
        <div class="bg-gradient-to-r from-blue-50 to-teal-50 dark:from-blue-900/20 dark:to-teal-900/20 rounded-lg p-6 mt-8">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="ti ti-lightbulb text-yellow-500 mr-2"></i>
                Como Funciona o Budget
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-300">
                <div class="flex items-start">
                    <i class="ti ti-check text-green-500 mr-2 mt-0.5"></i>
                    <span><strong>1.</strong> Você tem €{{ number_format($currentBudget->total_available, 2, ',', '.') }} disponível</span>
                </div>
                <div class="flex items-start">
                    <i class="ti ti-check text-green-500 mr-2 mt-0.5"></i>
                    <span><strong>2.</strong> Clique em "Alocar Dinheiro às Categorias"</span>
                </div>
                <div class="flex items-start">
                    <i class="ti ti-check text-green-500 mr-2 mt-0.5"></i>
                    <span><strong>3.</strong> Defina quanto quer gastar em cada categoria</span>
                </div>
                <div class="flex items-start">
                    <i class="ti ti-check text-green-500 mr-2 mt-0.5"></i>
                    <span><strong>4.</strong> Quando gastar, o dinheiro sai do envelope da categoria</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
