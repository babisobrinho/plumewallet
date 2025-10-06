@extends('backoffice.layouts.app')

@section('title', 'Detalhes da Tentativa de Login')
@section('subtitle', 'Visualizar tentativa de login')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tentativa de Login</h1>
                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $loginAttempt->success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $loginAttempt->success ? 'Sucesso' : 'Falha' }}
                        </span>
                        <span>{{ $loginAttempt->attempted_at->format('d/m/Y H:i:s') }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.login-attempts.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        ← Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informações da Tentativa -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Informações da Tentativa</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-700">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $loginAttempt->email }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-700">IP Address</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $loginAttempt->ip_address }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-700">Resultado</dt>
                    <dd class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $loginAttempt->success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $loginAttempt->success ? 'Sucesso' : 'Falha' }}
                        </span>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-700">Data/Hora</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $loginAttempt->attempted_at->format('d/m/Y H:i:s') }}</dd>
                </div>

                @if($loginAttempt->user)
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Usuário</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $loginAttempt->user->name }}</dd>
                    </div>
                @endif
            </div>
        </div>

        <!-- Informações de Localização -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Localização</h3>
            </div>
            <div class="p-6 space-y-4">
                @if($loginAttempt->country)
                    <div>
                        <dt class="text-sm font-medium text-gray-700">País</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $loginAttempt->country }}</dd>
                    </div>
                @endif

                @if($loginAttempt->city)
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Cidade</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $loginAttempt->city }}</dd>
                    </div>
                @endif

                @if($loginAttempt->country && $loginAttempt->city)
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Localização Completa</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $loginAttempt->city }}, {{ $loginAttempt->country }}</dd>
                    </div>
                @endif

                @if(!$loginAttempt->country && !$loginAttempt->city)
                    <div class="text-center py-8">
                        <p class="text-gray-500">Informações de localização não disponíveis</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- User Agent -->
    @if($loginAttempt->user_agent)
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">User Agent</h3>
            </div>
            <div class="p-6">
                <div class="bg-gray-50 rounded-md p-4">
                    <code class="text-sm text-gray-800 break-all">{{ $loginAttempt->user_agent }}</code>
                </div>
            </div>
        </div>
    @endif

    <!-- Ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.login-attempts.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        ← Voltar para Lista
                    </a>
                </div>
                
                @if($loginAttempt->user)
                    <a href="{{ route('backoffice.users.show', $loginAttempt->user) }}" 
                       class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Ver Usuário
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
