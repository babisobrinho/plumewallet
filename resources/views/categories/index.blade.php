<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <!-- Cabeçalho -->
    <div class="flex flex-col mb-6">
        <h1 class="text-3xl font-bold text-plume-blue-600 dark:text-plume-blue-400">Minhas Finanças</h1>
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

    <!-- Container relativo para posicionar os botões -->
    <div class="relative mb-16">
        <!-- Saldo Total - Card Ampliado -->
        <div class="bg-white dark:bg-gray-800 p-10 rounded-xl shadow-lg border border-plume-blue-100 dark:border-gray-700">
            <div class="flex flex-col items-center justify-center py-6">
                <h3 class="text-2xl font-semibold text-plume-blue-600 dark:text-plume-blue-400 mb-6">Saldo Disponível</h3>
                <span class="text-5xl font-extrabold @if($balance >= 0) text-plume-teal-600 dark:text-plume-teal-400 @else text-plume-red-600 dark:text-plume-red-400 @endif">
                    € {{ number_format($balance, 2, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Botões posicionados na borda inferior do card -->
        <div class="flex flex-col sm:flex-row gap-6 justify-center -mt-6 z-10 relative">
            <a href="{{ route('categories.create') }}" class="bg-plume-blue-500 hover:bg-plume-blue-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out flex items-center justify-center shadow-md transform hover:scale-105 text-base">
                <i class="fas fa-plus mr-2"></i>Nova Categoria
            </a>
            <a href="{{ route('transactions.create') }}" class="bg-plume-teal-500 hover:bg-plume-teal-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out flex items-center justify-center shadow-md transform hover:scale-105 text-base">
                <i class="fas fa-money-bill-wave mr-2"></i>Nova Transação
            </a>
        </div>
    </div>

    <!-- Lista de Categorias -->
    <div class="mb-8 pt-6">
        <h2 class="text-2xl font-bold text-plume-blue-600 dark:text-plume-blue-400 mb-6">Minhas Categorias</h2>
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
                                        <a href="{{ route('categories.transactions', $category) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out text-xl">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        {{-- Botão de edição inteligente --}}
                                        @if($category->transactions_count > 0)
                                            @if(isset($item['transaction']))
                                                <a href="{{ route('transactions.edit', $item['transaction']) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out text-xl">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('transactions.edit', $category->transactions()->latest()->first()) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out text-xl">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('categories.edit', $category) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out text-xl">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                        
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta categoria? Todas as transações associadas também serão removidas.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-plume-red-500 hover:text-plume-red-700 dark:hover:text-plume-red-300 transition duration-300 ease-in-out text-xl">
                                                <i class="fas fa-trash"></i>
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
                <i class="fas fa-folder-open text-5xl text-plume-blue-500 dark:text-plume-blue-400 mb-4"></i>
                <h3 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-3">Nenhuma categoria criada ainda</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Comece criando sua primeira categoria para organizar suas finanças.</p>
                <a href="{{ route('categories.create') }}" class="inline-block bg-plume-blue-500 hover:bg-plume-blue-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out shadow-md text-base">
                    <i class="fas fa-plus mr-2"></i>Criar Categoria
                </a>
            </div>
        @endif
    </div>
</div>
</x-app-layout>