@extends('backoffice.layouts.app')

@section('title', 'Detalhes da Integração')
@section('subtitle', $integration->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header com ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $integration->name }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $integration->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $integration->is_active ? 'Ativa' : 'Inativa' }}
                        </span>
                        <span class="capitalize">{{ ucfirst($integration->type) }}</span>
                        @if($integration->status)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($integration->status === 'connected') bg-green-100 text-green-800
                                @elseif($integration->status === 'disconnected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($integration->status) }}
                            </span>
                        @endif
                        <span>Criada em {{ $integration->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.integrations.edit', $integration) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('backoffice.integrations.toggle', $integration) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $integration->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                            {{ $integration->is_active ? 'Desativar' : 'Ativar' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informações Principais -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Configurações -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Configurações</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">API Key</label>
                            <div class="mt-1 flex items-center">
                                <input type="password" 
                                       value="{{ $integration->api_key ? '••••••••••••••••' : 'Não configurado' }}"
                                       readonly
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">API Secret</label>
                            <div class="mt-1 flex items-center">
                                <input type="password" 
                                       value="{{ $integration->api_secret ? '••••••••••••••••' : 'Não configurado' }}"
                                       readonly
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500">
                            </div>
                        </div>
                    </div>
                    
                    @if($integration->webhook_url)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Webhook URL</label>
                            <div class="mt-1">
                                <input type="text" 
                                       value="{{ $integration->webhook_url }}"
                                       readonly
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-500">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Logs de API -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Últimas Atividades</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-center py-8">Nenhuma atividade recente</p>
                    <!-- TODO: Implementar logs de API quando o model ApiLog estiver pronto -->
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Informações da Integração -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informações</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Tipo</dt>
                        <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $integration->type }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $integration->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $integration->is_active ? 'Ativa' : 'Inativa' }}
                            </span>
                        </dd>
                    </div>

                    @if($integration->status)
                        <div>
                            <dt class="text-sm font-medium text-gray-700">Conexão</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($integration->status === 'connected') bg-green-100 text-green-800
                                    @elseif($integration->status === 'disconnected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($integration->status) }}
                                </span>
                            </dd>
                        </div>
                    @endif

                    @if($integration->last_sync)
                        <div>
                            <dt class="text-sm font-medium text-gray-700">Última Sincronização</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $integration->last_sync->format('d/m/Y H:i') }}</dd>
                        </div>
                    @endif

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Criada em</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $integration->created_at->format('d/m/Y H:i') }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Última atualização</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $integration->updated_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Ações</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('backoffice.integrations.edit', $integration) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Editar Integração
                    </a>
                    
                    <form method="POST" action="{{ route('backoffice.integrations.toggle', $integration) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $integration->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                            {{ $integration->is_active ? 'Desativar' : 'Ativar' }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Estatísticas</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">0</div>
                            <div class="text-sm text-gray-500">Chamadas Hoje</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">0</div>
                            <div class="text-sm text-gray-500">Sucessos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ações Finais -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.integrations.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        ← Voltar para Lista
                    </a>
                    <a href="{{ route('backoffice.integrations.edit', $integration) }}" 
                       class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Editar Integração
                    </a>
                </div>
                
                <form method="POST" action="{{ route('backoffice.integrations.destroy', $integration) }}" 
                      onsubmit="return confirm('Tem certeza que deseja excluir esta integração?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Excluir Integração
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
