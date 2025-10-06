@extends('backoffice.layouts.app')

@section('title', 'Detalhes do Usuário')
@section('subtitle', 'Informações completas do usuário')

@section('content')
<div class="space-y-6">
    <!-- Header com ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-2xl font-medium text-gray-700">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-medium text-gray-900">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Ativo' : 'Inativo' }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.users.edit', $user) }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar
                    </a>
                    @if($user->is_active)
                        <form method="POST" action="{{ route('backoffice.users.deactivate', $user) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700"
                                    onclick="return confirm('Tem certeza que deseja desativar este usuário?')">
                                Desativar
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('backoffice.users.activate', $user) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700"
                                    onclick="return confirm('Tem certeza que deseja ativar este usuário?')">
                                Ativar
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Informações Gerais -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Dados Pessoais -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Dados Pessoais</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nome Completo</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email Verificado</dt>
                        <dd class="mt-1">
                            @if($user->email_verified_at)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Verificado
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Não verificado
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Fuso Horário</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->timezone ?? 'UTC' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Idioma</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->locale ?? 'pt' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Informações do Sistema -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Informações do Sistema</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">ID do Usuário</dt>
                        <dd class="mt-1 text-sm text-gray-900">#{{ $user->id }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Cadastrado em</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Última atualização</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                    </div>
                    @if($user->last_login_at)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Último login</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->last_login_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    @endif
                    @if($user->last_login_ip)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Último IP</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->last_login_ip }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Total de logins</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->login_count ?? 0 }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Atividades Recentes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tentativas de Login -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Tentativas de Login Recentes</h3>
            </div>
            <div class="p-6">
                @if($user->loginAttempts->count() > 0)
                    <div class="space-y-3">
                        @foreach($user->loginAttempts->take(5) as $attempt)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 rounded-full {{ $attempt->success ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $attempt->success ? 'Login bem-sucedido' : 'Tentativa falhada' }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $attempt->ip_address }}</p>
                                    </div>
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $attempt->attempted_at->diffForHumans() }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Nenhuma tentativa de login registrada</p>
                @endif
            </div>
        </div>

        <!-- Tickets de Suporte -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Tickets de Suporte</h3>
            </div>
            <div class="p-6">
                @if($user->supportTickets->count() > 0)
                    <div class="space-y-3">
                        @foreach($user->supportTickets->take(5) as $ticket)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $ticket->subject }}</p>
                                    <p class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $ticket->status === 'open' ? 'bg-red-100 text-red-800' : 
                                       ($ticket->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Nenhum ticket de suporte</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Posts do Blog -->
    @if($user->blogPosts->count() > 0)
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Posts do Blog</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach($user->blogPosts->take(5) as $post)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $post->title }}</p>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 
                                   ($post->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
