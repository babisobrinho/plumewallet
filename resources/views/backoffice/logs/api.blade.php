@extends('backoffice.layouts.app')

@section('title', 'Logs de API')
@section('subtitle', 'Visualizar chamadas para APIs externas')

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
                    <label for="status_code" class="block text-sm font-medium text-gray-700">Status Code</label>
                    <select name="status_code" id="status_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Todos os códigos</option>
                        <option value="200" {{ request('status_code') == '200' ? 'selected' : '' }}>200 - Sucesso</option>
                        <option value="400" {{ request('status_code') == '400' ? 'selected' : '' }}>400 - Erro do Cliente</option>
                        <option value="401" {{ request('status_code') == '401' ? 'selected' : '' }}>401 - Não Autorizado</option>
                        <option value="404" {{ request('status_code') == '404' ? 'selected' : '' }}>404 - Não Encontrado</option>
                        <option value="500" {{ request('status_code') == '500' ? 'selected' : '' }}>500 - Erro do Servidor</option>
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
            <h3 class="text-lg font-medium text-gray-900">Logs de API</h3>
        </div>
        <div class="overflow-hidden">
            @if($logs->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Método</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Endpoint</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Integração</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalhes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $log->method }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="max-w-xs truncate" title="{{ $log->endpoint }}">
                                        {{ $log->endpoint }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            '2' => 'bg-green-100 text-green-800',
                                            '4' => 'bg-yellow-100 text-yellow-800',
                                            '5' => 'bg-red-100 text-red-800'
                                        ];
                                        $statusClass = $statusColors[substr($log->status_code, 0, 1)] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                        {{ $log->status_code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $log->response_time ? $log->response_time . 'ms' : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $log->integration ? $log->integration->name : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    @if($log->request_body || $log->response_body)
                                        <details class="cursor-pointer">
                                            <summary class="text-xs text-indigo-600 hover:text-indigo-800">Ver dados</summary>
                                            <div class="mt-2 space-y-2">
                                                @if($log->request_body)
                                                    <div>
                                                        <span class="text-xs font-medium text-blue-600">Request:</span>
                                                        <pre class="text-xs bg-blue-50 p-2 rounded overflow-x-auto max-h-32 overflow-y-auto">{{ json_encode($log->request_body, JSON_PRETTY_PRINT) }}</pre>
                                                    </div>
                                                @endif
                                                @if($log->response_body)
                                                    <div>
                                                        <span class="text-xs font-medium text-green-600">Response:</span>
                                                        <pre class="text-xs bg-green-50 p-2 rounded overflow-x-auto max-h-32 overflow-y-auto">{{ json_encode($log->response_body, JSON_PRETTY_PRINT) }}</pre>
                                                    </div>
                                                @endif
                                            </div>
                                        </details>
                                    @else
                                        <span class="text-gray-400">Sem dados</span>
                                    @endif
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum log encontrado</h3>
                    <p class="mt-1 text-sm text-gray-500">Não há logs de API para exibir.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
