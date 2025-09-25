<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Minhas Finanças') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="ti ti-plus mr-1"></i>Nova Categoria
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
                                    <i class="ti ti-wallet text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Saldo Total (Efetivo)
                                </h3>
                                <p class="text-3xl font-bold text-teal-600 dark:text-teal-400">
                                    {{ number_format($balance, 2, ',', '.') }}€
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Exclui valores marcados como "apenas marcação"
                                </p>
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

            <!-- Lista de Categorias -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Minhas Categorias</h2>
        @if($groupedCategories->count() > 0)
            <div class="space-y-8">
                @foreach($groupedCategories as $date => $categoryItems)
                    <div class="space-y-4">
                        @php
                            $dateObj = \Carbon\Carbon::createFromFormat('d M, Y', $date);
                        @endphp
                        <p class="font-semibold text-black dark:text-gray-400">{{ $dateObj->translatedFormat('d F, Y') }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($categoryItems as $item)
                                @php $category = $item['category']; @endphp
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-plume-{{ $category->color }} dark:border-plume-{{ $category->color }}">
                                    <div class="flex items-center mb-4">
                                        <!-- Ícone com fundo colorido -->
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center bg-plume-{{ $category->color }} mr-4">
                                            <i class="{{ $category->icon }} text-2xl text-white dark:text-gray-900"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-lg">{{ $category->name }}</h3>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $category->type === 'expense' ? 'Despesa' : 'Receita' }}
                                                @if($item['is_creation'])
                                                    (Criada)
                                                @else
                                                    (Transação)
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            @if(!$item['is_creation'] && $item['transaction_amount'])
                                                <span class="text-lg font-bold @if($item['transaction_amount'] < 0) text-plume-red-500 dark:text-plume-red-400 @else text-plume-teal-500 dark:text-plume-teal-400 @endif">
                                                    € {{ number_format(abs($item['transaction_amount']), 2, ',', '.') }}
                                                </span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    @if($category->transactions_sum_amount)
                                                        Total: € {{ number_format($category->transactions_sum_amount, 2, ',', '.') }}
                                                    @endif
                                                </span>
                                            @else
                                                <span class="text-lg font-bold @if($category->transactions_sum_amount < 0) text-plume-red-500 dark:text-plume-red-400 @else text-plume-teal-500 dark:text-plume-teal-400 @endif">
                                                    € {{ number_format($category->transactions_sum_amount, 2, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex justify-end mt-4 space-x-4 border-t pt-4 border-gray-200 dark:border-gray-700">
                                        <a href="{{ route('categories.transactions', $category) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out text-xl" title="Ver transações">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        
                                        {{-- Botão de edição inteligente --}}
                                        @if($category->transactions_count > 0)
                                            @php
                                                $latestTransaction = $category->transactions()->latest()->first();
                                            @endphp
                                            @if($category->type === 'expense')
                                                <a href="{{ route('expenses.edit', $latestTransaction) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out text-xl" title="Editar despesa">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('incomes.edit', $latestTransaction) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out text-xl" title="Editar receita">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('categories.edit', $category) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out text-xl" title="Editar categoria">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        @endif
                                        
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta categoria? Todas as transações associadas também serão removidas.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-plume-red-500 hover:text-plume-red-700 dark:hover:text-plume-red-300 transition duration-300 ease-in-out text-xl" title="Apagar categoria">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center border border-plume-blue-100 dark:border-gray-700">
                <i class="ti ti-folder text-5xl text-plume-blue-500 dark:text-plume-blue-400 mb-4"></i>
                <h3 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-3">Nenhuma categoria criada ainda</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Comece criando sua primeira categoria para organizar suas finanças.</p>
                <a href="{{ route('categories.create') }}" class="inline-block bg-plume-blue-500 hover:bg-plume-blue-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out shadow-md text-base">
                    <i class="ti ti-plus mr-2"></i>Criar Categoria
                </a>
            </div>
        @endif
            </div>
        </div>
    </div>
</x-app-layout>