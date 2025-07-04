<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('accounts.index') }}"
               class="mr-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Carteira') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('accounts.update', $account) }}"
                      x-data="{
                          form: {
                              name: '{{ old('name', $account->name) }}',
                              type: '{{ old('type', $account->type) }}',
                              balance: '{{ old('balance', number_format($account->balance, 2, '.', '')) }}',
                              color: '{{ old('color', $account->color) }}',
                              icon: '{{ old('icon', $account->icon) }}',
                              is_balance_effective: {{ old('is_balance_effective', $account->is_balance_effective) ? 'true' : 'false' }}
                          },
                          updateIcon() {
                              const iconMap = {
                                  'conta_corrente': 'building-bank',
                                  'dinheiro': 'cash',
                                  'poupanca': 'pig-money',
                                  'investimentos': 'trending-up',
                                  'cartao_alimentacao': 'tools-kitchen-2',
                                  'outros': 'wallet'
                              };
                              this.form.icon = iconMap[this.form.type] || 'wallet';
                          }
                      }"
                      x-init="updateIcon()"
                      class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nome da Carteira -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nome da Carteira
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               x-model="form.name"
                               required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:text-gray-200"
                               placeholder="Ex: Carteira Principal, Conta Poupança...">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo de Carteira -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tipo de Carteira
                        </label>
                        <select id="account_type_id" name="account_type_id" x-model="form.type" @change="updateIcon()" required>
                            <option value="">Selecione um tipo</option>
                            @foreach($types as $id => $name)
                                <option value="{{ $id }}" {{ old('account_type_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Saldo Atual -->
                    <div>
                        <label for="balance" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Saldo Atual
                        </label>
                        <div class="relative">
                            <input type="number"
                                   id="balance"
                                   name="balance"
                                   x-model="form.balance"
                                   step="0.01"
                                   min="0"
                                   max="999999.99"
                                   required
                                   class="w-full px-3 py-2 pr-8 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:text-gray-200">
                            <span class="absolute right-3 top-2 text-gray-500 dark:text-gray-400">€</span>
                        </div>
                        @error('balance')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seleção de Cor -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            Cor da Carteira
                        </label>

                        <!-- Cores principais destacadas -->
                        <div class="mb-4">
                            <div class="flex flex-wrap gap-3 mb-4">
                                @foreach([
                                    'bg-teal-500' => 'Teal',
                                    'bg-violet-500' => 'Violet',
                                    'bg-lime-500' => 'Lime',
                                    'bg-orange-500' => 'Orange',
                                    'bg-red-500' => 'Red',
                                    'bg-cyan-500' => 'Cyan',
                                    'bg-purple-500' => 'Purple'
                                ] as $colorClass => $name)
                                    <label class="cursor-pointer flex flex-col items-center">
                                        <input type="radio" name="color" value="{{ $colorClass }}" x-model="form.color" class="sr-only">
                                        <div class="w-10 h-10 rounded-full border-4 transition-all duration-200 hover:scale-110 relative {{ $colorClass }}"
                                             :class="form.color === '{{ $colorClass }}' ? 'border-gray-800 dark:border-gray-200 shadow-lg' : 'border-gray-300 dark:border-gray-600'">
                                            <div x-show="form.color === '{{ $colorClass }}'" class="absolute inset-0 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <span class="text-xs mt-1 text-gray-600 dark:text-gray-400">{{ $name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Todas as cores organizadas por tonalidades -->
                        <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4 shadow-sm">
                            @foreach([
                                'Cores 500' => [
                                    'bg-teal-500' => 'Teal',
                                    'bg-violet-500' => 'Violet',
                                    'bg-lime-500' => 'Lime',
                                    'bg-orange-500' => 'Orange',
                                    'bg-red-500' => 'Red',
                                    'bg-cyan-500' => 'Cyan',
                                    'bg-purple-500' => 'Purple'
                                ],
                                'Cores 400' => [
                                    'bg-teal-400' => 'Teal 400',
                                    'bg-violet-400' => 'Violet 400',
                                    'bg-lime-400' => 'Lime 400',
                                    'bg-orange-400' => 'Orange 400',
                                    'bg-red-400' => 'Red 400',
                                    'bg-cyan-400' => 'Cyan 400',
                                    'bg-purple-400' => 'Purple 400'
                                ],
                                'Cores 300' => [
                                    'bg-teal-300' => 'Teal 300',
                                    'bg-violet-300' => 'Violet 300',
                                    'bg-lime-300' => 'Lime 300',
                                    'bg-orange-300' => 'Orange 300',
                                    'bg-red-300' => 'Red 300',
                                    'bg-cyan-300' => 'Cyan 300',
                                    'bg-purple-300' => 'Purple 300'
                                ],
                                'Cores Neutras' => [
                                    'bg-slate-100' => 'Slate 100',
                                    'bg-slate-300' => 'Slate 300',
                                    'bg-slate-400' => 'Slate 400',
                                    'bg-slate-500' => 'Slate 500',
                                    'bg-slate-600' => 'Slate 600',
                                    'bg-slate-700' => 'Slate 700',
                                    'bg-slate-800' => 'Slate 800'
                                ],
                                'Especiais' => [
                                    'bg-black' => 'Preto',
                                    'bg-blue-600' => 'Azul',
                                    'bg-emerald-600' => 'Emerald',
                                    'bg-teal-800' => 'Teal 800'
                                ]
                            ] as $group => $colors)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ $group }}</h4>
                                    <div class="grid grid-cols-7 gap-2">
                                        @foreach($colors as $colorClass => $name)
                                            <label class="cursor-pointer flex flex-col items-center">
                                                <input type="radio" name="color" value="{{ $colorClass }}" x-model="form.color" class="sr-only">
                                                <div class="w-8 h-8 rounded-full border-2 transition-all duration-200 hover:scale-110 relative {{ $colorClass }}"
                                                     :class="form.color === '{{ $colorClass }}' ? 'border-gray-800 dark:border-gray-200 shadow-lg' : 'border-gray-300 dark:border-gray-600'">
                                                    <div x-show="form.color === '{{ $colorClass }}'" class="absolute inset-0 flex items-center justify-center">
                                                        <svg class="w-3 h-3 {{ in_array($colorClass, ['bg-slate-100', 'bg-slate-300', 'bg-teal-300', 'bg-lime-300', 'bg-orange-300', 'bg-red-300', 'bg-cyan-300', 'bg-purple-300']) ? 'text-gray-800' : 'text-white' }}" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Campo oculto para o ícone -->
                    <input type="hidden" name="icon" x-model="form.icon">

                    <!-- Campo para definir se o saldo é efetivo -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div>
                            <label for="is_balance_effective" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Este saldo deve ser considerado no total?
                            </label>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Desative esta opção se este valor for apenas para marcação e não deva ser somado ao seu saldo total.
                            </p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_balance_effective" value="0">
                            <input type="checkbox"
                                   id="is_balance_effective"
                                   name="is_balance_effective"
                                   value="1"
                                   class="sr-only peer"
                                   x-model="form.is_balance_effective"
                                @checked(old('is_balance_effective', true))>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600 dark:peer-checked:bg-teal-700 dark:bg-gray-600"></div>
                        </label>
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end space-x-4 pt-6">
                        <a href="{{ route('accounts.index') }}"
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors duration-150">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-teal-600 to-teal-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-teal-700 hover:to-teal-800 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Atualizar Carteira
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
                        account_type_id: '{{ old("account_type_id") }}' || '',
                        balance: '{{ old("balance", "0.00") }}' || '0.00',
                        color: '{{ old("color") }}' || 'bg-teal-500',
                        is_balance_effective: {{ old('is_balance_effective', 1) ? 'true' : 'false' }}
                    },


                    init() {
                        this.updateIcon();
                    },

                    updateIcon() {
                        const iconMap = {
                            'checking_account': 'building-bank',
                            'cash': 'cash',
                            'savings': 'pig-money',
                            'investments': 'trending-up',
                            'meal_card': 'tools-kitchen-2',
                            'others': 'wallet'
                        };

                        this.form.icon = iconMap[this.form.type] || 'wallet';
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
