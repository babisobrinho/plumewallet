@extends('backoffice.layouts.app')

@section('title', 'Detalhes do Post')
@section('subtitle', $post->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header com ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($post->status === 'published') bg-green-100 text-green-800
                            @elseif($post->status === 'draft') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($post->status) }}
                        </span>
                        @if($post->is_featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                Destacado
                            </span>
                        @endif
                        <span>Por {{ $post->author->name ?? 'Autor desconhecido' }}</span>
                        <span>{{ $post->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.blog.posts.edit', $post) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('backoffice.blog.posts.toggle-featured', $post) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $post->is_featured ? 'bg-gray-600 hover:bg-gray-700' : 'bg-purple-600 hover:bg-purple-700' }}">
                            {{ $post->is_featured ? 'Remover Destaque' : 'Destacar' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Conteúdo</h3>
        </div>
        <div class="p-6">
            @if($post->excerpt)
                <div class="mb-6">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Resumo:</h4>
                    <p class="text-gray-600">{{ $post->excerpt }}</p>
                </div>
            @endif
            
            <div class="prose max-w-none">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </div>

    <!-- Informações Adicionais -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- SEO -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">SEO</h3>
            </div>
            <div class="p-6 space-y-4">
                @if($post->meta_title)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Meta Título</label>
                        <p class="mt-1 text-sm text-gray-600">{{ $post->meta_title }}</p>
                    </div>
                @endif

                @if($post->meta_description)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Meta Descrição</label>
                        <p class="mt-1 text-sm text-gray-600">{{ $post->meta_description }}</p>
                    </div>
                @endif

                @if($post->tags)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tags</label>
                        <div class="mt-1 flex flex-wrap gap-2">
                            @foreach(is_array($post->tags) ? $post->tags : explode(',', $post->tags) as $tag)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Estatísticas</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Visualizações:</span>
                    <span class="text-sm text-gray-600">{{ number_format($post->view_count ?? 0) }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Criado em:</span>
                    <span class="text-sm text-gray-600">{{ $post->created_at->format('d/m/Y H:i') }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Última atualização:</span>
                    <span class="text-sm text-gray-600">{{ $post->updated_at->format('d/m/Y H:i') }}</span>
                </div>

                @if($post->published_at)
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-700">Publicado em:</span>
                        <span class="text-sm text-gray-600">{{ $post->published_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Ações -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('backoffice.blog.posts.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        ← Voltar para Lista
                    </a>
                    <a href="{{ route('backoffice.blog.posts.edit', $post) }}" 
                       class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Editar Post
                    </a>
                </div>
                
                <form method="POST" action="{{ route('backoffice.blog.posts.destroy', $post) }}" 
                      onsubmit="return confirm('Tem certeza que deseja excluir este post?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Excluir Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
