@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Cabeçalho -->
        <div class="bg-plume-blue-600 px-6 py-4">
            <div class="flex items-center">
                <a href="{{ route('categories.index') }}" class="text-plume-cream hover:text-white mr-4 transition duration-300 ease-in-out">
                    <i class="ti ti-arrow-left text-xl"></i>
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
                               class="form-radio text-plume-blue-600 h-5 w-5" {{ old('type', 'expense') === 'expense' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Despesa</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="type" value="income" id="type_income"
                               class="form-radio text-plume-blue-600 h-5 w-5" {{ old('type') === 'income' ? 'checked' : '' }}>
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
                
                <!-- Cores Principais com Legendas -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex space-x-4">
                        <div class="flex items-center space-x-1">
                            <div class="w-4 h-4 bg-plume-teal-500 rounded-full"></div>
                            <span class="text-gray-600 text-xs">Teal</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-4 h-4 bg-plume-violet-500 rounded-full"></div>
                            <span class="text-gray-600 text-xs">Violet</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-4 h-4 bg-plume-lime-500 rounded-full"></div>
                            <span class="text-gray-600 text-xs">Lime</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-4 h-4 bg-plume-orange-500 rounded-full"></div>
                            <span class="text-gray-600 text-xs">Orange</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-4 h-4 bg-plume-red-500 rounded-full"></div>
                            <span class="text-gray-600 text-xs">Red</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-4 h-4 bg-plume-cyan-500 rounded-full"></div>
                            <span class="text-gray-600 text-xs">Cyan</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="w-4 h-4 bg-plume-purple-500 rounded-full"></div>
                            <span class="text-gray-600 text-xs">Purple</span>
                        </div>
                    </div>
                </div>
                
                <!-- Cores 500 -->
                <div class="mb-4">
                    <h4 class="text-gray-700 text-sm font-medium mb-2">Cores 500</h4>
                    <div class="grid grid-cols-7 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="teal-500" class="sr-only" {{ old('color') == 'teal-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-teal-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="violet-500" class="sr-only" {{ old('color') == 'violet-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-violet-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="lime-500" class="sr-only" {{ old('color') == 'lime-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-lime-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="orange-500" class="sr-only" {{ old('color') == 'orange-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-orange-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="red-500" class="sr-only" {{ old('color') == 'red-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-red-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="cyan-500" class="sr-only" {{ old('color') == 'cyan-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-cyan-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="purple-500" class="sr-only" {{ old('color') == 'purple-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-purple-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                    </div>
                </div>

                <!-- Cores 400 -->
                <div class="mb-4">
                    <h4 class="text-gray-700 text-sm font-medium mb-2">Cores 400</h4>
                    <div class="grid grid-cols-7 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="teal-400" class="sr-only" {{ old('color') == 'teal-400' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-teal-400 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="violet-400" class="sr-only" {{ old('color') == 'violet-400' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-violet-400 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="lime-400" class="sr-only" {{ old('color') == 'lime-400' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-lime-400 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="orange-400" class="sr-only" {{ old('color') == 'orange-400' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-orange-400 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="red-400" class="sr-only" {{ old('color') == 'red-400' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-red-400 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="cyan-400" class="sr-only" {{ old('color') == 'cyan-400' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-cyan-400 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="purple-400" class="sr-only" {{ old('color') == 'purple-400' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-purple-400 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                    </div>
                </div>

                <!-- Cores 300 -->
                <div class="mb-4">
                    <h4 class="text-gray-700 text-sm font-medium mb-2">Cores 300</h4>
                    <div class="grid grid-cols-7 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="teal-300" class="sr-only" {{ old('color') == 'teal-300' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-teal-300 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="violet-300" class="sr-only" {{ old('color') == 'violet-300' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-violet-300 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="lime-300" class="sr-only" {{ old('color') == 'lime-300' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-lime-300 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="orange-300" class="sr-only" {{ old('color') == 'orange-300' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-orange-300 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="red-300" class="sr-only" {{ old('color') == 'red-300' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-red-300 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="cyan-300" class="sr-only" {{ old('color') == 'cyan-300' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-cyan-300 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="purple-300" class="sr-only" {{ old('color') == 'purple-300' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-purple-300 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                    </div>
                </div>

                <!-- Cores Neutras -->
                <div class="mb-4">
                    <h4 class="text-gray-700 text-sm font-medium mb-2">Cores Neutras</h4>
                    <div class="grid grid-cols-7 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="white" class="sr-only" {{ old('color') == 'white' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-white rounded-full border-2 border-gray-300 hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="gray-200" class="sr-only" {{ old('color') == 'gray-200' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-gray-200 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="gray-300" class="sr-only" {{ old('color') == 'gray-300' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-gray-300 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="gray-400" class="sr-only" {{ old('color') == 'gray-400' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-gray-400 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="gray-500" class="sr-only" {{ old('color') == 'gray-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-gray-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="gray-600" class="sr-only" {{ old('color') == 'gray-600' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-gray-600 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="gray-700" class="sr-only" {{ old('color') == 'gray-700' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-gray-700 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                    </div>
                </div>

                <!-- Especiais -->
                <div class="mb-6">
                    <h4 class="text-gray-700 text-sm font-medium mb-2">Especiais</h4>
                    <div class="grid grid-cols-4 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="black" class="sr-only" {{ old('color') == 'black' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-black rounded-full border-2 border-gray-300 hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="blue-500" class="sr-only" {{ old('color') == 'blue-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-blue-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="green-500" class="sr-only" {{ old('color') == 'green-500' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-green-500 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="teal-600" class="sr-only" {{ old('color') == 'teal-600' ? 'checked' : '' }}>
                            <div class="w-8 h-8 bg-plume-teal-600 rounded-full border-2 border-transparent hover:border-plume-blue-500 transition-colors duration-200 color-option"></div>
                        </label>
                    </div>
                </div>

                @error('color')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Ícone -->
            <div class="mb-8">
                <label class="block text-plume-blue-600 font-semibold mb-2">Ícone</label>
                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3" id="icons-container">
                    @foreach($expenseIcons as $icon)
                    <label class="flex flex-col items-center p-3 border border-gray-200 rounded-lg hover:bg-plume-cream cursor-pointer transition duration-300 ease-in-out shadow-sm icon-option">
                        <input type="radio" name="icon" value="{{ $icon }}" 
                            class="form-radio text-plume-blue-600 h-4 w-4 mb-2 hidden"
                            {{ (old('icon') == $icon) || ($loop->first && !old('icon')) ? 'checked' : '' }}>
                        <i class="{{ $icon }} text-3xl text-plume-blue-600"></i>
                    </label>
                    @endforeach
                </div>
                <p class="text-sm text-gray-500 mt-3 text-center">
                    Mais ícones em <a href="https://tabler.io/icons" target="_blank" 
                    class="text-plume-blue-600 hover:underline font-medium">Tabler Icons</a>
                </p>
                @error('icon')
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
                    <i class="ti ti-device-floppy mr-2"></i> Salvar Categoria
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorRadios = document.querySelectorAll('input[name="color"]');
        const iconRadios = document.querySelectorAll('input[name="icon"]');
        const typeRadios = document.querySelectorAll('input[name="type"]');
        const iconsContainer = document.getElementById('icons-container');
        
        // Ícones por tipo
        const iconsByType = {
            'expense': @json($expenseIcons),
            'income': @json($incomeIcons)
        };

        // Mapeamento de cores para classes CSS
        const colorMap = {
            'teal-500': 'text-plume-teal-500',
            'violet-500': 'text-plume-violet-500',
            'lime-500': 'text-plume-lime-500',
            'orange-500': 'text-plume-orange-500',
            'red-500': 'text-plume-red-500',
            'cyan-500': 'text-plume-cyan-500',
            'purple-500': 'text-plume-purple-500',
            'teal-400': 'text-plume-teal-400',
            'violet-400': 'text-plume-violet-400',
            'lime-400': 'text-plume-lime-400',
            'orange-400': 'text-plume-orange-400',
            'red-400': 'text-plume-red-400',
            'cyan-400': 'text-plume-cyan-400',
            'purple-400': 'text-plume-purple-400',
            'teal-300': 'text-plume-teal-300',
            'violet-300': 'text-plume-violet-300',
            'lime-300': 'text-plume-lime-300',
            'orange-300': 'text-plume-orange-300',
            'red-300': 'text-plume-red-300',
            'cyan-300': 'text-plume-cyan-300',
            'purple-300': 'text-plume-purple-300',
            'white': 'text-white',
            'gray-200': 'text-plume-gray-200',
            'gray-300': 'text-plume-gray-300',
            'gray-400': 'text-plume-gray-400',
            'gray-500': 'text-plume-gray-500',
            'gray-600': 'text-plume-gray-600',
            'gray-700': 'text-plume-gray-700',
            'black': 'text-black',
            'blue-500': 'text-plume-blue-500',
            'green-500': 'text-plume-green-500',
            'teal-600': 'text-plume-teal-600',
            // Cores antigas para compatibilidade
            'blue-600': 'text-plume-blue-600',
            'red-600': 'text-plume-red-600',
            'purple': 'text-plume-purple-500',
            'cyan': 'text-plume-cyan-500',
            'yellow-500': 'text-plume-yellow-500'
        };

        // Função para aplicar cor aos ícones
        function applyColorToIcons(selectedColor) {
            const iconElements = document.querySelectorAll('.icon-option i');
            const colorClass = colorMap[selectedColor] || 'text-plume-blue-600';
            
            iconElements.forEach(icon => {
                // Remove todas as classes de cor
                Object.values(colorMap).forEach(colorCls => {
                    icon.classList.remove(colorCls);
                });
                // Remove cor padrão
                icon.classList.remove('text-plume-blue-600');
                // Adiciona a nova cor
                icon.classList.add(colorClass);
            });
        }

        // Função para atualizar os ícones com base no tipo selecionado
        function updateIconsByType(type) {
            const icons = iconsByType[type];
            const currentSelectedIcon = document.querySelector('input[name="icon"]:checked')?.value;
            iconsContainer.innerHTML = '';
            
            icons.forEach(icon => {
                const isChecked = icon === currentSelectedIcon || 
                                 (icon === @json($expenseIcons[0]) && !currentSelectedIcon && type === 'expense') ||
                                 (icon === @json($incomeIcons[0]) && !currentSelectedIcon && type === 'income');
                
                const label = document.createElement('label');
                label.className = 'flex flex-col items-center p-3 border border-gray-200 rounded-lg hover:bg-plume-cream cursor-pointer transition duration-300 ease-in-out shadow-sm icon-option';
                if (isChecked) {
                    label.classList.add('border-plume-blue-500', 'bg-plume-blue-50');
                }
                
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'icon';
                input.value = icon;
                input.className = 'form-radio text-plume-blue-600 h-4 w-4 mb-2 hidden';
                if (isChecked) {
                    input.checked = true;
                }
                
                const iconElement = document.createElement('i');
                iconElement.className = `${icon} text-3xl text-plume-blue-600`;
                
                label.appendChild(input);
                label.appendChild(iconElement);
                iconsContainer.appendChild(label);
                
                // Adiciona evento de change para o novo input
                input.addEventListener('change', function() {
                    document.querySelectorAll('.icon-option').forEach(option => {
                        option.classList.remove('border-plume-blue-500', 'bg-plume-blue-50');
                    });
                    
                    if (this.checked) {
                        label.classList.add('border-plume-blue-500', 'bg-plume-blue-50');
                    }
                });
            });
            
            // Aplica a cor selecionada aos novos ícones
            const selectedColor = document.querySelector('input[name="color"]:checked')?.value;
            if (selectedColor) {
                applyColorToIcons(selectedColor);
            }
        }

        // Adiciona evento para mudar os ícones quando o tipo muda
        typeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                updateIconsByType(this.value);
            });
        });

        // Adicionar efeito visual para seleção de cores
        colorRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove seleção visual de todos
                document.querySelectorAll('.color-option').forEach(option => {
                    option.classList.remove('ring-2', 'ring-plume-blue-500', 'border-plume-blue-600');
                });
                
                // Adiciona seleção visual ao selecionado
                if (this.checked) {
                    const div = this.nextElementSibling;
                    div.classList.add('ring-2', 'ring-plume-blue-500', 'border-plume-blue-600');
                    
                    // Aplica a cor aos ícones
                    applyColorToIcons(this.value);
                }
            });
        });

        // Aplicar seleção visual inicial para cores
        const checkedColorRadio = document.querySelector('input[name="color"]:checked');
        if (checkedColorRadio) {
            const div = checkedColorRadio.nextElementSibling;
            div.classList.add('ring-2', 'ring-plume-blue-500', 'border-plume-blue-600');
            applyColorToIcons(checkedColorRadio.value);
        }

        // Aplicar seleção visual inicial para ícones
        const checkedIconRadio = document.querySelector('input[name="icon"]:checked');
        if (checkedIconRadio) {
            const label = checkedIconRadio.closest('label');
            label.classList.add('border-plume-blue-500', 'bg-plume-blue-50');
        }
    });
</script>
@endsection