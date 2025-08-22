<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <!-- Cabeçalho -->
        <div class="bg-plume-blue-600 dark:bg-plume-blue-700 px-6 py-4">
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
                <label for="name" class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Nome da Categoria</label>
                <input type="text" name="name" id="name" 
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out dark:bg-gray-700 dark:text-white" 
                       placeholder="Ex: Academia, Salário Extra" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Tipo -->
            <div class="mb-6">
                <label class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Tipo</label>
                <div class="flex space-x-6">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="type" value="expense" id="type_expense"
                               class="form-radio text-plume-blue-600 h-5 w-5" {{ old('type', 'expense') === 'expense' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Despesa</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="type" value="income" id="type_income"
                               class="form-radio text-plume-blue-600 h-5 w-5" {{ old('type') === 'income' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Receita</span>
                    </label>
                </div>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

<!-- Cor -->
<div class="mb-6">
    <label class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Cor</label>
    
    <!-- Cores agrupadas por tonalidade -->
    <div class="space-y-4" id="color-container">
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
            <h4 class="text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">{{ $groupName }}</h4>
            <div class="flex flex-wrap gap-2">
                @foreach($colors as $color)
                <label class="cursor-pointer">
                    <input type="radio" name="color" value="{{ $color }}" class="sr-only" {{ old('color') == $color ? 'checked' : '' }}>
                    <div class="w-8 h-8 rounded-full border-2 border-transparent transition-colors duration-200 color-option
                        @if(str_contains($color, 'white')) bg-white border border-gray-300 @else bg-plume-{{ str_replace('-', '-', $color) }} @endif">
                    </div>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    @error('color')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
            
            <!-- Ícone -->
            <div class="mb-8">
                <label class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Ícone</label>
                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3" id="icons-container">
                    @foreach($expenseIcons as $icon)
                    <label class="flex flex-col items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-plume-cream dark:hover:bg-gray-700 cursor-pointer transition duration-300 ease-in-out shadow-sm icon-option">
                        <input type="radio" name="icon" value="{{ $icon }}" 
                            class="form-radio text-plume-blue-600 h-4 w-4 mb-2 hidden"
                            {{ (old('icon') == $icon) || ($loop->first && !old('icon')) ? 'checked' : '' }}>
                        <div class="icon-container w-12 h-12 rounded-full flex items-center justify-center bg-plume-blue-500">
                            <i class="{{ $icon }} text-3xl text-white"></i>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('icon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Botões -->
            <div class="flex justify-between border-t pt-6 mt-6 border-gray-200 dark:border-gray-700">
                <a href="{{ route('categories.index') }}" 
                   class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300 ease-in-out shadow-sm">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-plume-blue-600 dark:bg-plume-blue-500 text-white rounded-lg hover:bg-plume-blue-700 dark:hover:bg-plume-blue-600 transition duration-300 ease-in-out flex items-center shadow-md">
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

        // Mapeamento de cores para classes CSS de background
        const bgColorMap = {
            'teal-500': 'bg-plume-teal-500',
            'violet-500': 'bg-plume-violet-500',
            'lime-500': 'bg-plume-lime-500',
            'orange-500': 'bg-plume-orange-500',
            'red-500': 'bg-plume-red-500',
            'cyan-500': 'bg-plume-cyan-500',
            'purple-500': 'bg-plume-purple-500',
            'pink-500': 'bg-plume-pink-500',
            'indigo-500': 'bg-plume-indigo-500',
            'slate-500': 'bg-plume-slate-500',
            'teal-400': 'bg-plume-teal-400',
            'violet-400': 'bg-plume-violet-400',
            'lime-400': 'bg-plume-lime-400',
            'orange-400': 'bg-plume-orange-400',
            'red-400': 'bg-plume-red-400',
            'cyan-400': 'bg-plume-cyan-400',
            'purple-400': 'bg-plume-purple-400',
            'pink-400': 'bg-plume-pink-400',
            'indigo-400': 'bg-plume-indigo-400',
            'slate-400': 'bg-plume-slate-400',
            'teal-300': 'bg-plume-teal-300',
            'violet-300': 'bg-plume-violet-300',
            'lime-300': 'bg-plume-lime-300',
            'orange-300': 'bg-plume-orange-300',
            'red-300': 'bg-plume-red-300',
            'cyan-300': 'bg-plume-cyan-300',
            'purple-300': 'bg-plume-purple-300',
            'pink-300': 'bg-plume-pink-300',
            'indigo-300': 'bg-plume-indigo-300',
            'slate-300': 'bg-plume-slate-300',
            'white': 'bg-white',
            'gray-200': 'bg-plume-gray-200',
            'gray-300': 'bg-plume-gray-300',
            'gray-400': 'bg-plume-gray-400',
            'gray-500': 'bg-plume-gray-500',
            'gray-600': 'bg-plume-gray-600',
            'gray-700': 'bg-plume-gray-700',
            'black': 'bg-black',
            'blue-500': 'bg-plume-blue-500',
            'green-500': 'bg-plume-green-500',
            'teal-600': 'bg-plume-teal-600',
            // Cores antigas para compatibilidade
            'blue-600': 'bg-plume-blue-600',
            'red-600': 'bg-plume-red-600',
            'purple': 'bg-plume-purple-500',
            'cyan': 'bg-plume-cyan-500',
            'yellow-500': 'bg-plume-yellow-500'
        };

        // Função para aplicar cor aos ícones (fundo)
        function applyColorToIcons(selectedColor) {
            const iconContainers = document.querySelectorAll('.icon-container');
            const bgColorClass = bgColorMap[selectedColor] || 'bg-plume-blue-500';
            
            iconContainers.forEach(container => {
                // Remove todas as classes de background
                Object.values(bgColorMap).forEach(bgCls => {
                    container.classList.remove(bgCls);
                });
                // Remove a classe padrão (bg-plume-blue-500) se estiver presente
                container.classList.remove('bg-plume-blue-500');
                // Adiciona o novo background
                container.classList.add(bgColorClass);
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
                iconContainer.className = `icon-container w-12 h-12 rounded-full flex items-center justify-center ${bgColorClass}`;
                
                const iconElement = document.createElement('i');
                iconElement.className = `${icon} text-3xl text-white`;
                
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
    });
</script>
</x-app-layout>