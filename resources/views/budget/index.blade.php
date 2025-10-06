<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Meu Orçamento Mensal') }}
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $currentBudget->getMonthName() }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <button id="month-selector" class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                    <span>{{ $currentBudget->getMonthName() }}</span>
                    <i class="ti ti-chevron-down ml-1"></i>
                </button>
                <a href="{{ route('budget.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="ti ti-plus mr-2"></i>{{ __('Novo Orçamento') }}
                </a>
                <a href="{{ route('budget.show', $currentBudget) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="ti ti-eye mr-2"></i>{{ __('Ver Detalhes') }}
                </a>
                <a href="{{ route('budget.edit', $currentBudget) }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="ti ti-edit mr-2"></i>{{ __('Configurar Orçamento') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <!-- Explicação do Sistema de Orçamento -->
        <div class="bg-gradient-to-r from-blue-50 to-teal-50 dark:from-blue-900/20 dark:to-teal-900/20 rounded-lg p-6 mb-8 border border-blue-200 dark:border-blue-800">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="ti ti-lightbulb text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Como Funciona o Sistema de Orçamento
                    </h2>
                    <div class="text-sm text-gray-700 dark:text-gray-300 space-y-2">
                        <p><strong>1.</strong> <strong>Receita:</strong> Todo dinheiro que entra no mês (salário, extras, etc.)</p>
                        <p><strong>2.</strong> <strong>Orçamento:</strong> Você decide quanto quer gastar em cada categoria (alimentação, transporte, lazer, etc.)</p>
                        <p><strong>3.</strong> <strong>Controle:</strong> Quando gasta, o dinheiro sai do "envelope" da categoria</p>
                        <p><strong>4.</strong> <strong>Resultado:</strong> Você sempre sabe quanto ainda pode gastar em cada categoria!</p>
                    </div>
                    <div class="mt-4 p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <p class="text-sm text-blue-800 dark:text-blue-200">
                            <strong>Dica:</strong> Este sistema é baseado no método YNAB (You Need A Budget) e ajuda você a nunca gastar mais do que ganha!
                        </p>
                    </div>
                </div>
            </div>
        </div>

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
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Dinheiro Orçado</p>
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
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ainda Disponível</p>
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
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Meus Envelopes de Orçamento</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Cada envelope representa uma categoria onde você pode alocar dinheiro</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="ti ti-plus mr-2"></i>Nova Categoria
                    </a>
                    <a href="{{ route('budget.edit', $currentBudget) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="ti ti-plus mr-2"></i>Adicionar Categoria ao Orçamento
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
                            <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200 dark:border-gray-700">
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

        <!-- Lista de Todos os Orçamentos -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Todos os Meus Orçamentos</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Gerencie orçamentos de diferentes períodos</p>
                </div>
                <a href="{{ route('budget.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="ti ti-plus mr-2"></i>Criar Novo Orçamento
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Período</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Receita</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Orçado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Gasto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Disponível</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($allBudgets as $budget)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $budget->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $budget->start_date->format('d/m/Y') }} - {{ $budget->end_date->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                €{{ number_format($budget->total_income, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                €{{ number_format($budget->total_budgeted, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                €{{ number_format($budget->total_spent, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $budget->total_available >= 0 ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400' }}">
                                    €{{ number_format($budget->total_available, 2, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('budget.show', $budget) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                    <i class="ti ti-eye mr-1"></i>Ver
                                </a>
                                <a href="{{ route('budget.edit', $budget) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                    <i class="ti ti-edit mr-1"></i>Editar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Dicas de Uso -->
        <div class="bg-gradient-to-r from-blue-50 to-teal-50 dark:from-blue-900/20 dark:to-teal-900/20 rounded-lg p-6 mt-8">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="ti ti-lightbulb text-yellow-500 mr-2"></i>
                Dicas para Usar o Sistema
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-300">
                <div class="flex items-start">
                    <i class="ti ti-check text-green-500 mr-2 mt-0.5"></i>
                    <span><strong>1.</strong> <strong>Configure primeiro:</strong> Defina quanto quer gastar em cada categoria</span>
                </div>
                <div class="flex items-start">
                    <i class="ti ti-check text-green-500 mr-2 mt-0.5"></i>
                    <span><strong>2.</strong> <strong>Registre despesas:</strong> Sempre anote quando gastar dinheiro</span>
                </div>
                <div class="flex items-start">
                    <i class="ti ti-check text-green-500 mr-2 mt-0.5"></i>
                    <span><strong>3.</strong> <strong>Acompanhe:</strong> Veja quanto ainda pode gastar em cada categoria</span>
                </div>
                <div class="flex items-start">
                    <i class="ti ti-check text-green-500 mr-2 mt-0.5"></i>
                    <span><strong>4.</strong> <strong>Ajuste quando necessário:</strong> Mude os valores conforme sua realidade</span>
                </div>
            </div>
            <div class="mt-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                <p class="text-sm text-yellow-800 dark:text-yellow-200">
                    <strong>🎯 Objetivo:</strong> Este sistema ajuda você a nunca gastar mais do que ganha e ter controle total sobre suas finanças!
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
