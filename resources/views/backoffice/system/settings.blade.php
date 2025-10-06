@extends('backoffice.layouts.app')

@section('title', 'Configurações do Sistema')
@section('subtitle', 'Gerenciar configurações globais do sistema')

@section('content')
<div class="space-y-6">
    <!-- Configurações Gerais -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Configurações Gerais</h3>
            <p class="mt-1 text-sm text-gray-500">Configure as principais opções do sistema</p>
        </div>
        
        <form method="POST" action="{{ route('backoffice.system.settings.update') }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome da Aplicação -->
                <div>
                    <label for="app_name" class="block text-sm font-medium text-gray-700">Nome da Aplicação</label>
                    <input type="text" 
                           name="app_name" 
                           id="app_name" 
                           value="{{ old('app_name', config('app.name')) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- URL da Aplicação -->
                <div>
                    <label for="app_url" class="block text-sm font-medium text-gray-700">URL da Aplicação</label>
                    <input type="url" 
                           name="app_url" 
                           id="app_url" 
                           value="{{ old('app_url', config('app.url')) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Ambiente -->
                <div>
                    <label for="app_env" class="block text-sm font-medium text-gray-700">Ambiente</label>
                    <select name="app_env" 
                            id="app_env" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="local" {{ config('app.env') === 'local' ? 'selected' : '' }}>Local</option>
                        <option value="staging" {{ config('app.env') === 'staging' ? 'selected' : '' }}>Staging</option>
                        <option value="production" {{ config('app.env') === 'production' ? 'selected' : '' }}>Produção</option>
                    </select>
                </div>

                <!-- Debug -->
                <div>
                    <label for="app_debug" class="block text-sm font-medium text-gray-700">Modo Debug</label>
                    <select name="app_debug" 
                            id="app_debug" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="true" {{ config('app.debug') ? 'selected' : '' }}>Ativado</option>
                        <option value="false" {{ !config('app.debug') ? 'selected' : '' }}>Desativado</option>
                    </select>
                </div>

                <!-- Timezone -->
                <div>
                    <label for="app_timezone" class="block text-sm font-medium text-gray-700">Fuso Horário</label>
                    <select name="app_timezone" 
                            id="app_timezone" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="UTC" {{ config('app.timezone') === 'UTC' ? 'selected' : '' }}>UTC</option>
                        <option value="America/Sao_Paulo" {{ config('app.timezone') === 'America/Sao_Paulo' ? 'selected' : '' }}>Brasília (GMT-3)</option>
                        <option value="America/New_York" {{ config('app.timezone') === 'America/New_York' ? 'selected' : '' }}>Nova York (GMT-5)</option>
                        <option value="Europe/London" {{ config('app.timezone') === 'Europe/London' ? 'selected' : '' }}>Londres (GMT+0)</option>
                    </select>
                </div>

                <!-- Locale -->
                <div>
                    <label for="app_locale" class="block text-sm font-medium text-gray-700">Idioma Padrão</label>
                    <select name="app_locale" 
                            id="app_locale" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="pt" {{ config('app.locale') === 'pt' ? 'selected' : '' }}>Português</option>
                        <option value="en" {{ config('app.locale') === 'en' ? 'selected' : '' }}>English</option>
                        <option value="es" {{ config('app.locale') === 'es' ? 'selected' : '' }}>Español</option>
                    </select>
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

    <!-- Configurações de Email -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Configurações de Email</h3>
            <p class="mt-1 text-sm text-gray-500">Configure o sistema de envio de emails</p>
        </div>
        
        <form method="POST" action="{{ route('backoffice.system.settings.update') }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Driver de Email -->
                <div>
                    <label for="mail_mailer" class="block text-sm font-medium text-gray-700">Driver de Email</label>
                    <select name="mail_mailer" 
                            id="mail_mailer" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="smtp" {{ config('mail.default') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                        <option value="sendmail" {{ config('mail.default') === 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                        <option value="log" {{ config('mail.default') === 'log' ? 'selected' : '' }}>Log (Desenvolvimento)</option>
                    </select>
                </div>

                <!-- Host SMTP -->
                <div>
                    <label for="mail_host" class="block text-sm font-medium text-gray-700">Host SMTP</label>
                    <input type="text" 
                           name="mail_host" 
                           id="mail_host" 
                           value="{{ old('mail_host', config('mail.mailers.smtp.host')) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Porta SMTP -->
                <div>
                    <label for="mail_port" class="block text-sm font-medium text-gray-700">Porta SMTP</label>
                    <input type="number" 
                           name="mail_port" 
                           id="mail_port" 
                           value="{{ old('mail_port', config('mail.mailers.smtp.port')) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Username SMTP -->
                <div>
                    <label for="mail_username" class="block text-sm font-medium text-gray-700">Usuário SMTP</label>
                    <input type="text" 
                           name="mail_username" 
                           id="mail_username" 
                           value="{{ old('mail_username', config('mail.mailers.smtp.username')) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Email Remetente -->
                <div>
                    <label for="mail_from_address" class="block text-sm font-medium text-gray-700">Email Remetente</label>
                    <input type="email" 
                           name="mail_from_address" 
                           id="mail_from_address" 
                           value="{{ old('mail_from_address', config('mail.from.address')) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Nome Remetente -->
                <div>
                    <label for="mail_from_name" class="block text-sm font-medium text-gray-700">Nome Remetente</label>
                    <input type="text" 
                           name="mail_from_name" 
                           id="mail_from_name" 
                           value="{{ old('mail_from_name', config('mail.from.name')) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                    Salvar Configurações de Email
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
