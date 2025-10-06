@extends('backoffice.layouts.app')

@section('title', 'Editar Ticket')
@section('subtitle', 'Editar ticket: ' . $ticket->ticket_number)

@section('content')
<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ route('backoffice.support.tickets.update', $ticket) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
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
                           value="{{ old('subject', $ticket->subject) }}"
                           required
                           placeholder="Resumo do problema..."
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                        <select name="category_id" 
                                id="category_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecionar categoria</option>
                            <!-- TODO: Adicionar categorias quando o model TicketCategory estiver pronto -->
                            <option value="1" {{ old('category_id', $ticket->category_id) == '1' ? 'selected' : '' }}>Geral</option>
                            <option value="2" {{ old('category_id', $ticket->category_id) == '2' ? 'selected' : '' }}>Técnico</option>
                            <option value="3" {{ old('category_id', $ticket->category_id) == '3' ? 'selected' : '' }}>Cobrança</option>
                            <option value="4" {{ old('category_id', $ticket->category_id) == '4' ? 'selected' : '' }}>Funcionalidade</option>
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
                            <option value="low" {{ old('priority', $ticket->priority) === 'low' ? 'selected' : '' }}>Baixa</option>
                            <option value="medium" {{ old('priority', $ticket->priority) === 'medium' ? 'selected' : '' }}>Média</option>
                            <option value="high" {{ old('priority', $ticket->priority) === 'high' ? 'selected' : '' }}>Alta</option>
                            <option value="urgent" {{ old('priority', $ticket->priority) === 'urgent' ? 'selected' : '' }}>Urgente</option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select name="status" 
                                id="status" 
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="open" {{ old('status', $ticket->status) === 'open' ? 'selected' : '' }}>Aberto</option>
                            <option value="in_progress" {{ old('status', $ticket->status) === 'in_progress' ? 'selected' : '' }}>Em Progresso</option>
                            <option value="waiting_customer" {{ old('status', $ticket->status) === 'waiting_customer' ? 'selected' : '' }}>Aguardando Cliente</option>
                            <option value="resolved" {{ old('status', $ticket->status) === 'resolved' ? 'selected' : '' }}>Resolvido</option>
                            <option value="closed" {{ old('status', $ticket->status) === 'closed' ? 'selected' : '' }}>Fechado</option>
                        </select>
                        @error('status')
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
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $ticket->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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
                Atualizar Ticket
            </button>
        </div>
    </form>
</div>
@endsection
