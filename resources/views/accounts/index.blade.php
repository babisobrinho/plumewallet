<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Minhas Carteiras') }}
            </h2>
            <a href="{{ route('accounts.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-600 to-teal-700 border border-transparent rounded-md font-semibold
                text-xs text-white uppercase tracking-widest hover:from-teal-700 hover:to-teal-800 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nova Carteira
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resumo Financeiro -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border-l-4 border-teal-600">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-teal-600 to-teal-700 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Saldo Total (Efetivo)
                                </h3>
                                <p class="text-3xl font-bold text-teal-600 dark:text-teal-400">
                                    {{ number_format($totalBalance, 2, ',', '.') }}€
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Exclui valores marcados como "apenas marcação"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Carteiras -->
            @if($accounts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ showChart: false }">
                    @foreach($accounts as $account)
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300 border-l-4 relative"
                             style="border-left-color: {{ $account->color }};">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white {{ $account->color }}">
                                            <i class="ti ti-{{ $account->icon }}"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ $account->name }}
                                            </h3>
                                            @if(!$account->is_balance_effective)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100 mt-1">
                                Apenas marcação
                            </span>
                                            @endif
                                            <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">
                                                {{ $account->accountType->name }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Menu de Ações -->
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open"
                                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none focus:text-gray-600 dark:focus:text-gray-300">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                            </svg>
                                        </button>

                                        <!-- Dropdown Menu -->
                                        <div x-show="open"
                                             @click.away="open = false"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="transform opacity-0 scale-95"
                                             x-transition:enter-end="transform opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-75"
                                             x-transition:leave-start="transform opacity-100 scale-100"
                                             x-transition:leave-end="transform opacity-0 scale-95"
                                             style="display: none;"
                                             class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-[9999]">
                                            <div class="py-1 max-h-80 overflow-y-auto" role="menu" aria-orientation="vertical">
                                                <a href="{{ route('accounts.show', $account) }}"
                                                   class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100"
                                                   role="menuitem">
                                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    Ver Detalhes
                                                </a>
                                                <a href="{{ route('accounts.edit', $account) }}"
                                                   class="group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100"
                                                   role="menuitem">
                                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Editar
                                                </a>
                                                <form action="{{ route('accounts.toggle-balance-effective', $account) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="group flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100"
                                                            role="menuitem">
                                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ $account->is_balance_effective ? 'Marcar como não efetivo' : 'Marcar como efetivo' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('accounts.toggle-status', $account) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="group flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100"
                                                            role="menuitem">
                                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $account->is_active ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636' : 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' }}"></path>
                                                        </svg>
                                                        {{ $account->is_active ? 'Desativar' : 'Ativar' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('accounts.destroy', $account) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Tem certeza que deseja remover esta carteira?')"
                                                            class="group flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900 hover:text-red-900 dark:hover:text-red-100"
                                                            role="menuitem">
                                                        <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500 dark:group-hover:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Remover
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <p class="text-2xl font-bold" style="color: {{ $account->color }};">
                                        {{ $account->formatted_balance }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Estado Vazio -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                        Nenhuma carteira encontrada
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        Comece criando sua primeira carteira para gerir suas finanças.
                    </p>
                    <a href="{{ route('accounts.create') }}"
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-teal-700 hover:to-teal-800 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Criar Primeira Carteira
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
