@extends('backoffice.layouts.app')

@section('title', 'Logs de Auditoria')
@section('subtitle', 'Visualizar ações dos usuários no sistema')

@section('content')
<div class="space-y-6">
    <!-- Filtros -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Filtros</h3>
        </div>
        <div class="p-6">
            <form method="GET" class="flex gap-4">
                <div>
                    <label for="event" class="block text-sm font-medium text-gray-700">Evento</label>
                    <select name="event" id="event" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Todos os eventos</option>
                        <option value="created" {{ request('event') == 'created' ? 'selected' : '' }}>Criado</option>
                        <option value="updated" {{ request('event') == 'updated' ? 'selected' : '' }}>Atualizado</option>
                        <option value="deleted" {{ request('event') == 'deleted' ? 'selected' : '' }}>Removido</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de Logs -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Logs de Auditoria</h3>
        </div>
        <div class="overflow-hidden">
            @if($logs->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalhes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $log->user ? $log->user->name : 'Sistema' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $eventColors = [
                                            'created' => 'bg-green-100 text-green-800',
                                            'updated' => 'bg-blue-100 text-blue-800',
                                            'deleted' => 'bg-red-100 text-red-800'
                                        ];
                                    @endphp
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $eventColors[$log->event] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($log->event) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ class_basename($log->auditable_type) }}
                                    <div class="text-xs text-gray-500">ID: {{ $log->auditable_id }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    @if($log->old_values || $log->new_values)
                                        <details class="cursor-pointer">
                                            <summary class="text-xs text-indigo-600 hover:text-indigo-800">Ver alterações</summary>
                                            <div class="mt-2 space-y-2">
                                                @if($log->old_values)
                                                    <div>
                                                        <span class="text-xs font-medium text-red-600">Valores anteriores:</span>
                                                        <pre class="text-xs bg-red-50 p-2 rounded overflow-x-auto">{{ json_encode($log->old_values, JSON_PRETTY_PRINT) }}</pre>
                                                    </div>
                                                @endif
                                                @if($log->new_values)
                                                    <div>
                                                        <span class="text-xs font-medium text-green-600">Valores novos:</span>
                                                        <pre class="text-xs bg-green-50 p-2 rounded overflow-x-auto">{{ json_encode($log->new_values, JSON_PRETTY_PRINT) }}</pre>
                                                    </div>
                                                @endif
                                            </div>
                                        </details>
                                    @else
                                        <span class="text-gray-400">Sem detalhes</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $log->ip_address }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Paginação -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $logs->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum log encontrado</h3>
                    <p class="mt-1 text-sm text-gray-500">Não há logs de auditoria para exibir.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
