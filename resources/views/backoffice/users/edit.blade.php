@extends('backoffice.layouts.app')

@section('title', 'Editar Usuário')
@section('subtitle', 'Editar informações do usuário')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Editar Usuário: {{ $user->name }}</h3>
        </div>
        
        <form method="POST" action="{{ route('backoffice.users.update', $user) }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $user->name) }}"
                           required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $user->email) }}"
                           required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nova Senha -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha (opcional)</label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Deixe em branco para manter a senha atual</p>
                </div>

                <!-- Confirmar Nova Senha -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nova Senha</label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Timezone -->
                <div>
                    <label for="timezone" class="block text-sm font-medium text-gray-700">Fuso Horário</label>
                    <select name="timezone" 
                            id="timezone" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="UTC" {{ old('timezone', $user->timezone) === 'UTC' ? 'selected' : '' }}>UTC</option>
                        <option value="America/Sao_Paulo" {{ old('timezone', $user->timezone) === 'America/Sao_Paulo' ? 'selected' : '' }}>Brasília (GMT-3)</option>
                        <option value="America/New_York" {{ old('timezone', $user->timezone) === 'America/New_York' ? 'selected' : '' }}>Nova York (GMT-5)</option>
                        <option value="Europe/London" {{ old('timezone', $user->timezone) === 'Europe/London' ? 'selected' : '' }}>Londres (GMT+0)</option>
                    </select>
                </div>

                <!-- Idioma -->
                <div>
                    <label for="locale" class="block text-sm font-medium text-gray-700">Idioma</label>
                    <select name="locale" 
                            id="locale" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="pt" {{ old('locale', $user->locale) === 'pt' ? 'selected' : '' }}>Português</option>
                        <option value="en" {{ old('locale', $user->locale) === 'en' ? 'selected' : '' }}>English</option>
                        <option value="es" {{ old('locale', $user->locale) === 'es' ? 'selected' : '' }}>Español</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               id="is_active" 
                               value="1"
                               {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Usuário ativo
                        </label>
                    </div>
                </div>
            </div>

            <!-- Informações Adicionais -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Informações do Sistema</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Cadastrado em:</span>
                        <span class="ml-2 text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Última atualização:</span>
                        <span class="ml-2 text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @if($user->last_login_at)
                        <div>
                            <span class="text-gray-500">Último login:</span>
                            <span class="ml-2 text-gray-900">{{ $user->last_login_at->format('d/m/Y H:i') }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="text-gray-500">Total de logins:</span>
                        <span class="ml-2 text-gray-900">{{ $user->login_count }}</span>
                    </div>
                </div>
            </div>

            <!-- Botões -->
            <div class="mt-6 flex items-center justify-end space-x-3">
                <a href="{{ route('backoffice.users.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Atualizar Usuário
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
