@extends('backoffice.layouts.app')

@section('title', 'Detalhes da Team')
@section('subtitle', $team->name)

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header com ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $team->name }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $team->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $team->is_active ? 'Ativa' : 'Inativa' }}
                        </span>
                        @if($team->personal_team)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Equipe Pessoal
                            </span>
                        @endif
                        <span>Criada em {{ $team->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.teams.edit', $team) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('backoffice.teams.toggle-status', $team) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $team->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                            {{ $team->is_active ? 'Desativar' : 'Ativar' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informações Principais -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Descrição -->
            @if($team->description)
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Descrição</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700">{{ $team->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Membros da Equipe -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Membros</h3>
                        <span class="text-sm text-gray-500">{{ $team->users->count() }} membros</span>
                    </div>
                </div>
                <div class="p-6">
                    @if($team->users && $team->users->count() > 0)
                        <div class="space-y-4">
                            @foreach($team->users as $user)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        @if($user->id === $team->user_id)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                Proprietário
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Membro
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Nenhum membro na equipe</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Informações da Equipe -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informações</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Proprietário</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $team->owner->name ?? 'Proprietário não encontrado' }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Total de Membros</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $team->users->count() }}</dd>
                    </div>

                    @if($team->max_members)
                        <div>
                            <dt class="text-sm font-medium text-gray-700">Limite de Membros</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $team->max_members }}</dd>
                        </div>
                    @endif

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $team->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $team->is_active ? 'Ativa' : 'Inativa' }}
                            </span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Criada em</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $team->created_at->format('d/m/Y H:i') }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Última atualização</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $team->updated_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Ações</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('backoffice.teams.edit', $team) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Editar Equipe
                    </a>
                    
                    <form method="POST" action="{{ route('backoffice.teams.toggle-status', $team) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $team->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                            {{ $team->is_active ? 'Desativar Equipe' : 'Ativar Equipe' }}
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
                            <div class="text-2xl font-bold text-blue-600">{{ $team->users->count() }}</div>
                            <div class="text-sm text-gray-500">Membros</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $team->users->where('is_active', true)->count() }}</div>
                            <div class="text-sm text-gray-500">Ativos</div>
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
                    <a href="{{ route('backoffice.teams.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        ← Voltar para Lista
                    </a>
                    <a href="{{ route('backoffice.teams.edit', $team) }}" 
                       class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Editar Equipe
                    </a>
                </div>
                
                <form method="POST" action="{{ route('backoffice.teams.destroy', $team) }}" 
                      onsubmit="return confirm('Tem certeza que deseja excluir esta equipe?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Excluir Equipe
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
