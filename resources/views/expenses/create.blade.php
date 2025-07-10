<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('transactions.incomes') }}"
                   class="mr-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors duration-150">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Nova Despesa') }}
                </h2>
            </div>
            <a href="{{ route('transactions.expenses') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-md font-semibold
                text-xs text-white uppercase tracking-widest hover:from-red-700 hover:to-red-800 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                </svg>
                Ver Despesas
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-l-4 border-red-600">
                <form method="POST" action="{{ route('expenses.store') }}" class="p-6 space-y-6">
                    @csrf

                    <!-- Descrição -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Descrição
                        </label>
                        <input type="text"
                               id="description"
                               name="description"
                               value="{{ old('description') }}"
                               required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-gray-200 dark:placeholder-gray-400"
                               placeholder="Ex: Gasóleo, Alimentação, Cinema...">
                        @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Valor -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Valor
                        </label>
                        <div class="relative">
                            <input type="number"
                                   id="amount"
                                   name="amount"
                                   value="{{ old('amount') }}"
                                   step="0.01"
                                   min="0.01"
                                   max="999999.99"
                                   required
                                   class="w-full px-3 py-2 pr-8 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-gray-200">
                            <span class="absolute right-3 top-2 text-gray-500 dark:text-gray-400">€</span>
                        </div>
                        @error('amount')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Carteira -->
                    <div>
                        <label for="account_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Carteira
                        </label>
                        <select id="account_id"
                                name="account_id"
                                required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Selecione uma carteira</option>
                            @foreach($accounts as $id => $name)
                                <option value="{{ $id }}" {{ old('account_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('account_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoria -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Categoria (Opcional)
                        </label>
                        <select id="category_id"
                                name="category_id"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Sem categoria</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Data da Transação -->
                    <div>
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Data da Transação
                        </label>
                        <input type="date"
                               id="transaction_date"
                               name="transaction_date"
                               value="{{ old('transaction_date', date('Y-m-d')) }}"
                               required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-gray-200">
                        @error('transaction_date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status
                        </label>
                        <select id="status"
                                name="status"
                                required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-gray-200">
                            <option value="completed" {{ old('status', 'completed') == 'completed' ? 'selected' : '' }}>
                                Completado
                            </option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                Pendente
                            </option>
                        </select>
                        @error('status')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Observações -->
                    <div>
                        <label for="obs" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Observações (Opcional)
                        </label>
                        <textarea id="obs"
                                  name="obs"
                                  rows="3"
                                  maxlength="1000"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-gray-200 dark:placeholder-gray-400"
                                  placeholder="Informações adicionais sobre esta despesa...">{{ old('obs') }}</textarea>
                        @error('obs')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end space-x-4 pt-6">
                        <a href="{{ route('expenses.index') }}"
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-red-700 hover:to-red-800 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Criar Despesa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
