@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Cabeçalho -->
        <div class="bg-plume-blue-600 px-6 py-4">
            <div class="flex items-center">
                <a href="{{ route('categories.index') }}" class="text-plume-cream hover:text-white mr-4 transition duration-300 ease-in-out">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h2 class="text-2xl font-bold text-white">Nova Categoria</h2>
            </div>
        </div>
        
        <!-- Formulário -->
        <form action="{{ route('categories.store') }}" method="POST" class="p-6">
            @csrf
            
            <!-- Nome da Categoria -->
            <div class="mb-6">
                <label for="name" class="block text-plume-blue-600 font-semibold mb-2">Nome da Categoria</label>
                <input type="text" name="name" id="name" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out" 
                       placeholder="Ex: Academia, Salário Extra" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Tipo -->
            <div class="mb-6">
                <label class="block text-plume-blue-600 font-semibold mb-2">Tipo</label>
                <div class="flex space-x-6">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="type" value="expense" id="type_expense"
                               class="form-radio text-plume-blue-600 h-5 w-5" checked>
                        <span class="ml-2 text-gray-700">Despesa</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="type" value="income" id="type_income"
                               class="form-radio text-plume-blue-600 h-5 w-5">
                        <span class="ml-2 text-gray-700">Receita</span>
                    </label>
                </div>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categorias Padrão (Sugestões) -->
            <div class="mb-8">
                <h3 class="text-plume-blue-600 font-semibold mb-3">Ou escolha uma categoria padrão:</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach($defaultCategories as $defaultCategory)
                    <label class="flex flex-col items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-plume-cream transition duration-300 ease-in-out shadow-sm has-[:checked]:border-plume-blue-500">
                        <input type="radio" name="default_category" value="{{ $defaultCategory['name'] }}" 
                               data-type="{{ $defaultCategory['type'] }}"
                               data-color="{{ $defaultCategory['color'] }}"
                               data-icon="{{ $defaultCategory['icon'] }}"
                               class="form-radio text-plume-blue-600 h-4 w-4 mb-2 hidden">
                        <i class="{{ $defaultCategory['icon'] }} text-3xl text-plume-{{ $defaultCategory['color'] }} mb-2"></i>
                        <span class="text-sm font-medium text-gray-700 text-center">{{ $defaultCategory['name'] }}</span>
                        <span class="text-xs text-gray-500">({{ $defaultCategory['type'] === 'expense' ? 'Despesa' : 'Receita' }})</span>
                    </label>
                    @endforeach
                </div>
            </div>
            
            <!-- Cor -->
            <div class="mb-6">
                <label class="block text-plume-blue-600 font-semibold mb-2">Cor</label>
                <div class="grid grid-cols-5 gap-3">
                    @foreach($availableColors as $color)
                    <label class="flex items-center justify-center h-12 rounded-lg cursor-pointer transform transition duration-300 ease-in-out hover:scale-105 border-2 border-transparent has-[:checked]:border-plume-blue-600 bg-plume-{{ $color }}" {{-- AQUI --}}
                        title="{{ $color }}">
                        <input type="radio" name="color" value="{{ $color }}" 
                               class="form-radio border-2 border-white h-5 w-5 hidden" 
                               {{ old('color') == $color ? 'checked' : ($loop->first && !old('color') ? 'checked' : '') }}>
                    </label>
                    @endforeach
                </div>
                @error('color')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Ícone -->
            <div class="mb-8">
                <label class="block text-plume-blue-600 font-semibold mb-2">Ícone</label>
                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                    @foreach($availableIcons as $icon)
                    <label class="flex flex-col items-center p-3 border border-gray-200 rounded-lg hover:bg-plume-cream cursor-pointer transition duration-300 ease-in-out shadow-sm has-[:checked]:border-plume-blue-500">
                        <input type="radio" name="icon" value="{{ $icon }}" 
                               class="form-radio text-plume-blue-600 h-4 w-4 mb-2 hidden"
                               {{ old('icon') == $icon ? 'checked' : ($loop->first && !old('icon') ? 'checked' : '') }}>
                        <i class="{{ $icon }} text-3xl text-plume-blue-600"></i>
                    </label>
                    @endforeach
                </div>
                <p class="text-sm text-gray-500 mt-3 text-center">
                    Mais ícones em <a href="https://tabler.io/icons" target="_blank" 
                    class="text-plume-blue-600 hover:underline font-medium">Tabler Icons</a>
                </p>
                @error('icon' )
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Botões -->
            <div class="flex justify-between border-t pt-6 mt-6">
                <a href="{{ route('categories.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-300 ease-in-out shadow-sm">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-plume-blue-600 text-white rounded-lg hover:bg-plume-blue-700 transition duration-300 ease-in-out flex items-center shadow-md">
                    <i class="fas fa-save mr-2"></i> Salvar Categoria
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const defaultCategoryRadios = document.querySelectorAll('input[name="default_category"]');
        const nameInput = document.getElementById('name');
        const typeExpenseRadio = document.getElementById('type_expense');
        const typeIncomeRadio = document.getElementById('type_income');
        const colorRadios = document.querySelectorAll('input[name="color"]');
        const iconRadios = document.querySelectorAll('input[name="icon"]');

        defaultCategoryRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    // Preenche o nome
                    nameInput.value = this.value;

                    // Seleciona o tipo
                    const type = this.dataset.type;
                    if (type === 'expense') {
                        typeExpenseRadio.checked = true;
                    } else {
                        typeIncomeRadio.checked = true;
                    }

                    // Seleciona a cor
                    const color = this.dataset.color;
                    colorRadios.forEach(cRadio => {
                        if (cRadio.value === color) {
                            cRadio.checked = true;
                        } else {
                            cRadio.checked = false; // Desmarca outros
                        }
                    });

                    // Seleciona o ícone
                    const icon = this.dataset.icon;
                    iconRadios.forEach(iRadio => {
                        if (iRadio.value === icon) {
                            iRadio.checked = true;
                        } else {
                            iRadio.checked = false; // Desmarca outros
                        }
                    });
                }
            });
        });

        // Função para garantir que pelo menos um rádio de cor esteja selecionado
        function ensureColorSelected() {
            let anyColorChecked = false;
            colorRadios.forEach(radio => {
                if (radio.checked) {
                    anyColorChecked = true;
                }
            });
            if (!anyColorChecked && colorRadios.length > 0) {
                colorRadios[0].checked = true; // Seleciona o primeiro se nenhum estiver
            }
        }

        // Função para garantir que pelo menos um rádio de ícone esteja selecionado
        function ensureIconSelected() {
            let anyIconChecked = false;
            iconRadios.forEach(radio => {
                if (radio.checked) {
                    anyIconChecked = true;
                }
            });
            if (!anyIconChecked && iconRadios.length > 0) {
                iconRadios[0].checked = true; // Seleciona o primeiro se nenhum estiver
            }
        }

        // Chama as funções ao carregar a página
        ensureColorSelected();
        ensureIconSelected();
    });
</script>
@endsection
