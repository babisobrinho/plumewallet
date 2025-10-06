@extends('backoffice.layouts.app')

@section('title', 'Criar Integração')
@section('subtitle', 'Adicionar nova integração')

@section('content')
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('backoffice.integrations.store') }}" class="space-y-6">
        @csrf
        
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Nova Integração</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome da Integração *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           required
                           placeholder="Ex: Stripe, Twilio, Mailchimp..."
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipo *</label>
                    <select name="type" 
                            id="type" 
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Selecionar tipo</option>
                        <option value="payment" {{ old('type') === 'payment' ? 'selected' : '' }}>Pagamento</option>
                        <option value="sms" {{ old('type') === 'sms' ? 'selected' : '' }}>SMS</option>
                        <option value="email" {{ old('type') === 'email' ? 'selected' : '' }}>Email</option>
                        <option value="analytics" {{ old('type') === 'analytics' ? 'selected' : '' }}>Analytics</option>
                        <option value="storage" {{ old('type') === 'storage' ? 'selected' : '' }}>Armazenamento</option>
                        <option value="other" {{ old('type') === 'other' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="api_key" class="block text-sm font-medium text-gray-700">API Key</label>
                        <input type="password" 
                               name="api_key" 
                               id="api_key" 
                               value="{{ old('api_key') }}"
                               placeholder="Chave da API..."
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('api_key')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="api_secret" class="block text-sm font-medium text-gray-700">API Secret</label>
                        <input type="password" 
                               name="api_secret" 
                               id="api_secret" 
                               value="{{ old('api_secret') }}"
                               placeholder="Segredo da API..."
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('api_secret')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="webhook_url" class="block text-sm font-medium text-gray-700">Webhook URL</label>
                    <input type="url" 
                           name="webhook_url" 
                           id="webhook_url" 
                           value="{{ old('webhook_url') }}"
                           placeholder="https://exemplo.com/webhook"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('webhook_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active" 
                           value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Integração ativa
                    </label>
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('backoffice.integrations.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                Criar Integração
            </button>
        </div>
    </form>
</div>
@endsection
