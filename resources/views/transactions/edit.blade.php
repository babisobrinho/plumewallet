@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Cabeçalho -->
        <div class="bg-plume-blue-600 px-6 py-4">
            <div class="flex items-center">
                <a href="{{ route('categories.index') }}" class="text-white hover:text-plume-cream mr-4 transition duration-300 ease-in-out">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h2 class="text-2xl font-bold text-white">Editar Transação</h2>
            </div>
        </div>
        
        <!-- Formulário -->
        <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Valor -->
                <div>
                    <label for="amount" class="block text-plume-blue-600 font-semibold mb-2">Valor</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-bold">R$</span>
                        <input type="number" name="amount" id="amount" step="0.01" min="0.01"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out" 
                               value="{{ old('amount', abs($transaction->amount)) }}" required>
                    </div>
                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Tipo -->
                <div>
                    <label class="block text-plume-blue-600 font-semibold mb-2">Tipo</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="type" value="expense" 
                                   class="form-radio text-plume-blue-600 h-5 w-5" {{ old('type', $transaction->amount < 0 ? 'expense' : 'income') == 'expense' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Despesa</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="type" value="income" 
                                   class="form-radio text-plume-blue-600 h-5 w-5" {{ old('type', $transaction->amount < 0 ? 'expense' : 'income') == 'income' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Receita</span>
                        </label>
                    </div>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Categoria -->
                <div>
                    <label for="category_id" class="block text-plume-blue-600 font-semibold mb-2">Categoria</label>
                    <select name="category_id" id="category_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out" required>
                        <option value="">Selecione uma categoria</option>
                        @foreach($userCategories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->type === 'expense' ? 'Despesa' : 'Receita' }})
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Data -->
                <div>
                    <label for="date" class="block text-plume-blue-600 font-semibold mb-2">Data</label>
                    <input type="date" name="date" id="date" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out" 
                           value="{{ old('date', $transaction->date) }}" required>
                    @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-plume-blue-600 font-semibold mb-2">Descrição (Opcional)</label>
                    <input type="text" name="description" id="description" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out" 
                           placeholder="Ex: Supermercado" value="{{ old('description', $transaction->description) }}">
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Botões -->
            <div class="flex justify-between border-t pt-6 mt-6">
                <button type="button" onclick="confirmDelete()" class="px-6 py-2 bg-plume-red-500 text-white rounded-lg hover:bg-plume-red-600 transition duration-300 ease-in-out flex items-center shadow-md">
                    <i class="fas fa-trash mr-2"></i>Apagar
                </button>
                
                <div class="flex space-x-4">
                    <a href="{{ route('categories.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-300 ease-in-out shadow-sm">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-plume-blue-600 text-white rounded-lg hover:bg-plume-blue-700 transition duration-300 ease-in-out flex items-center shadow-md">
                        <i class="fas fa-save mr-2"></i>Salvar
                    </button>
                </div>
            </div>
        </form>
        
        <form id="delete-form" action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Tem certeza que deseja apagar esta transação? Esta ação não pode ser desfeita.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection
