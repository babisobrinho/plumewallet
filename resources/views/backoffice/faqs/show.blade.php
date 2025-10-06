@extends('backoffice.layouts.app')

@section('title', 'Detalhes da FAQ')
@section('subtitle', 'Visualizar pergunta frequente')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header com ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $faq->question }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $faq->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $faq->is_active ? 'Ativa' : 'Inativa' }}
                        </span>
                        <span class="capitalize">{{ ucfirst($faq->category) }}</span>
                        <span>Ordem: {{ $faq->order }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.faqs.edit', $faq) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Editar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Resposta</h3>
        </div>
        <div class="p-6">
            <div class="prose max-w-none">
                {!! nl2br(e($faq->answer)) !!}
            </div>
        </div>
    </div>

    <!-- Estatísticas -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Estatísticas</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ number_format($faq->views ?? 0) }}</div>
                    <div class="text-sm text-gray-500">Visualizações</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ number_format($faq->helpful_yes ?? 0) }}</div>
                    <div class="text-sm text-gray-500">Útil (Sim)</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">{{ number_format($faq->helpful_no ?? 0) }}</div>
                    <div class="text-sm text-gray-500">Não Útil</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informações Adicionais -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Informações</h3>
        </div>
        <div class="p-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-700">Categoria</dt>
                    <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $faq->category }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-700">Ordem de Exibição</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $faq->order }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-700">Status</dt>
                    <dd class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $faq->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $faq->is_active ? 'Ativa' : 'Inativa' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-700">Criado em</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $faq->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-700">Última atualização</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $faq->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.faqs.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        ← Voltar para Lista
                    </a>
                    <a href="{{ route('backoffice.faqs.edit', $faq) }}" 
                       class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Editar FAQ
                    </a>
                </div>
                
                <form method="POST" action="{{ route('backoffice.faqs.destroy', $faq) }}" 
                      onsubmit="return confirm('Tem certeza que deseja excluir esta FAQ?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Excluir FAQ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
