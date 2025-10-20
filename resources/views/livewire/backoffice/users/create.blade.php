<x-slot name="header">
    <x-backoffice-header
        title="Criar Utilizador"
        subtitle="Adicionar novo utilizador ao sistema"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <form wire:submit="save" class="p-6 space-y-6">
                <!-- Nome -->
                <div>
                    <x-label for="name" value="Nome Completo" />
                    <x-input 
                        id="name" 
                        type="text" 
                        class="mt-1 block w-full" 
                        wire:model="name" 
                        required 
                        autofocus 
                        autocomplete="name" 
                    />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-label for="email" value="Email" />
                    <x-input 
                        id="email" 
                        type="email" 
                        class="mt-1 block w-full" 
                        wire:model="email" 
                        required 
                        autocomplete="email" 
                    />
                    <x-input-error for="email" class="mt-2" />
                </div>

                <!-- Telefone -->
                <div>
                    <x-label for="phone_number" value="Número de Telefone" />
                    <x-input 
                        id="phone_number" 
                        type="tel" 
                        class="mt-1 block w-full" 
                        wire:model="phone_number" 
                        autocomplete="tel" 
                    />
                    <x-input-error for="phone_number" class="mt-2" />
                </div>

                <!-- Tipo de Utilizador -->
                <div>
                    <x-label for="role_type" value="Tipo de Utilizador" />
                    <select 
                        id="role_type" 
                        wire:model="role_type" 
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                        <option value="">Selecione o tipo</option>
                        @foreach($roleTypeOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="role_type" class="mt-2" />
                </div>

                <!-- Palavra-passe -->
                <div>
                    <x-label for="password" value="Palavra-passe" />
                    <x-input 
                        id="password" 
                        type="password" 
                        class="mt-1 block w-full" 
                        wire:model="password" 
                        required 
                        autocomplete="new-password" 
                    />
                    <x-input-error for="password" class="mt-2" />
                </div>

                <!-- Confirmar Palavra-passe -->
                <div>
                    <x-label for="password_confirmation" value="Confirmar Palavra-passe" />
                    <x-input 
                        id="password_confirmation" 
                        type="password" 
                        class="mt-1 block w-full" 
                        wire:model="password_confirmation" 
                        required 
                        autocomplete="new-password" 
                    />
                    <x-input-error for="password_confirmation" class="mt-2" />
                </div>

                <!-- Status Ativo -->
                <div class="flex items-center">
                    <input 
                        id="is_active" 
                        type="checkbox" 
                        wire:model="is_active" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="is_active" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                        Utilizador ativo (email verificado automaticamente)
                    </label>
                </div>

                <!-- Botões -->
                <div class="flex items-center justify-end space-x-4">
                    <a 
                        href="{{ route('backoffice.users.index') }}" 
                        class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Cancelar
                    </a>
                    <x-button class="ml-4">
                        <x-icon name="user-plus" class="w-4 h-4 mr-2" />
                        Criar Utilizador
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
