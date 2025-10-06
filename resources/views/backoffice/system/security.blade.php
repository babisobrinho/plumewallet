@extends('backoffice.layouts.app')

@section('title', 'Configurações de Segurança')
@section('subtitle', 'Gerenciar configurações de segurança do sistema')

@section('content')
<div class="space-y-6">
    <!-- Configurações de Segurança -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Configurações de Segurança</h3>
            <p class="mt-1 text-sm text-gray-500">Configure as opções de segurança do sistema</p>
        </div>
        
        <form method="POST" action="{{ route('backoffice.system.security.update') }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tentativas de Login -->
                <div>
                    <label for="max_login_attempts" class="block text-sm font-medium text-gray-700">Máximo de Tentativas de Login</label>
                    <input type="number" 
                           name="max_login_attempts" 
                           id="max_login_attempts" 
                           value="{{ old('max_login_attempts', 5) }}"
                           min="1"
                           max="10"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Número máximo de tentativas de login antes do bloqueio</p>
                </div>

                <!-- Tempo de Bloqueio -->
                <div>
                    <label for="failed_login_lockout_minutes" class="block text-sm font-medium text-gray-700">Tempo de Bloqueio (minutos)</label>
                    <input type="number" 
                           name="failed_login_lockout_minutes" 
                           id="failed_login_lockout_minutes" 
                           value="{{ old('failed_login_lockout_minutes', 15) }}"
                           min="1"
                           max="60"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Tempo de bloqueio após tentativas falhadas</p>
                </div>

                <!-- Timeout de Sessão -->
                <div>
                    <label for="session_timeout_minutes" class="block text-sm font-medium text-gray-700">Timeout de Sessão (minutos)</label>
                    <input type="number" 
                           name="session_timeout_minutes" 
                           id="session_timeout_minutes" 
                           value="{{ old('session_timeout_minutes', 120) }}"
                           min="30"
                           max="480"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Tempo de inatividade antes do logout automático</p>
                </div>

                <!-- Expiração de Senha -->
                <div>
                    <label for="password_expiry_days" class="block text-sm font-medium text-gray-700">Expiração de Senha (dias)</label>
                    <input type="number" 
                           name="password_expiry_days" 
                           id="password_expiry_days" 
                           value="{{ old('password_expiry_days') }}"
                           min="30"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Deixe vazio para não expirar senhas</p>
                </div>
            </div>

            <!-- Opções de Segurança -->
            <div class="mt-6 space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" 
                           name="two_factor_required" 
                           id="two_factor_required" 
                           value="1"
                           {{ old('two_factor_required') ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="two_factor_required" class="ml-2 block text-sm text-gray-900">
                        Obrigar autenticação de dois fatores
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" 
                           name="brute_force_protection" 
                           id="brute_force_protection" 
                           value="1"
                           {{ old('brute_force_protection', true) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="brute_force_protection" class="ml-2 block text-sm text-gray-900">
                        Proteção contra força bruta
                    </label>
                </div>
            </div>

            <!-- Botões -->
            <div class="mt-6 flex items-center justify-end space-x-3">
                <button type="button" 
                        onclick="location.reload()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Salvar Configurações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
