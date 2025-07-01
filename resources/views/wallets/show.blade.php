<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('wallets.index') }}"
                   class="mr-4 text-gray-500 hover:text-gray-700 transition-colors duration-150">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Playfair Display', serif;">
                    {{ $wallet->name }}
                </h2>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('wallets.edit', $wallet) }}"
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12" style="background: linear-gradient(135deg, #f8f5ef 0%, #fff9f0 100%);">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Cartão Principal da Carteira -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center text-white mr-6"
                                 style="background-color: {{ $wallet->color }};">
                                <i class="ti ti-{{ $wallet->icon }} text-3xl"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2" style="font-family: 'Playfair Display', serif;">
                                    {{ $wallet->name }}
                                </h1>
                                <p class="text-lg text-gray-600 capitalize" style="font-family: 'Poppins', sans-serif;">
                                    {{ str_replace('_', ' ', $wallet->type) }}
                                </p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-sm text-gray-500 mb-1" style="font-family: 'Poppins', sans-serif;">
                                Saldo Atual
                            </p>
                            <p class="text-4xl font-bold" style="color: {{ $wallet->color }}; font-family: 'Poppins', sans-serif;">
                                {{ $wallet->formatted_balance }}
                            </p>
                        </div>
                    </div>

                    <!-- Status da Carteira -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 mr-2" style="font-family: 'Poppins', sans-serif;">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $wallet->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $wallet->is_active ? 'Ativa' : 'Inativa' }}
                            </span>
                        </div>

                        <div class="text-sm text-gray-500" style="font-family: 'Poppins', sans-serif;">
                            Criada em {{ $wallet->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informações Detalhadas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Detalhes da Carteira -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900" style="font-family: 'Playfair Display', serif;">
                            Detalhes da Carteira
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500" style="font-family: 'Poppins', sans-serif;">Nome:</span>
                            <span class="text-sm text-gray-900" style="font-family: 'Poppins', sans-serif;">{{ $wallet->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500" style="font-family: 'Poppins', sans-serif;">Tipo:</span>
                            <span class="text-sm text-gray-900 capitalize" style="font-family: 'Poppins', sans-serif;">{{ str_replace('_', ' ', $wallet->type) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500" style="font-family: 'Poppins', sans-serif;">Saldo:</span>
                            <span class="text-sm font-semibold" style="color: {{ $wallet->color }}; font-family: 'Poppins', sans-serif;">{{ $wallet->formatted_balance }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500" style="font-family: 'Poppins', sans-serif;">Cor:</span>
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full border border-gray-300 mr-2" style="background-color: {{ $wallet->color }};"></div>
                                <span class="text-sm text-gray-900 uppercase" style="font-family: 'Poppins', sans-serif;">{{ $wallet->color }}</span>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500" style="font-family: 'Poppins', sans-serif;">Status:</span>
                            <span class="text-sm {{ $wallet->is_active ? 'text-green-600' : 'text-red-600' }}" style="font-family: 'Poppins', sans-serif;">
                                {{ $wallet->is_active ? 'Ativa' : 'Inativa' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Ações Rápidas -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900" style="font-family: 'Playfair Display', serif;">
                            Ações Rápidas
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <a href="{{ route('wallets.edit', $wallet) }}"
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-teal-600 to-teal-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-teal-700 hover:to-teal-800 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Editar Carteira
                        </a>

                        <form action="{{ route('wallets.toggle-status', $wallet) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($wallet->is_active)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @endif
                                </svg>
                                {{ $wallet->is_active ? 'Desativar' : 'Ativar' }} Carteira
                            </button>
                        </form>

                        <form action="{{ route('wallets.destroy', $wallet) }}" method="POST">
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
            <div class="mt-8 bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900" style="font-family: 'Playfair Display', serif;">
                        Histórico de Transações
                    </h3>
                </div>
                <div class="p-6">
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002 2"></path>
                        </svg>
                        <h4 class="text-lg font-medium text-gray-900 mb-2" style="font-family: 'Playfair Display', serif;">
                            Nenhuma transação encontrada
                        </h4>
                        <p class="text-gray-500" style="font-family: 'Poppins', sans-serif;">
                            As transações desta carteira aparecerão aqui quando forem registadas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
