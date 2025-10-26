<x-slot name="header">
    <x-backoffice-header
        title="Detalhes do Utilizador"
        subtitle="Informações completas do utilizador"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header com ações -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    ID: {{ $user->id }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a 
                    href="{{ route('backoffice.users.index') }}" 
                    class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    <i class="ti ti-arrow-left w-4 h-4 mr-2"></i>
                    Voltar
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Informações Pessoais -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('users.personal_information') }}
                        </h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('users.form.full_name') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('common.labels.email') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('common.labels.phone_number') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->phone_number ?: '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('common.labels.status') }}</dt>
                                <dd class="mt-1">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <i class="ti ti-circle-check w-3 h-3 mr-1"></i>
                                            {{ __('enums.status.active') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            <i class="ti ti-circle-x w-3 h-3 mr-1"></i>
                                            {{ __('enums.status.inactive') }}
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('common.labels.registered_at') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('common.labels.last_updated') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Informações de Acesso -->
            <div>
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                            Acesso e Permissões
                        </h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('users.form.user_type') }}</dt>
                                <dd class="mt-1">
                                    @php
                                        $role = $user->roles->first();
                                        $roleType = $role ? $role->type : null;
                                        $roleName = $role ? $role->name : 'Sem role';
                                        
                                        $badgeClasses = match($roleType) {
                                            'staff' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                            'client' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                            default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
                                        {{ ucfirst($roleName) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('users.form.email_verified') }}</dt>
                                <dd class="mt-1">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <i class="ti ti-circle-check w-3 h-3 mr-1"></i>
                                            {{ __('common.terms.yes') }}
                                        </span>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            {{ __('users.form.verified_on') }} {{ $user->email_verified_at->format('d/m/Y H:i') }}
                                        </p>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            <i class="ti ti-circle-x w-3 h-3 mr-1"></i>
                                            {{ __('common.terms.no') }}
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        @can('users_destroy')
            @if($user->id !== auth()->id())
                <div class="mt-8 bg-white dark:bg-gray-900 shadow rounded-2xl overflow-hidden border border-red-500 dark:border-red-700">
                    <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400 p-6 flex flex-col items-start justify-between gap-2">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('users.danger_zone.delete_user') }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('users.danger_zone.delete_description') }}
                        </p>
                        <button 
                            wire:click="confirmUserDeletion"
                            class="inline-flex items-center mt-2 px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            <i class="ti ti-trash w-4 h-4 inline"></i>
                            {{ __('common.buttons.delete') }}
                        </button>
                        
                    </div>
                </div>

                <!-- Delete User Confirmation Modal -->
                @if($confirmingUserDeletion)
                    <div class="fixed inset-0 z-[9999] flex items-center justify-center">
                        <!-- Backdrop -->
                        <div class="fixed inset-0 bg-black bg-opacity-50 z-[10000]" wire:click="cancelUserDeletion"></div>
                        
                        <!-- Modal -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4 relative z-[10001]">
                            <!-- Header -->
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('users.danger_zone.delete_user') }}
                                </h3>
                            </div>
                            
                            <!-- Content -->
                            <div class="px-6 py-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('users.danger_zone.delete_confirmation', ['name' => $user->name]) }}
                                </p>
                                
                                <div class="mt-4">
                                    <input 
                                        type="text" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        placeholder="{{ __('users.danger_zone.confirm_name_placeholder') }}"
                                        wire:model="confirmName"
                                        wire:keydown.enter="deleteUser" 
                                    />
                                    @error('confirmName')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 flex justify-end space-x-3">
                                <button 
                                    type="button" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    wire:click="cancelUserDeletion"
                                >
                                    {{ __('common.buttons.cancel') }}
                                </button>
                                
                                <button 
                                    type="button" 
                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                    wire:click="deleteUser"
                                >
                                    {{ __('common.buttons.delete') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endcan
    </div>
</div>
