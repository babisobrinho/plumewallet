@extends('backoffice.layouts.app')

@section('title', 'Logs do Sistema')
@section('subtitle', 'Visualizar logs de erros, avisos e informações do sistema')

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
                    <label for="level" class="block text-sm font-medium text-gray-700">Nível</label>
                    <select name="level" id="level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Todos os níveis</option>
                        <option value="info" {{ request('level') == 'info' ? 'selected' : '' }}>Info</option>
                        <option value="warning" {{ request('level') == 'warning' ? 'selected' : '' }}>Aviso</option>
                        <option value="error" {{ request('level') == 'error' ? 'selected' : '' }}>Erro</option>
                        <option value="critical" {{ request('level') == 'critical' ? 'selected' : '' }}>Crítico</option>
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
            <h3 class="text-lg font-medium text-gray-900">Logs do Sistema</h3>
        </div>
        <div class="overflow-hidden">
            @if($logs->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nível</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mensagem</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $levelColors = [
                                            'info' => 'bg-blue-100 text-blue-800',
                                            'warning' => 'bg-yellow-100 text-yellow-800',
                                            'error' => 'bg-red-100 text-red-800',
                                            'critical' => 'bg-red-200 text-red-900'
                                        ];
                                    @endphp
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $levelColors[$log->level] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($log->level) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="max-w-xs truncate" title="{{ $log->message }}">
                                        {{ $log->message }}
                                    </div>
                                    @if($log->context)
                                        <details class="mt-1">
                                            <summary class="text-xs text-gray-500 cursor-pointer">Ver contexto</summary>
                                            <pre class="text-xs bg-gray-100 p-2 rounded mt-1 overflow-x-auto">{{ json_encode($log->context, JSON_PRETTY_PRINT) }}</pre>
                                        </details>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $log->user ? $log->user->name : 'Sistema' }}
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum log encontrado</h3>
                    <p class="mt-1 text-sm text-gray-500">Não há logs do sistema para exibir.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
