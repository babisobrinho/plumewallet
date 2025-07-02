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
                <h2 class="text-2xl font-bold text-white">Editar Categoria</h2>
            </div>
        </div>
        
        <!-- Formulário -->
        <form action="{{ route('categories.update', $category) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Nome -->
            <div class="mb-6">
                <label for="name" class="block text-plume-blue-600 font-semibold mb-2">Nome</label>
                <input type="text" name="name" id="name" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out" 
                       value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Tipo -->
            <div class="mb-6">
                <label class="block text-plume-blue-600 font-semibold mb-2">Tipo</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="type" value="expense" 
                               class="form-radio text-plume-blue-600 h-5 w-5" 
                               {{ old('type', $category->type) === 'expense' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Despesa</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="type" value="income" 
                               class="form-radio text-plume-blue-600 h-5 w-5" 
                               {{ old('type', $category->type) === 'income' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Receita</span>
                    </label>
                </div>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Cor -->
            <div class="mb-6">
                <label class="block text-plume-blue-600 font-semibold mb-2">Cor</label>
                <div class="grid grid-cols-5 gap-3">
                    @foreach($availableColors as $color)
                    <label class="flex items-center justify-center h-12 rounded-lg cursor-pointer transform transition duration-300 ease-in-out hover:scale-105 border-2 border-transparent has-[:checked]:border-plume-blue-600"
                           style="background-color: var(--color-plume-{{ str_replace('-', '-', $color) }});"
                           title="{{ $color }}">
                        <input type="radio" name="color" value="{{ $color }}" 
                               class="form-radio border-2 border-white h-5 w-5 hidden" 
                               {{ old('color', $category->color) === $color ? 'checked' : '' }}>
                    </label>
                    @endforeach
                </div>
                @error('color')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Ícone -->
            <div class="mb-6">
                <label class="block text-plume-blue-600 font-semibold mb-2">Ícone</label>
                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                    @foreach($availableIcons as $icon)
                    <label class="flex flex-col items-center p-3 border border-gray-200 rounded-lg hover:bg-plume-cream cursor-pointer transition duration-300 ease-in-out shadow-sm has-[:checked]:border-plume-blue-500">
                        <input type="radio" name="icon" value="{{ $icon }}" 
                               class="form-radio text-plume-blue-600 h-4 w-4 mb-2 hidden" 
                               {{ old('icon', $category->icon) === $icon ? 'checked' : '' }}>
                        <i class="{{ $icon }} text-3xl text-plume-blue-600"></i>
                    </label>
                    @endforeach
                </div>
                @error('icon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Botões -->
            <div class="flex justify-between border-t pt-6 mt-6">
                <button type="button" onclick="confirmDelete()" class="px-6 py-2 bg-plume-red-500 text-white rounded-lg hover:bg-plume-red-600 transition duration-300 ease-in-out flex items-center shadow-md">
                    <i class="fas fa-trash mr-2"></i>Apagar
                </button>
                
                <div class="flex space-x-4">
                    <a href="{{ route('categories.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-300 ease-in-out shadow-sm">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-plume-blue-600 text-white rounded-lg hover:bg-plume-blue-700 transition duration-300 ease-in-out flex items-center shadow-md">
                        <i class="fas fa-save mr-2"></i>Salvar
                    </button>
                </div>
            </div>
        </form>
        
        <form id="delete-form" action="{{ route('categories.destroy', $category) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Tem certeza que deseja apagar esta categoria? Esta ação não pode ser desfeita e todas as transações associadas serão removidas.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection
