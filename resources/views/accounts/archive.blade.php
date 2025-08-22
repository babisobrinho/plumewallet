<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Contas Arquivadas
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Faça a gestão das suas contas desativadas</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('accounts.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-gray-700 hover:to-gray-800 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Alerta Informativo -->
        <div class="bg-orange-50 dark:bg-orange-900/20 border-l-4 border-orange-500 rounded-lg p-4 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-orange-800 dark:text-orange-200">Contas Arquivadas</h3>
                    <div class="mt-2 text-sm text-orange-700 dark:text-orange-300">
                        <p>Estas contas foram desativadas e não são incluídas no saldo total. Pode reativá-las a qualquer momento.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Contas -->
        @if($accounts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($accounts as $account)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow duration-300">
                        <div class="p-6 relative">
                            <!-- Badge de Status -->
                            <span class="absolute top-4 right-4 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                Desativada
                            </span>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full flex items-center justify-center text-white opacity-75" style="background-color: {{ $account->color }};">
                                        <i class="ti ti-{{ $account->icon }} text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $account->name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $account->accountType->name }}</p>
                                    
                                    @if(!$account->is_balance_effective)
                                        <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                                            Apenas marcação
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <p class="text-2xl font-bold" style="color: {{ $account->color }};">{{ $account->formatted_balance }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Desativada em {{ $account->updated_at->format('d/m/Y') }}</p>
                            </div>
                            
                            <!-- Menu de Ações -->
                            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-end space-x-2">
                                <a href="{{ route('accounts.show', $account) }}" class="inline-flex items-center px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Ver
                                </a>
                                
                                <form action="{{ route('accounts.toggle-status', $account) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Reativar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Estado Vazio -->
            <div class="text-center py-12">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 dark:bg-gray-700">
                    <i class="ti ti-archive text-3xl"></i>
                </div>
                <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Nenhuma conta desativada</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Todas as suas contas estão ativas no momento.</p>
                <div class="mt-6">
                    <a href="{{ route('accounts.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Voltar às contas ativas
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>