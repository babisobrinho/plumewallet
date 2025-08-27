<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Novo Orçamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Explicação da Criação -->
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <i class="ti ti-plus-circle text-green-600 dark:text-green-400 text-xl mr-3 mt-0.5"></i>
                            <div>
                                <h3 class="font-medium text-green-800 dark:text-green-200 mb-2">Criar Novo Orçamento</h3>
                                <p class="text-sm text-green-700 dark:text-green-300">
                                    <strong>1.</strong> Defina o período do orçamento (ex: mês atual)<br>
                                    <strong>2.</strong> Para cada categoria, digite quanto quer gastar<br>
                                    <strong>3.</strong> O sistema criará envelopes para controlar seus gastos
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('budget.store') }}" class="space-y-6">
                        @csrf
                        
                        <div>
                            <x-label for="name" value="{{ __('Nome do Orçamento') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error for="name" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="start_date" value="{{ __('Data de Início') }}" />
                                <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required />
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ex: Primeiro dia do mês (01/01/2025)</p>
                                <x-input-error for="start_date" class="mt-2" />
                            </div>

                            <div>
                                <x-label for="end_date" value="{{ __('Data de Fim') }}" />
                                <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" required />
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ex: Último dia do mês (31/01/2025)</p>
                                <x-input-error for="end_date" class="mt-2" />
                            </div>
                        </div>
                        
                        <!-- Seletores Rápidos de Período -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Períodos Comuns:</h4>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" onclick="setPeriod('current-month')" class="px-3 py-2 text-sm bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-800 dark:text-blue-200 rounded-md transition-colors">
                                    Mês Atual
                                </button>
                                <button type="button" onclick="setPeriod('next-month')" class="px-3 py-2 text-sm bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:hover:bg-green-900/50 text-green-800 dark:text-green-200 rounded-md transition-colors">
                                    Próximo Mês
                                </button>
                                <button type="button" onclick="setPeriod('quarter')" class="px-3 py-2 text-sm bg-purple-100 hover:bg-purple-200 dark:bg-purple-900/30 dark:hover:bg-purple-900/50 text-purple-800 dark:text-purple-200 rounded-md transition-colors">
                                    Trimestre
                                </button>
                                <button type="button" onclick="setPeriod('year')" class="px-3 py-2 text-sm bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/30 dark:hover:bg-orange-900/50 text-orange-800 dark:text-orange-200 rounded-md transition-colors">
                                    Ano
                                </button>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                {{ __('Envelopes de Orçamento') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                Para cada categoria, defina quanto dinheiro quer reservar para gastos este mês. 
                                Deixe em 0 se não quiser orçar para essa categoria.
                            </p>
                            
                            <div id="envelopes-container" class="space-y-4">
                                @foreach($categories as $category)
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            {{ $category->name }}
                                        </label>
                                        <input type="hidden" name="envelopes[{{ $loop->index }}][category_id]" value="{{ $category->id }}">
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">€</span>
                                            <x-input 
                                                type="number" 
                                                step="0.01" 
                                                min="0"
                                                name="envelopes[{{ $loop->index }}][budgeted_amount]" 
                                                placeholder="0.00"
                                                class="w-full pl-8"
                                                :value="old('envelopes.' . $loop->index . '.budgeted_amount', 0)"
                                            />
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Quanto quer gastar em {{ strtolower($category->name) }} este mês
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
                                {{ __('Criar Orçamento') }}
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

        // Seletores rápidos de período
        function setPeriod(type) {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const nameInput = document.getElementById('name');
            
            const now = new Date();
            let startDate, endDate, name;
            
            switch(type) {
                case 'current-month':
                    startDate = new Date(now.getFullYear(), now.getMonth(), 1);
                    endDate = new Date(now.getFullYear(), now.getMonth() + 1, 0);
                    name = startDate.toLocaleDateString('pt-BR', { month: 'long', year: 'numeric' });
                    break;
                case 'next-month':
                    startDate = new Date(now.getFullYear(), now.getMonth() + 1, 1);
                    endDate = new Date(now.getFullYear(), now.getMonth() + 2, 0);
                    name = startDate.toLocaleDateString('pt-BR', { month: 'long', year: 'numeric' });
                    break;
                case 'quarter':
                    const quarter = Math.floor(now.getMonth() / 3);
                    startDate = new Date(now.getFullYear(), quarter * 3, 1);
                    endDate = new Date(now.getFullYear(), (quarter + 1) * 3, 0);
                    name = `${quarter + 1}º Trimestre ${now.getFullYear()}`;
                    break;
                case 'year':
                    startDate = new Date(now.getFullYear(), 0, 1);
                    endDate = new Date(now.getFullYear(), 11, 31);
                    name = `Ano ${now.getFullYear()}`;
                    break;
            }
            
            startDateInput.value = startDate.toISOString().split('T')[0];
            endDateInput.value = endDate.toISOString().split('T')[0];
            nameInput.value = name;
        }
    </script>
</x-app-layout>
