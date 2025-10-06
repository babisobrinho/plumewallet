@extends('backoffice.layouts.app')

@section('title', 'Criar FAQ')
@section('subtitle', 'Adicionar nova pergunta frequente')

@section('content')
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('backoffice.faqs.store') }}" class="space-y-6">
        @csrf
        
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Nova FAQ</h3>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700">Pergunta *</label>
                    <textarea name="question" 
                              id="question" 
                              rows="3"
                              required
                              placeholder="Digite a pergunta..."
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('question') }}</textarea>
                    @error('question')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="answer" class="block text-sm font-medium text-gray-700">Resposta *</label>
                    <textarea name="answer" 
                              id="answer" 
                              rows="8"
                              required
                              placeholder="Digite a resposta..."
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Categoria *</label>
                        <select name="category" 
                                id="category" 
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecionar categoria</option>
                            <option value="general" {{ old('category') === 'general' ? 'selected' : '' }}>Geral</option>
                            <option value="billing" {{ old('category') === 'billing' ? 'selected' : '' }}>Cobrança</option>
                            <option value="technical" {{ old('category') === 'technical' ? 'selected' : '' }}>Técnico</option>
                            <option value="account" {{ old('category') === 'account' ? 'selected' : '' }}>Conta</option>
                            <option value="features" {{ old('category') === 'features' ? 'selected' : '' }}>Funcionalidades</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700">Ordem de Exibição</label>
                        <input type="number" 
                               name="order" 
                               id="order" 
                               value="{{ old('order', 0) }}"
                               min="0"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Menor número aparece primeiro</p>
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active" 
                           value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        FAQ ativa (visível para usuários)
                    </label>
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('backoffice.faqs.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                Criar FAQ
            </button>
        </div>
    </form>
</div>
@endsection
