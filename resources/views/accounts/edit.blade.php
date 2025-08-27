<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <!-- Cabeçalho -->
        <div class="bg-plume-blue-600 dark:bg-plume-blue-700 px-6 py-4">
            <div class="flex items-center">
                <a href="{{ route('accounts.index') }}" class="text-plume-cream hover:text-white mr-4 transition duration-300 ease-in-out">
                    <i class="ti ti-arrow-left text-xl"></i>
                </a>
                <h2 class="text-2xl font-bold text-white">Editar Conta</h2>
            </div>
        </div>
        
        <!-- Formulário -->
        <form action="{{ route('accounts.update', $account) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Nome da Conta -->
            <div class="mb-6">
                <label for="name" class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Nome da Conta</label>
                <input type="text" name="name" id="name" 
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out dark:bg-gray-700 dark:text-white" 
                       placeholder="Ex: Conta Principal, Poupança Bradesco..." value="{{ old('name', $account->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Tipo de Conta -->
            <div class="mb-6">
                <label for="account_type_id" class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Tipo de Conta</label>
                <select name="account_type_id" id="account_type_id" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out dark:bg-gray-700 dark:text-white">
                    <option value="">Selecione um tipo</option>
                    @foreach($types as $id => $name)
                        <option value="{{ $id }}" {{ old('account_type_id', $account->account_type_id) == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('account_type_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Saldo Atual -->
            <div class="mb-6">
                <label for="balance" class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Saldo Atual</label>
                <div class="relative">
                    <input type="number" name="balance" id="balance" 
                           class="w-full px-4 py-2 pr-8 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-plume-blue-500 focus:border-transparent transition duration-300 ease-in-out dark:bg-gray-700 dark:text-white" 
                           placeholder="0.00" value="{{ old('balance', $account->balance) }}" step="0.01" min="0" required>
                    <span class="absolute right-3 top-2 text-gray-500 dark:text-gray-400">€</span>
                </div>
                @error('balance')
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
                                <input type="radio" name="color" value="bg-{{ $color }}" class="sr-only" {{ old('color', $account->color) == 'bg-' . $color ? 'checked' : '' }}>
                                <div class="w-8 h-8 rounded-full border-2 border-transparent transition-colors duration-200 color-option
                                    @if(str_contains($color, 'white')) bg-white border border-gray-300 @else bg-{{ $color }} @endif">
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
            
            <!-- Ícone (Predefinido pelo tipo) -->
            <div class="mb-6">
                <label class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Ícone da Conta</label>
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                        O ícone será automaticamente definido com base no tipo de conta selecionado:
                    </p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="icon-preview">
                        @foreach($types as $id => $name)
                        @php
                            $accountType = \App\Models\AccountType::find($id);
                            $icon = $accountType ? $accountType->icon : 'wallet';
                        @endphp
                        <div class="flex flex-col items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center bg-plume-blue-500 mb-2 icon-container">
                                <i class="ti ti-{{ $icon }} text-2xl text-white"></i>
                            </div>
                            <span class="text-xs text-gray-600 dark:text-gray-400 text-center">{{ $name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Saldo Efetivo -->
            <div class="mb-8">
                <label class="block text-plume-blue-600 dark:text-plume-blue-400 font-semibold mb-2">Considerar no Total</label>
                <div class="flex space-x-6">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="is_balance_effective" value="1" 
                               class="form-radio text-plume-blue-600 h-5 w-5" {{ old('is_balance_effective', $account->is_balance_effective) == '1' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Sim - Incluir no saldo total</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="is_balance_effective" value="0" 
                               class="form-radio text-plume-blue-600 h-5 w-5" {{ old('is_balance_effective', $account->is_balance_effective) == '0' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Não - Apenas para marcação</span>
                    </label>
                </div>
                @error('is_balance_effective')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botões -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('accounts.index') }}" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-plume-blue-600 hover:bg-plume-blue-700 text-white font-medium rounded-lg transition-colors">
                    Atualizar Conta
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorRadios = document.querySelectorAll('input[name="color"]');
        const iconPreview = document.getElementById('icon-preview');
        
        // Mapeamento de cores para classes CSS de background
        const bgColorMap = {
            'bg-blue-500': 'bg-blue-500',
            'bg-cyan-300': 'bg-cyan-300',
            'bg-cyan-400': 'bg-cyan-400',
            'bg-cyan-500': 'bg-cyan-500',
            'bg-teal-300': 'bg-teal-300',
            'bg-teal-400': 'bg-teal-400',
            'bg-teal-500': 'bg-teal-500',
            'bg-teal-600': 'bg-teal-600',
            'bg-green-500': 'bg-green-500',
            'bg-lime-300': 'bg-lime-300',
            'bg-lime-400': 'bg-lime-400',
            'bg-lime-500': 'bg-lime-500',
            'bg-violet-300': 'bg-violet-300',
            'bg-violet-400': 'bg-violet-400',
            'bg-violet-500': 'bg-violet-500',
            'bg-purple-300': 'bg-purple-300',
            'bg-purple-400': 'bg-purple-400',
            'bg-purple-500': 'bg-purple-500',
            'bg-indigo-300': 'bg-indigo-300',
            'bg-indigo-400': 'bg-indigo-400',
            'bg-indigo-500': 'bg-indigo-500',
            'bg-pink-300': 'bg-pink-300',
            'bg-pink-400': 'bg-pink-400',
            'bg-pink-500': 'bg-pink-500',
            'bg-red-300': 'bg-red-300',
            'bg-red-400': 'bg-red-400',
            'bg-red-500': 'bg-red-500',
            'bg-orange-300': 'bg-orange-300',
            'bg-orange-400': 'bg-orange-400',
            'bg-orange-500': 'bg-orange-500',
            'bg-yellow-500': 'bg-yellow-500',
            'bg-white': 'bg-white',
            'bg-gray-200': 'bg-gray-200',
            'bg-gray-300': 'bg-gray-300',
            'bg-gray-400': 'bg-gray-400',
            'bg-gray-500': 'bg-gray-500',
            'bg-gray-600': 'bg-gray-600',
            'bg-gray-700': 'bg-gray-700',
            'bg-black': 'bg-black',
            'bg-slate-300': 'bg-slate-300',
            'bg-slate-400': 'bg-slate-400',
            'bg-slate-500': 'bg-slate-500'
        };

        // Função para aplicar cor aos ícones (fundo)
        function applyColorToIcons(selectedColor) {
            const iconContainers = iconPreview.querySelectorAll('.icon-container');
            const bgColorClass = selectedColor || 'bg-plume-blue-500';
            
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

        // Adicionar efeito visual para seleção de cores
        colorRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove seleção visual de todos
                document.querySelectorAll('.color-option').forEach(option => {
                    option.classList.remove('ring-2', 'ring-blue-500', 'border-blue-600');
                });
                
                // Adiciona seleção visual ao selecionado
                if (this.checked) {
                    const div = this.nextElementSibling;
                    div.classList.add('ring-2', 'ring-blue-500', 'border-blue-600');
                    
                    // Aplica a cor aos fundos dos ícones
                    applyColorToIcons(this.value);
                }
            });
        });

        // Aplicar seleção visual inicial para cores
        const checkedColorRadio = document.querySelector('input[name="color"]:checked');
        if (checkedColorRadio) {
            const div = checkedColorRadio.nextElementSibling;
            div.classList.add('ring-2', 'ring-blue-500', 'border-blue-600');
            applyColorToIcons(checkedColorRadio.value);
        } else {
            // Se nenhum estiver selecionado, selecione o primeiro e aplique
            if (colorRadios.length > 0) {
                colorRadios[0].checked = true;
                const div = colorRadios[0].nextElementSibling;
                div.classList.add('ring-2', 'ring-blue-500', 'border-blue-600');
                applyColorToIcons(colorRadios[0].value);
            }
        }
        
        // Debug: verificar se as cores estão sendo aplicadas
        console.log('Cores disponíveis:', Object.keys(bgColorMap));
        console.log('Primeira cor selecionada:', colorRadios[0]?.value);
        console.log('Ícones encontrados:', iconPreview.querySelectorAll('.icon-container').length);
    });
</script>
</x-app-layout>

