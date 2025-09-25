<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <!-- Cabeçalho -->
    <div class="flex flex-col mb-6">
        <div class="flex items-center mb-4">
            <h1 class="text-3xl font-bold text-plume-blue-600 dark:text-plume-blue-400">Histórico de Transações</h1>
        </div>
        
        <!-- Cards de Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Saldo Total -->
            <div class="bg-gradient-to-r from-plume-blue-500 to-plume-blue-600 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-plume-blue-100 text-sm font-medium">Saldo Total</p>
                        <p class="text-3xl font-bold">{{ number_format($totalBalance, 2, ',', '.') }}€</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="ti ti-wallet text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total de Transações -->
            <div class="bg-gradient-to-r from-plume-teal-500 to-plume-teal-600 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-plume-teal-100 text-sm font-medium">Total Transações</p>
                        <p class="text-3xl font-bold">{{ number_format($totalTransactions) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="ti ti-list-check text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Receitas -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Total Receitas</p>
                        <p class="text-3xl font-bold">{{ number_format($totalIncomes, 2, ',', '.') }}€</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="ti ti-trending-up text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Despesas -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Total Despesas</p>
                        <p class="text-3xl font-bold">{{ number_format($totalExpenses, 2, ',', '.') }}€</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="ti ti-trending-down text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 dark:border-green-400 text-green-700 dark:text-green-100 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-400 text-red-700 dark:text-red-100 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Histórico de Transações -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-plume-blue-600 dark:text-plume-blue-400 mb-6">Todas as Transações</h2>
        
        @if($groupedTransactions->count() > 0)
            <div class="space-y-6">
                @foreach($groupedTransactions as $date => $transactions)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                        <!-- Cabeçalho da Data -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                    <i class="ti ti-calendar mr-2"></i>{{ $date }}
                                </h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $transactions->count() }} transação(ões)
                                </span>
                            </div>
                        </div>

                        <!-- Lista de Transações -->
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($transactions as $item)
                                @php
                                    $transaction = $item['transaction'];
                                    $runningBalance = $item['running_balance'];
                                @endphp
                                <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <!-- Ícone da Categoria -->
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center
                                                @if($transaction->transaction_type === 'income') bg-green-100 dark:bg-green-900
                                                @else bg-red-100 dark:bg-red-900 @endif">
                                                @if($transaction->category)
                                                    <i class="{{ $transaction->category->icon }} text-2xl 
                                                        @if($transaction->transaction_type === 'income') text-green-600 dark:text-green-400
                                                        @else text-red-600 dark:text-red-400 @endif"></i>
                                                @else
                                                    <i class="ti ti-currency-euro text-2xl 
                                                        @if($transaction->transaction_type === 'income') text-green-600 dark:text-green-400
                                                        @else text-red-600 dark:text-red-400 @endif"></i>
                                                @endif
                                            </div>

                                            <!-- Informações da Transação -->
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-3">
                                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                                        {{ $transaction->description ?? 'Transação sem descrição' }}
                                                    </h4>
                                                    @if($transaction->category)
                                                        <span class="px-3 py-1 text-xs font-medium rounded-full
                                                            @if($transaction->transaction_type === 'income') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                            {{ $transaction->category->name }}
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="flex items-center space-x-4 mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <span>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('H:i') }}</span>
                                                    @if($transaction->account)
                                                        <span><i class="ti ti-building-bank mr-1"></i>{{ $transaction->account->name }}</span>
                                                    @endif
                                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                                        @if($transaction->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                        @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 @endif">
                                                        {{ $transaction->status === 'completed' ? 'Concluída' : 'Pendente' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Valor e Saldo Progressivo -->
                                        <div class="text-right">
                                            <div class="text-xl font-bold 
                                                @if($transaction->amount > 0) text-green-600 dark:text-green-400
                                                @else text-red-600 dark:text-red-400 @endif">
                                                @if($transaction->amount > 0)+@endif{{ number_format($transaction->amount, 2, ',', '.') }}€
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                Saldo: {{ number_format($runningBalance, 2, ',', '.') }}€
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Observações -->
                                    @if($transaction->obs)
                                        <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                <i class="ti ti-note mr-1"></i>{{ $transaction->obs }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center border border-plume-blue-100 dark:border-gray-700">
                <div class="w-24 h-24 mx-auto mb-6 bg-plume-blue-100 dark:bg-plume-blue-900 rounded-full flex items-center justify-center">
                    <i class="ti ti-history text-4xl text-plume-blue-600 dark:text-plume-blue-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-3">Nenhuma transação encontrada</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-8">Comece registrando suas primeiras transações para ver o histórico aqui.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('incomes.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out flex items-center justify-center shadow-md">
                        <i class="ti ti-plus mr-2"></i>Nova Receita
                    </a>
                    <a href="{{ route('expenses.create') }}" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out flex items-center justify-center shadow-md">
                        <i class="ti ti-plus mr-2"></i>Nova Despesa
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
</x-app-layout>
