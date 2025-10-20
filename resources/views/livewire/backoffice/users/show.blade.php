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
                    {{ $user->email }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a 
                    href="{{ route('backoffice.users.edit', $user) }}" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    <i class="ti ti-pencil w-4 h-4 mr-2"></i>
                    Editar
                </a>
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
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                            Informações Pessoais
                        </h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nome Completo</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Telefone</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->phone_number ?: 'Não informado' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="mt-1">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <i class="ti ti-circle-check w-3 h-3 mr-1"></i>
                                            Ativo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            <i class="ti ti-circle-x w-3 h-3 mr-1"></i>
                                            Inativo
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Registado em</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Última atualização</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Informações de Acesso -->
            <div>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                            Acesso e Permissões
                        </h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Utilizador</dt>
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
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Verificado</dt>
                                <dd class="mt-1">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <i class="ti ti-circle-check w-3 h-3 mr-1"></i>
                                            Sim
                                        </span>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            Verificado em {{ $user->email_verified_at->format('d/m/Y H:i') }}
                                        </p>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            <i class="ti ti-circle-x w-3 h-3 mr-1"></i>
                                            Não
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Ações Rápidas -->
                <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                            Ações Rápidas
                        </h3>
                        <div class="space-y-3">
                            <a 
                                href="{{ route('backoffice.users.edit', $user) }}" 
                                class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded-md hover:bg-blue-700 transition-colors"
                            >
                                <i class="ti ti-pencil w-4 h-4 inline mr-2"></i>
                                Editar Utilizador
                            </a>
                            @if($user->id !== auth()->id())
                                <button 
                                    wire:click="deleteUser({{ $user->id }})"
                                    wire:confirm="Tem certeza que deseja eliminar este utilizador?"
                                    class="block w-full bg-red-600 text-white text-center py-2 px-4 rounded-md hover:bg-red-700 transition-colors"
                                >
                                    <i class="ti ti-trash w-4 h-4 inline mr-2"></i>
                                    Eliminar Utilizador
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
