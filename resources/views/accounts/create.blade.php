<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('accounts.index') }}"
               class="mr-4 text-gray-500 hover:text-gray-700 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nova Conta') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12" style="background: linear-gradient(135deg, #f8f5ef 0%, #fff9f0 100%);">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('accounts.store') }}"
                      x-data="walletForm()"
                      class="p-6 space-y-6">
                    @csrf

                    <!-- Nome da Carteira -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome da Carteira
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               x-model="form.name"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                               placeholder="Ex: Carteira Principal, Conta Poupança...">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo de Carteira -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo de Carteira
                        </label>
                        <select id="type"
                                name="type"
                                x-model="form.type"
                                @change="updateIcon()"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Selecione um tipo</option>
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Saldo Inicial -->
                    <div>
                        <label for="balance" class="block text-sm font-medium text-gray-700 mb-2">
                            Saldo Inicial
                        </label>
                        <div class="relative">
                            <input type="number"
                                   id="balance"
                                   name="balance"
                                   value="{{ old('balance', '0.00') }}"
                                   x-model="form.balance"
                                   step="0.01"
                                   min="0"
                                   max="999999.99"
                                   required
                                   class="w-full px-3 py-2 pr-8 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                            <span class="absolute right-3 top-2 text-gray-500">€</span>
                        </div>
                        @error('balance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seleção de Cor -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Cor da Carteira
                        </label>
                        <div class="grid grid-cols-4 gap-3">
                            @foreach($defaultColors as $color)
                                <label class="cursor-pointer">
                                    <input type="radio"
                                           name="color"
                                           value="{{ $color }}"
                                           x-model="form.color"
                                           class="sr-only"
                                        {{ old('color', $defaultColors[1]) == $color ? 'checked' : '' }}>
                                    <div class="w-12 h-12 rounded-full border-4 transition-all duration-200 hover:scale-110"
                                         style="background-color: {{ $color }};"
                                         :class="form.color === '{{ $color }}' ? 'border-gray-800 shadow-lg' : 'border-gray-300'">
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <!-- Cor Personalizada -->
                        <div class="mt-4">
                            <label for="custom_color" class="block text-sm text-gray-600 mb-2">
                                Ou escolha uma cor personalizada:
                            </label>
                            <input type="color"
                                   id="custom_color"
                                   x-model="form.color"
                                   class="w-16 h-10 border border-gray-300 rounded cursor-pointer">
                        </div>
                        @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview da Carteira -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">
                            Pré-visualização
                        </h4>
                        <div class="bg-white rounded-lg shadow-md p-4 border-l-4"
                             :style="'border-left-color: ' + form.color">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white"
                                     :style="'background-color: ' + form.color">
                                    <i class="ti ti-wallet" x-show="!form.icon"></i>
                                    <i class="ti" :class="'ti-' + form.icon" x-show="form.icon"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-gray-900"
                                    
                                        x-text="form.name || 'Nome da Carteira'">
                                    </h3>
                                    <p class="text-sm text-gray-500 capitalize"
                                    
                                       x-text="form.type ? form.type.replace('_', ' ') : 'Tipo da carteira'">
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-2xl font-bold"
                                   :style="'color: ' + form.color + '; font-family: Poppins, sans-serif;'">
                                    <span x-text="parseFloat(form.balance || 0).toFixed(2).replace('.', ',')"></span>€
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Campo oculto para o ícone -->
                    <input type="hidden" name="icon" x-model="form.icon">

                    <!-- Botões -->
                    <div class="flex items-center justify-end space-x-4 pt-6">
                        <a href="{{ route('accounts.index') }}"
                           class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors duration-150">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-teal-600 to-teal-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-teal-700 hover:to-teal-800 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Criar Carteira
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function walletForm() {
                return {
                    form: {
                        name: '{{ old("name") }}' || '',
                        type: '{{ old("type") }}' || '',
                        balance: '{{ old("balance", "0.00") }}' || '0.00',
                        color: '{{ old("color", $defaultColors[1]) }}' || '#0b4c64',
                        icon: ''
                    },

                    init() {
                        this.updateIcon();
                    },

                    updateIcon() {
                        const iconMap = {
                            'conta_corrente': 'building-bank',
                            'dinheiro': 'cash',
                            'poupanca': 'pig-money',
                            'investimentos': 'trending-up',
                            'vr_va': 'tools-kitchen-2',
                            'outros': 'wallet'
                        };

                        this.form.icon = iconMap[this.form.type] || 'wallet';
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
