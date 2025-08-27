<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Orçamento') }}: {{ $budget->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Explicação da Edição -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <i class="ti ti-info-circle text-blue-600 dark:text-blue-400 text-xl mr-3 mt-0.5"></i>
                            <div>
                                <h3 class="font-medium text-blue-800 dark:text-blue-200 mb-2">Como Editar seu Orçamento</h3>
                                <p class="text-sm text-blue-700 dark:text-blue-300">
                                    <strong>1.</strong> Digite quanto quer gastar em cada categoria no campo "Valor Orçado"<br>
                                    <strong>2.</strong> O sistema calcula automaticamente quanto ficará disponível<br>
                                    <strong>3.</strong> Clique em "Atualizar Orçamento" para salvar as mudanças
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('budget.update', $budget) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <x-label for="name" value="{{ __('Nome do Orçamento') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $budget->name)" required autofocus />
                            <x-input-error for="name" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="start_date" value="{{ __('Data de Início') }}" />
                                <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date', $budget->start_date->format('Y-m-d'))" required />
                                <x-input-error for="start_date" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="end_date" value="{{ __('Data de Fim') }}" />
                                <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date', $budget->end_date->format('Y-m-d'))" required />
                                <x-input-error for="end_date" class="mt-2" />
                            </div>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Envelopes de Orçamento') }}
                            </h3>
                            
                            <div id="envelopes-container" class="space-y-4">
                                @foreach($categories as $category)
                                @php
                                    $envelope = $budget->envelopes->where('category_id', $category->id)->first();
                                    $budgetedAmount = $envelope ? $envelope->budgeted_amount : 0;
                                    $spentAmount = $envelope ? $envelope->spent_amount : 0;
                                @endphp
                                <div id="category-{{ $category->id }}" class="flex items-center space-x-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                {{ $category->name }}
                                            </label>
                                            @if($envelope)
                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    Gasto: R$ {{ number_format($spentAmount, 2, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <input type="hidden" name="envelopes[{{ $loop->index }}][category_id]" value="{{ $category->id }}">
                                        @if($envelope)
                                            <input type="hidden" name="envelopes[{{ $loop->index }}][id]" value="{{ $envelope->id }}">
                                        @endif
                                        
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">€</span>
                                            <x-input 
                                                type="number" 
                                                step="0.01" 
                                                min="0"
                                                name="envelopes[{{ $loop->index }}][budgeted_amount]" 
                                                placeholder="0.00"
                                                class="w-full pl-8"
                                                :value="old('envelopes.' . $loop->index . '.budgeted_amount', $budgetedAmount)"
                                            />
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Quanto você planeja gastar nesta categoria este mês
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <x-secondary-button type="button" onclick="window.history.back()">
                                {{ __('Cancelar') }}
                            </x-secondary-button>
                            
                            <x-button>
                                {{ __('Atualizar Orçamento') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validação de datas
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = this.value;
            const endDateInput = document.getElementById('end_date');
            
            if (startDate && endDateInput.value && startDate >= endDateInput.value) {
                endDateInput.setCustomValidity('A data de fim deve ser posterior à data de início');
            } else {
                endDateInput.setCustomValidity('');
            }
        });

        document.getElementById('end_date').addEventListener('change', function() {
            const endDate = this.value;
            const startDateInput = document.getElementById('start_date');
            
            if (endDate && startDateInput.value && endDate <= startDateInput.value) {
                this.setCustomValidity('A data de fim deve ser posterior à data de início');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</x-app-layout>
