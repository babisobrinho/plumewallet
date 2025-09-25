<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Nova Categoria') }}
            </h2>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <i class="ti ti-arrow-left mr-1"></i>Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Cabeçalho com ícone -->
                <div class="px-6 py-8 bg-gradient-to-r from-plume-blue-500 to-plume-blue-600">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-6">
                            <i class="ti ti-folder-plus text-3xl text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white">Criar Nova Categoria</h1>
                            <p class="text-white mt-2">Organize suas finanças criando categorias personalizadas</p>
                        </div>
                    </div>
                </div>
        
                <!-- Formulário -->
                <form action="{{ route('categories.store') }}" method="POST" class="p-8">
                    @csrf
                    
                    <!-- Seção 1: Informações Básicas -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                            <div class="w-8 h-8 bg-plume-blue-100 dark:bg-plume-blue-900 rounded-lg flex items-center justify-center mr-3">
                                <i class="ti ti-info-circle text-plume-blue-600 dark:text-plume-blue-400"></i>
                            </div>
                            Informações Básicas
                        </h3>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Nome da Categoria -->
                            <div class="lg:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                    Nome da Categoria
                                </label>
                                <input type="text" name="name" id="name" 
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out dark:bg-gray-700 dark:text-white shadow-sm" 
                                       placeholder="Ex: Academia, Salário Extra, Supermercado..." value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="ti ti-alert-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Seção 2: Tipo de Categoria -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                            <div class="w-8 h-8 bg-plume-teal-100 dark:bg-plume-teal-900 rounded-lg flex items-center justify-center mr-3">
                                <i class="ti ti-category text-plume-teal-600 dark:text-plume-teal-400"></i>
                            </div>
                            Tipo de Categoria
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="expense" id="type_expense"
                                       class="sr-only" {{ old('type', 'expense') === 'expense' ? 'checked' : '' }}>
                                <div class="p-6 border-2 border-gray-200 dark:border-gray-600 rounded-xl transition-all duration-300 hover:border-red-400 type-option" data-type="expense">
                                    <div class="flex items-center">
                                        <div class="w-16 h-16 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mr-4">
                                            <i class="ti ti-trending-down text-3xl text-red-600 dark:text-red-400"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-gray-100 text-lg">Despesa</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Para registrar gastos e saídas de dinheiro</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="income" id="type_income"
                                       class="sr-only" {{ old('type') === 'income' ? 'checked' : '' }}>
                                <div class="p-6 border-2 border-gray-200 dark:border-gray-600 rounded-xl transition-all duration-300 hover:border-green-400 type-option" data-type="income">
                                    <div class="flex items-center">
                                        <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-4">
                                            <i class="ti ti-trending-up text-3xl text-green-600 dark:text-green-400"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-gray-100 text-lg">Receita</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Para registrar ganhos e entradas de dinheiro</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @error('type')
                            <p class="text-red-500 text-sm mt-3 flex items-center">
                                <i class="ti ti-alert-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Seção 3: Cor da Categoria -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                            <div class="w-8 h-8 bg-plume-purple-100 dark:bg-plume-purple-900 rounded-lg flex items-center justify-center mr-3">
                                <i class="ti ti-palette text-plume-purple-600 dark:text-plume-purple-400"></i>
                            </div>
                            Cor da Categoria
                        </h3>
                        
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                            <div class="space-y-6" id="color-container">
                                @php
                                    $colorGroups = [
                                        'Azul/Verde' => ['blue-500', 'cyan-300', 'cyan-400', 'cyan-500', 'teal-300', 'teal-400', 'teal-500', 'teal-600', 'green-500', 'lime-300', 'lime-400', 'lime-500'],
                                        'Roxo/Rosa' => ['violet-300', 'violet-400', 'violet-500', 'purple-300', 'purple-400', 'purple-500', 'indigo-300', 'indigo-400', 'indigo-500', 'pink-300', 'pink-400', 'pink-500'],
                                        'Quentes' => ['red-300', 'red-400', 'red-500', 'orange-300', 'orange-400', 'orange-500', 'yellow-500'],
                                        'Neutras' => ['white', 'gray-200', 'gray-300', 'gray-400', 'gray-500', 'gray-600', 'gray-700', 'black', 'slate-300', 'slate-400', 'slate-500']
                                    ];
                                @endphp

                                @foreach($colorGroups as $groupName => $colors)
                                <div>
                                    <h4 class="text-gray-600 dark:text-gray-400 text-sm font-medium mb-4">{{ $groupName }}</h4>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($colors as $color)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="color" value="{{ $color }}" class="sr-only" {{ old('color') == $color ? 'checked' : '' }}>
                                            <div class="w-12 h-12 rounded-full border-3 border-transparent transition-all duration-200 color-option shadow-md hover:scale-110 hover:shadow-lg
                                                @if(str_contains($color, 'white')) bg-white border border-gray-300 @else bg-{{ str_replace('-', '-', $color) }} @endif">
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @error('color')
                            <p class="text-red-500 text-sm mt-3 flex items-center">
                                <i class="ti ti-alert-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Seção 4: Ícone da Categoria -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                            <div class="w-8 h-8 bg-plume-green-100 dark:bg-plume-green-900 rounded-lg flex items-center justify-center mr-3">
                                <i class="ti ti-mood-smile text-plume-green-600 dark:text-plume-green-400"></i>
                            </div>
                            Ícone da Categoria
                        </h3>
                        
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                            <div class="grid grid-cols-6 gap-4" id="icons-container">
                                @foreach($expenseIcons as $icon)
                                <label class="flex flex-col items-center p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl hover:bg-white dark:hover:bg-gray-600 cursor-pointer transition-all duration-300 ease-in-out shadow-sm icon-option hover:shadow-md hover:border-plume-blue-300">
                                    <input type="radio" name="icon" value="{{ $icon }}" 
                                        class="form-radio text-plume-blue-600 h-4 w-4 mb-2 hidden"
                                        {{ (old('icon') == $icon) || ($loop->first && !old('icon')) ? 'checked' : '' }}>
                                    <div class="icon-container w-16 h-16 rounded-full flex items-center justify-center bg-blue-500 shadow-sm">
                                        <i class="{{ $icon }} text-2xl text-white"></i>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        @error('icon')
                            <p class="text-red-500 text-sm mt-3 flex items-center">
                                <i class="ti ti-alert-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <!-- Botões -->
                    <div class="flex justify-between items-center pt-8 mt-8 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('categories.index') }}" 
                           class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 ease-in-out shadow-sm font-medium">
                            <i class="ti ti-x mr-2"></i>Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-plume-blue-500 to-plume-blue-600 text-white rounded-xl hover:from-plume-blue-600 hover:to-plume-blue-700 transition duration-300 ease-in-out shadow-lg hover:shadow-xl font-medium transform hover:scale-105">
                            <i class="ti ti-check mr-2"></i>Criar Categoria
                        </button>
                    </div>
                </form>
            </div>
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

        // Mapeamento de cores para classes CSS de background
        const bgColorMap = {
            'blue-500': 'bg-blue-500',
            'cyan-300': 'bg-cyan-300',
            'cyan-400': 'bg-cyan-400',
            'cyan-500': 'bg-cyan-500',
            'teal-300': 'bg-teal-300',
            'teal-400': 'bg-teal-400',
            'teal-500': 'bg-teal-500',
            'teal-600': 'bg-teal-600',
            'green-500': 'bg-green-500',
            'lime-300': 'bg-lime-300',
            'lime-400': 'bg-lime-400',
            'lime-500': 'bg-lime-500',
            'violet-300': 'bg-violet-300',
            'violet-400': 'bg-violet-400',
            'violet-500': 'bg-violet-500',
            'purple-300': 'bg-purple-300',
            'purple-400': 'bg-purple-400',
            'purple-500': 'bg-purple-500',
            'indigo-300': 'bg-indigo-300',
            'indigo-400': 'bg-indigo-400',
            'indigo-500': 'bg-indigo-500',
            'pink-300': 'bg-pink-300',
            'pink-400': 'bg-pink-400',
            'pink-500': 'bg-pink-500',
            'red-300': 'bg-red-300',
            'red-400': 'bg-red-400',
            'red-500': 'bg-red-500',
            'orange-300': 'bg-orange-300',
            'orange-400': 'bg-orange-400',
            'orange-500': 'bg-orange-500',
            'yellow-500': 'bg-yellow-500',
            'white': 'bg-white',
            'gray-200': 'bg-gray-200',
            'gray-300': 'bg-gray-300',
            'gray-400': 'bg-gray-400',
            'gray-500': 'bg-gray-500',
            'gray-600': 'bg-gray-600',
            'gray-700': 'bg-gray-700',
            'black': 'bg-black',
            'slate-300': 'bg-slate-300',
            'slate-400': 'bg-slate-400',
            'slate-500': 'bg-slate-500'
        };

        // Função para aplicar cor aos ícones (fundo)
        function applyColorToIcons(selectedColor) {
            const iconContainers = document.querySelectorAll('.icon-container');
            
            iconContainers.forEach(container => {
                // Remove todas as classes de background e gradiente
                container.className = container.className.replace(/bg-\w+-\d+/g, '');
                container.className = container.className.replace(/from-\w+-\d+/g, '');
                container.className = container.className.replace(/to-\w+-\d+/g, '');
                container.classList.remove('bg-gradient-to-br');
                
                // Aplica cor sólida baseada na cor selecionada
                if (bgColorMap[selectedColor]) {
                    container.classList.add(bgColorMap[selectedColor]);
                } else {
                    // Cor padrão
                    container.classList.add('bg-blue-500');
                }
            });
        }

        // Função para atualizar os ícones com base no tipo selecionado
        function updateIconsByType(type) {
            const icons = iconsByType[type];
            const currentSelectedIcon = document.querySelector('input[name="icon"]:checked')?.value;
            iconsContainer.innerHTML = '';
            
            const selectedColor = document.querySelector('input[name="color"]:checked')?.value || 'blue-500';
            const bgColorClass = bgColorMap[selectedColor] || 'bg-plume-blue-500';
            
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
                
                const iconContainer = document.createElement('div');
                iconContainer.className = `icon-container w-16 h-16 rounded-full flex items-center justify-center bg-blue-500 shadow-sm`;
                
                const iconElement = document.createElement('i');
                iconElement.className = `${icon} text-2xl text-white`;
                
                iconContainer.appendChild(iconElement);
                label.appendChild(input);
                label.appendChild(iconContainer);
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
                    
                    // Aplica a cor aos fundos dos ícones
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
        } else {
            // Se nenhum estiver selecionado, selecione o primeiro e aplique
            if (colorRadios.length > 0) {
                colorRadios[0].checked = true;
                const div = colorRadios[0].nextElementSibling;
                div.classList.add('ring-2', 'ring-plume-blue-500', 'border-plume-blue-600');
                applyColorToIcons(colorRadios[0].value);
            }
        }

        // Aplicar seleção visual inicial para ícones
        const checkedIconRadio = document.querySelector('input[name="icon"]:checked');
        if (checkedIconRadio) {
            const label = checkedIconRadio.closest('label');
            label.classList.add('border-plume-blue-500', 'bg-plume-blue-50');
        }

        // Aplicar seleção visual inicial para tipos
        const checkedTypeRadio = document.querySelector('input[name="type"]:checked');
        if (checkedTypeRadio) {
            const typeOption = document.querySelector(`.type-option[data-type="${checkedTypeRadio.value}"]`);
            if (typeOption) {
                if (checkedTypeRadio.value === 'expense') {
                    typeOption.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900');
                } else {
                    typeOption.classList.add('border-green-500', 'bg-green-50', 'dark:bg-green-900');
                }
            }
        }

        // Adicionar evento para seleção visual de tipos
        document.querySelectorAll('.type-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove seleção de todos
                document.querySelectorAll('.type-option').forEach(opt => {
                    opt.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900', 'border-green-500', 'bg-green-50', 'dark:bg-green-900');
                });
                
                // Adiciona seleção ao clicado
                const type = this.getAttribute('data-type');
                if (type === 'expense') {
                    this.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900');
                } else {
                    this.classList.add('border-green-500', 'bg-green-50', 'dark:bg-green-900');
                }
            });
        });
    });
</script>
</x-app-layout>