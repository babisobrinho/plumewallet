<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Orçamento') }}: {{ $budget->name }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('budget.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-md transition-colors">
                    <i class="ti ti-arrow-left mr-2"></i>{{ __('Voltar') }}
                </a>
                <form method="POST" action="{{ route('budget.destroy', $budget) }}" class="inline" 
                      onsubmit="return confirm('Tem certeza que deseja excluir este orçamento?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md transition-colors">
                        <i class="ti ti-trash mr-2"></i>{{ __('Excluir') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resumo do Orçamento -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                                R$ {{ number_format($budget->total_income, 2, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Receita Total</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                R$ {{ number_format($budget->total_budgeted, 2, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Orçado</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold text-red-600 dark:text-red-400">
                                R$ {{ number_format($budget->total_spent, 2, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Gasto</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold {{ $budget->total_available >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                R$ {{ number_format($budget->total_available, 2, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Disponível</div>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                        <span class="font-medium">Período:</span> 
                        {{ $budget->start_date->format('d/m/Y') }} - {{ $budget->end_date->format('d/m/Y') }}
                    </div>
                </div>
            </div>

            <!-- Envelopes de Orçamento -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Envelopes de Orçamento') }}
                    </h3>
                    
                    <div class="space-y-4">
                        @forelse($budget->envelopes as $envelope)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $envelope->category->name }}
                                </h4>
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $envelope->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                       ($envelope->status === 'warning' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                    {{ ucfirst($envelope->status) }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Orçado:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100 ml-2">
                                        R$ {{ number_format($envelope->budgeted_amount, 2, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Gasto:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100 ml-2">
                                        R$ {{ number_format($envelope->spent_amount, 2, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Disponível:</span>
                                    <span class="font-medium {{ $envelope->available_amount >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} ml-2">
                                        R$ {{ number_format($envelope->available_amount, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            
                            @if($envelope->rollover_amount > 0)
                            <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-medium">Transferido do mês anterior:</span>
                                R$ {{ number_format($envelope->rollover_amount, 2, ',', '.') }}
                            </div>
                            @endif
                            
                            <!-- Barra de Progresso -->
                            @if($envelope->budgeted_amount > 0)
                            <div class="mt-3">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    @php
                                        $percentage = min(100, ($envelope->spent_amount / $envelope->budgeted_amount) * 100);
                                        $barColor = $percentage <= 80 ? 'bg-green-500' : ($percentage <= 100 ? 'bg-yellow-500' : 'bg-red-500');
                                    @endphp
                                    <div class="h-2 rounded-full {{ $barColor }}" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ number_format($percentage, 1) }}% do orçamento utilizado
                                </div>
                            </div>
                            @endif
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            Nenhum envelope de orçamento encontrado.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
