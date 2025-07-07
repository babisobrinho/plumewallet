@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-plume-blue-600">Minhas Finanças</h1>
        <div class="flex flex-col sm:flex-row gap-4 mt-4 md:mt-0">
            <a href="{{ route('categories.create') }}" class="bg-plume-blue-500 hover:bg-plume-blue-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out flex items-center justify-center shadow-md">
                <i class="fas fa-plus mr-2"></i>Nova Categoria
            </a>
            <a href="{{ route('transactions.create') }}" class="bg-plume-teal-500 hover:bg-plume-teal-600 text-white px-6 py-3 rounded-lg transition duration-300 ease-in-out flex items-center justify-center shadow-md">
                <i class="fas fa-money-bill-wave mr-2"></i>Nova Transação
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Saldo Total -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8 border border-plume-blue-100">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h3 class="text-lg font-semibold text-plume-blue-600 mb-2 sm:mb-0">Saldo Disponível</h3>
            <span class="text-3xl font-extrabold @if($balance >= 0) text-plume-teal-600 @else text-plume-red-600 @endif">
                R$ {{ number_format($balance, 2, ',', '.') }}
            </span>
        </div>
    </div>

    <!-- Categorias do Usuário Agrupadas por Data -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-plume-blue-600 mb-6">Minhas Categorias</h2>
        @if($groupedCategories->count() > 0)
            <div class="space-y-8">
                {{-- Loop através de cada grupo (data) --}}
                @foreach($groupedCategories as $date => $categories)
                    <div class="space-y-4">
                        {{-- Cabeçalho da Data --}}
                        <p class="font-semibold text-gray-500">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F, Y') }}</p>
                        
                        {{-- A "caixa invisível" (grid) para as categorias daquela data --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {{-- Loop através das categorias dentro do grupo --}}
                            @foreach($categories as $category)
                                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-plume-{{ $category->color }}">
                                    <div class="flex items-center mb-4">
                                        <span class="text-plume-{{ $category->color }} mr-4 text-3xl">
                                            <i class="{{ $category->icon }}"></i>
                                        </span>
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-800 text-lg">{{ $category->name }}</h3>
                                            <span class="text-sm text-gray-500">{{ $category->type === 'expense' ? 'Despesa' : 'Receita' }}</span>
                                        </div>
                                        <span class="text-lg font-bold @if($category->type === 'expense') text-plume-red-500 @else text-plume-teal-500 @endif">
                                            R$ {{ number_format($category->transactions_sum_amount ?? 0, 2, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-end mt-4 space-x-4 border-t pt-4">
                                        {{-- NOVO: Link para ver todas as transações da categoria --}}
                                        <a href="{{ route('categories.transactions', $category) }}" class="text-plume-blue-500 hover:text-plume-blue-700 transition duration-300 ease-in-out text-xl" title="Ver Transações">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($category->transactions_count > 0 && $category->transactions->first())
                                            <a href="{{ route('transactions.edit', $category->transactions->first()) }}" class="text-plume-blue-500 hover:text-plume-blue-700 transition duration-300 ease-in-out text-xl" title="Editar Última Transação">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('categories.edit', $category) }}" class="text-plume-blue-500 hover:text-plume-blue-700 transition duration-300 ease-in-out text-xl" title="Editar Categoria">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta categoria? Todas as transações associadas também serão removidas.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-plume-red-500 hover:text-plume-red-700 transition duration-300 ease-in-out text-xl" title="Apagar">
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
            <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-plume-blue-100">
                <i class="fas fa-folder-open text-5xl text-plume-blue-500 mb-4"></i>
                <h3 class="text-2xl font-semibold text-gray-700 mb-3">Nenhuma categoria criada ainda</h3>
                <p class="text-gray-500 mb-6">Comece criando sua primeira categoria para organizar suas finanças.</p>
                <a href="{{ route('categories.create') }}" class="inline-block bg-plume-blue-500 hover:bg-plume-blue-600 text-white px-8 py-3 rounded-lg transition duration-300 ease-in-out shadow-md">
                    <i class="fas fa-plus mr-2"></i>Criar Categoria
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
