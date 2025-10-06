@extends('backoffice.layouts.app')

@section('title', 'Detalhes do Ticket')
@section('subtitle', 'Ticket: ' . $ticket->ticket_number)

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header com ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $ticket->subject }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span class="font-mono text-lg">{{ $ticket->ticket_number }}</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($ticket->status === 'open') bg-green-100 text-green-800
                            @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                            @elseif($ticket->status === 'waiting_customer') bg-yellow-100 text-yellow-800
                            @elseif($ticket->status === 'resolved') bg-purple-100 text-purple-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($ticket->priority === 'urgent') bg-red-100 text-red-800
                            @elseif($ticket->priority === 'high') bg-orange-100 text-orange-800
                            @elseif($ticket->priority === 'medium') bg-yellow-100 text-yellow-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                        <span>Criado em {{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.support.tickets.edit', $ticket) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Editar
                    </a>
                    @if($ticket->status !== 'closed')
                        <form method="POST" action="{{ route('backoffice.support.tickets.close', $ticket) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700">
                                Fechar Ticket
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Conteúdo Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Descrição -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Descrição do Problema</h3>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Mensagens -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Conversa</h3>
                </div>
                <div class="p-6">
                    @if($ticket->messages && $ticket->messages->count() > 0)
                        <div class="space-y-4">
                            @foreach($ticket->messages as $message)
                                <div class="flex space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-medium">
                                            {{ substr($message->user->name ?? 'U', 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $message->user->name ?? 'Usuário' }}</h4>
                                            <span class="text-sm text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                            @if($message->is_internal)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Interno
                                                </span>
                                            @endif
                                        </div>
                                        <div class="mt-1 text-sm text-gray-700">
                                            {!! nl2br(e($message->message)) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Nenhuma mensagem ainda</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Informações do Ticket -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informações</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Cliente</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $ticket->user->name ?? 'Usuário não encontrado' }}</dd>
                    </div>
                    
                    @if($ticket->assignedAgent)
                        <div>
                            <dt class="text-sm font-medium text-gray-700">Agente Atribuído</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $ticket->assignedAgent->name }}</dd>
                        </div>
                    @endif

                    @if($ticket->category)
                        <div>
                            <dt class="text-sm font-medium text-gray-700">Categoria</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $ticket->category->name ?? 'Categoria não encontrada' }}</dd>
                        </div>
                    @endif

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Criado em</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $ticket->created_at->format('d/m/Y H:i') }}</dd>
                    </div>

                    @if($ticket->due_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-700">Prazo</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $ticket->due_date->format('d/m/Y H:i') }}</dd>
                        </div>
                    @endif

                    @if($ticket->resolution_date)
                        <div>
                            <dt class="text-sm font-medium text-gray-700">Resolvido em</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $ticket->resolution_date->format('d/m/Y H:i') }}</dd>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Ações Rápidas -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Ações</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('backoffice.support.tickets.edit', $ticket) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Editar Ticket
                    </a>
                    
                    @if($ticket->status !== 'closed')
                        <form method="POST" action="{{ route('backoffice.support.tickets.close', $ticket) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700">
                                Fechar Ticket
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Satisfação -->
            @if($ticket->satisfaction_rating)
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Avaliação</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-1">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="h-5 w-5 {{ $i <= $ticket->satisfaction_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">{{ $ticket->satisfaction_rating }}/5</span>
                        </div>
                        @if($ticket->satisfaction_comment)
                            <p class="mt-2 text-sm text-gray-600">{{ $ticket->satisfaction_comment }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
