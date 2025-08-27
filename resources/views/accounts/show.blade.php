<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('accounts.index') }}"
                   class="mr-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors duration-150">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $account->name }}
                </h2>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('accounts.archive') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 border border-gray-500 text-white font-medium rounded-lg transition-colors duration-300 ease-in-out">
                    <i class="ti ti-archive mr-2"></i>
                    Ver Carteiras Desativadas
                </a>

            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Cartão Principal da Carteira -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center text-white mr-6"
                                 style="background-color: {{ $account->color }};">
                                <i class="ti ti-{{ $account->icon }} text-3xl"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $account->name }}
                                </h1>
                                <p class="text-lg text-gray-600 dark:text-gray-400 capitalize">
                                    {{ $account->accountType->name }}
                                </p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                Saldo Atual
                            </p>
                            <p class="text-4xl font-bold font-sans text-gray-900 dark:text-white">
                                {{ $account->formatted_balance }}
                            </p>
                        </div>
                    </div>

                    <!-- Status da Carteira -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 dark:text-gray-400 mr-2">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $account->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100' }}">
                                {{ $account->is_active ? 'Ativa' : 'Inativa' }}
                            </span>
                        </div>

                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Criada em {{ $account->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informações Detalhadas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Detalhes da Carteira -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Detalhes da Carteira
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Nome:</span>
                            <span class="text-sm text-gray-900 dark:text-gray-200">{{ $account->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo:</span>
                            <span class="text-sm text-gray-900 dark:text-gray-200 capitalize">{{ $account->accountType->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Saldo:</span>
                            <span class="text-sm font-semibold font-sans text-gray-900 dark:text-white">{{ $account->formatted_balance }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Status:</span>
                            <span class="text-sm {{ $account->is_active ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $account->is_active ? 'Ativa' : 'Inativa' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Saldo efetivo:</span>
                            <span class="text-sm {{ $account->is_balance_effective ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                                {{ $account->is_balance_effective ? 'Sim' : 'Não (apenas marcação)' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Ações Rápidas -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Ações Rápidas
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <a href="{{ route('accounts.edit', $account) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-plume-blue-600 hover:bg-plume-blue-700 text-white font-medium rounded-lg transition-colors duration-300 ease-in-out">
                            <i class="ti ti-edit mr-2"></i>
                            Editar Carteira
                        </a>

                        <form action="{{ route('accounts.toggle-status', $account) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($account->is_active)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @endif
                                </svg>
                                {{ $account->is_active ? 'Desativar' : 'Ativar' }} Carteira
                            </button>
                        </form>

                        <form action="{{ route('accounts.destroy', $account) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Tem certeza que deseja remover esta carteira? Esta ação não pode ser desfeita.')"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Remover Carteira
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Histórico (Placeholder para futuras funcionalidades) -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Histórico de Transações
                    </h3>
                </div>
                <div class="p-6">
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002 2"></path>
                        </svg>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                            Nenhuma transação encontrada
                        </h4>
                        <p class="text-gray-500 dark:text-gray-400">
                            As transações desta carteira aparecerão aqui quando forem registadas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

