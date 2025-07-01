<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Playfair Display', serif;">
                {{ __('Minhas Carteiras') }}
            </h2>
            <a href="{{ route('wallets.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-600 to-teal-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-teal-700 hover:to-teal-800 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nova Carteira
            </a>
        </div>
    </x-slot>

    <div class="py-12" style="background: linear-gradient(135deg, #f8f5ef 0%, #fff9f0 100%);">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resumo Financeiro -->
            <div class="mb-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-l-4 border-teal-600">
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
                                <h3 class="text-lg font-medium text-gray-900" style="font-family: 'Playfair Display', serif;">
                                    Saldo Total
                                </h3>
                                <p class="text-3xl font-bold text-teal-600" style="font-family: 'Poppins', sans-serif;">
                                    {{ number_format($totalBalance, 2, ',', '.') }}€
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Carteiras -->
            @if($wallets->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ showChart: false }">
                    @foreach($wallets as $wallet)
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300 border-l-4"
                             style="border-left-color: {{ $wallet->color }};">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white"
                                             style="background-color: {{ $wallet->color }};">
                                            <i class="ti ti-{{ $wallet->icon }}"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-lg font-medium text-gray-900" style="font-family: 'Playfair Display', serif;">
                                                {{ $wallet->name }}
                                            </h3>
                                            <p class="text-sm text-gray-500 capitalize" style="font-family: 'Poppins', sans-serif;">
                                                {{ str_replace('_', ' ', $wallet->type) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Menu de Ações -->
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open"
                                                class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                            </svg>
                                        </button>

                                        <div x-show="open"
                                             @click.away="open = false"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="transform opacity-0 scale-95"
                                             x-transition:enter-end="transform opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-75"
                                             x-transition:leave-start="transform opacity-100 scale-100"
                                             x-transition:leave-end="transform opacity-0 scale-95"
                                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                            <div class="py-1">
                                                <a href="{{ route('wallets.show', $wallet) }}"
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ver Detalhes</a>
                                                <a href="{{ route('wallets.edit', $wallet) }}"
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Editar</a>
                                                <form action="{{ route('wallets.toggle-status', $wallet) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                        {{ $wallet->is_active ? 'Desativar' : 'Ativar' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('wallets.destroy', $wallet) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Tem certeza que deseja remover esta carteira?')"
                                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                        Remover
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <p class="text-2xl font-bold" style="color: {{ $wallet->color }}; font-family: 'Poppins', sans-serif;">
                                        {{ $wallet->formatted_balance }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Gráfico de Distribuição -->
                <div class="mt-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">
                                Distribuição por Carteira
                            </h3>
                            <div class="relative">
                                <canvas id="walletChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Estado Vazio -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2" style="font-family: 'Playfair Display', serif;">
                        Nenhuma carteira encontrada
                    </h3>
                    <p class="text-gray-500 mb-6" style="font-family: 'Poppins', sans-serif;">
                        Comece criando sua primeira carteira para gerir suas finanças.
                    </p>
                    <a href="{{ route('wallets.create') }}"
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

    @if($wallets->count() > 0)
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Carregar dados das carteiras via API
                fetch('{{ route("wallets.api.data") }}')
                    .then(response => response.json())
                    .then(data => {
                        const ctx = document.getElementById('walletChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    data: data.data,
                                    backgroundColor: data.backgroundColor,
                                    borderWidth: 2,
                                    borderColor: '#ffffff'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            padding: 20,
                                            usePointStyle: true,
                                            font: {
                                                family: 'Poppins'
                                            }
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const value = context.parsed;
                                                const total = data.total;
                                                const percentage = ((value / total) * 100).toFixed(1);
                                                return context.label + ': ' + value.toFixed(2) + '€ (' + percentage + '%)';
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Erro ao carregar dados das carteiras:', error));
            </script>
        @endpush
    @endif
</x-app-layout>
