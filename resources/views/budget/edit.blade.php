<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Editar Budget
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $budget->getMonthName() }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('budget.index') }}" class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="ti ti-arrow-left mr-2"></i>Voltar ao Budget
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-12">
        <form action="{{ route('budget.update', $budget) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Informações do Budget -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informações do Budget</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nome do Budget
                        </label>
                        <input type="text" name="name" id="name" value="{{ $budget->name }}" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Data de Início
                        </label>
                        <input type="date" name="start_date" id="start_date" value="{{ $budget->start_date->format('Y-m-d') }}" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Data de Fim
                        </label>
                        <input type="date" name="end_date" id="end_date" value="{{ $budget->end_date->format('Y-m-d') }}" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                    </div>
                </div>
            </div>

            <!-- Envelopes do Budget -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Envelopes do Budget</h3>
                    <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="ti ti-plus mr-2"></i>Nova Categoria
                    </a>
                </div>
                
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Configure quanto dinheiro alocar para cada categoria de despesa. 
                    O total alocado não deve exceder sua receita mensal.
                </p>

                @if($categories->count() > 0)
                    <div class="space-y-4" id="envelopes-container">
                        @foreach($budget->envelopes as $envelope)
                            <div class="envelope-item border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                    <input type="hidden" name="envelopes[{{ $loop->index }}][id]" value="{{ $envelope->id }}">
                                    <input type="hidden" name="envelopes[{{ $loop->index }}][category_id]" value="{{ $envelope->category_id }}">
                                    
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
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Valor Alocado (€)
                                        </label>
                                        <input type="number" 
                                               name="envelopes[{{ $loop->index }}][budgeted_amount]" 
                                               value="{{ $envelope->budgeted_amount }}" 
                                               step="0.01" 
                                               min="0"
                                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent dark:bg-gray-700 dark:text-white envelope-amount"
                                               data-category="{{ $envelope->category->name }}">
                                    </div>
                                    
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Gasto Real:</div>
                                        <div class="text-lg font-semibold @if($envelope->spent_amount > $envelope->budgeted_amount) text-red-600 dark:text-red-400 @else text-gray-800 dark:text-white @endif">
                                            €{{ number_format($envelope->spent_amount, 2, ',', '.') }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            @if($envelope->spent_amount > 0)
                                                {{ $envelope->getUsagePercentage() }}% do orçado
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Resumo dos Totais -->
                    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Total Alocado</div>
                                <div class="text-xl font-bold text-blue-600 dark:text-blue-400" id="total-budgeted">€0.00</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Total Gasto</div>
                                <div class="text-xl font-bold text-red-600 dark:text-red-400">€{{ number_format($budget->total_spent, 2, ',', '.') }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Disponível</div>
                                <div class="text-xl font-bold text-teal-600 dark:text-teal-400" id="total-available">€0.00</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <i class="ti ti-category text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhuma categoria encontrada</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">Crie categorias de despesa para configurar seu budget.</p>
                        <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-sm font-medium transition-colors">
                            <i class="ti ti-plus mr-2"></i>Criar Primeira Categoria
                        </a>
                    </div>
                @endif
            </div>

            <!-- Botões de Ação -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('budget.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg font-medium transition-colors">
                    <i class="ti ti-check mr-2"></i>Salvar Budget
                </button>
            </div>
        </form>
    </div>

    <script>
        // Calcular totais em tempo real
        function calculateTotals() {
            let totalBudgeted = 0;
            const amounts = document.querySelectorAll('.envelope-amount');
            
            amounts.forEach(input => {
                const value = parseFloat(input.value) || 0;
                totalBudgeted += value;
            });
            
            const totalSpent = {{ $budget->total_spent }};
            const totalAvailable = totalBudgeted - totalSpent;
            
            document.getElementById('total-budgeted').textContent = '€' + totalBudgeted.toFixed(2).replace('.', ',');
            document.getElementById('total-available').textContent = '€' + totalAvailable.toFixed(2).replace('.', ',');
            
            // Destacar se o valor disponível for negativo
            const availableElement = document.getElementById('total-available');
            if (totalAvailable < 0) {
                availableElement.classList.add('text-red-600', 'dark:text-red-400');
                availableElement.classList.remove('text-teal-600', 'dark:text-teal-400');
            } else {
                availableElement.classList.remove('text-red-600', 'dark:text-red-400');
                availableElement.classList.add('text-teal-600', 'dark:text-teal-400');
            }
        }
        
        // Adicionar event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const amountInputs = document.querySelectorAll('.envelope-amount');
            amountInputs.forEach(input => {
                input.addEventListener('input', calculateTotals);
            });
            
            // Calcular totais iniciais
            calculateTotals();
        });
    </script>
</x-app-layout>
