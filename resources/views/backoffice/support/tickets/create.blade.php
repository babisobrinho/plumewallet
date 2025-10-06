@extends('backoffice.layouts.app')

@section('title', 'Criar Ticket de Suporte')
@section('subtitle', 'Abrir novo ticket de suporte')

@section('content')
<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ route('backoffice.support.tickets.store') }}" class="space-y-6">
        @csrf
        
        <!-- Informações Básicas -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Informações do Ticket</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Assunto *</label>
                    <input type="text" 
                           name="subject" 
                           id="subject" 
                           value="{{ old('subject') }}"
                           required
                           placeholder="Resumo do problema..."
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                        <select name="category_id" 
                                id="category_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecionar categoria</option>
                            <!-- TODO: Adicionar categorias quando o model TicketCategory estiver pronto -->
                            <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>Geral</option>
                            <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>Técnico</option>
                            <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>Cobrança</option>
                            <option value="4" {{ old('category_id') == '4' ? 'selected' : '' }}>Funcionalidade</option>
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700">Prioridade *</label>
                        <select name="priority" 
                                id="priority" 
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Baixa</option>
                            <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Média</option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Alta</option>
                            <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>Urgente</option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Descrição -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Descrição do Problema</h3>
            </div>
            <div class="p-6">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição Detalhada *</label>
                    <textarea name="description" 
                              id="description" 
                              rows="10"
                              required
                              placeholder="Descreva o problema em detalhes..."
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Inclua informações como: passos para reproduzir, mensagens de erro, navegador usado, etc.
                    </p>
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('backoffice.support.tickets.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                Criar Ticket
            </button>
        </div>
    </form>
</div>
@endsection
