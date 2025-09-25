<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div class="flex items-center">
            <a href="{{ route('categories.index') }}" class="text-plume-blue-600 hover:text-plume-blue-700 dark:text-plume-blue-400 dark:hover:text-plume-blue-300 mr-4 transition duration-300 ease-in-out">
                <i class="ti ti-arrow-left text-2xl"></i>
            </a>
            <h1 class="text-3xl font-bold text-plume-blue-600 dark:text-white">Transações de {{ $category->name }}</h1>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 mt-4 md:mt-0">
            @if($category->type === 'expense')
                <a href="{{ route('expenses.create') }}" class="bg-plume-red-500 hover:bg-plume-red-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out flex items-center justify-center shadow-md">
                    <i class="ti ti-plus mr-2"></i>Nova Despesa
                </a>
            @else
                <a href="{{ route('incomes.create') }}" class="bg-plume-teal-500 hover:bg-plume-teal-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out flex items-center justify-center shadow-md">
                    <i class="ti ti-plus mr-2"></i>Nova Receita
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md dark:bg-green-900 dark:border-green-700 dark:text-green-200" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md dark:bg-red-900 dark:border-red-700 dark:text-red-200" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Lista de Transações -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-plume-blue-600 dark:text-white mb-6">Transações da Categoria "{{ $category->name }}"</h2>
        @if($transactions->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Data
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Descrição
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Valor
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach($transactions as $transaction)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $transaction->description ?? 'Sem descrição' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            @if($transaction->category)
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                  style="background-color: var(--color-plume-{{ str_replace('-', '-', $transaction->category->color) }}); color: white;">
                                {{ $transaction->category->name }}
                            </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200">
                                    Sem Categoria
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium @if($transaction->amount < 0) text-plume-red-500 @else text-plume-teal-500 @endif dark:text-white">
                            R$ {{ number_format(abs($transaction->amount), 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('transactions.edit', $transaction) }}" class="text-plume-blue-500 hover:text-plume-blue-700 dark:text-plume-blue-400 dark:hover:text-plume-blue-300 transition duration-300 ease-in-out mr-3" title="Editar">
                                <i class="ti ti-edit"></i>
                            </a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja apagar esta transação?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-plume-red-500 hover:text-plume-red-700 dark:text-plume-red-400 dark:hover:text-plume-red-300 transition duration-300 ease-in-out" title="Apagar">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 text-center border border-plume-blue-100 dark:border-gray-700">
            <i class="ti ti-exchange text-5xl text-plume-blue-500 mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-700 dark:text-white mb-3">Nenhuma transação encontrada para esta categoria</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Crie uma nova transação e associe-a a esta categoria.</p>
            @if($category->type === 'expense')
                <a href="{{ route('expenses.create') }}" class="inline-block bg-plume-red-500 hover:bg-plume-red-600 text-white px-8 py-3 rounded-lg transition duration-300 ease-in-out shadow-md">
                    <i class="ti ti-plus mr-2"></i>Registrar Despesa
                </a>
            @else
                <a href="{{ route('incomes.create') }}" class="inline-block bg-plume-teal-500 hover:bg-plume-teal-600 text-white px-8 py-3 rounded-lg transition duration-300 ease-in-out shadow-md">
                    <i class="ti ti-plus mr-2"></i>Registrar Receita
                </a>
            @endif
        </div>
        @endif
    </div>
</div>
</x-app-layout>