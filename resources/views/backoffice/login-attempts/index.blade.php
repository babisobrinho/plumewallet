@extends('backoffice.layouts.app')

@section('title', 'Tentativas de Login')
@section('subtitle', 'Monitorar tentativas de login no sistema')

@section('content')
<div class="space-y-6">
    <!-- Header com filtros -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Tentativas de Login</h3>
        </div>
        
        <!-- Filtros -->
        <div class="px-6 py-4 bg-gray-50">
            <form method="GET" class="flex items-center space-x-4">
                <div>
                    <input type="text" 
                           name="email" 
                           value="{{ request('email') }}"
                           placeholder="Buscar por email..."
                           class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <select name="success" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos os resultados</option>
                        <option value="true" {{ request('success') === 'true' ? 'selected' : '' }}>Sucesso</option>
                        <option value="false" {{ request('success') === 'false' ? 'selected' : '' }}>Falha</option>
                    </select>
                </div>
                <div>
                    <input type="text" 
                           name="ip_address" 
                           value="{{ request('ip_address') }}"
                           placeholder="Buscar por IP..."
                           class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Filtrar
                </button>
                @if(request()->hasAny(['email', 'success', 'ip_address']))
                    <a href="{{ route('backoffice.login-attempts.index') }}" 
                       class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Limpar
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Lista de tentativas -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            IP Address
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Resultado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Localização
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Data/Hora
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($attempts ?? [] as $attempt)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $attempt->email }}</div>
                                @if($attempt->user)
                                    <div class="text-sm text-gray-500">{{ $attempt->user->name }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $attempt->ip_address }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $attempt->success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $attempt->success ? 'Sucesso' : 'Falha' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @if($attempt->city && $attempt->country)
                                        {{ $attempt->city }}, {{ $attempt->country }}
                                    @else
                                        Não disponível
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $attempt->attempted_at->format('d/m/Y H:i:s') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('backoffice.login-attempts.show', $attempt) }}" 
                                   class="text-blue-600 hover:text-blue-900">Ver Detalhes</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Nenhuma tentativa de login encontrada
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginação -->
        @if(isset($attempts) && $attempts->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $attempts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
