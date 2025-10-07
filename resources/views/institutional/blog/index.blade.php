@extends('institutional.layouts.app')

@section('title', 'Blog')
@section('description', 'Descubra dicas, tutoriais e insights sobre finanças pessoais no blog da Plume Wallet. Aprenda a gerenciar melhor seu dinheiro.')

@section('content')
<!-- Breadcrumb -->
<section class="py-6 px-6 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('institutional.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                Início
            </a>
            <i class="ti ti-chevron-right text-gray-400"></i>
            <span class="text-gray-900 dark:text-white font-medium">Blog</span>
        </nav>
    </div>
</section>

<!-- Hero Section -->
<section class="py-16 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
            Blog Plume Wallet
        </h1>
        <p class="text-xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
            Descubra dicas, tutoriais e insights sobre finanças pessoais para transformar sua relação com o dinheiro
        </p>
    </div>
</section>

<!-- Blog Content -->
<section class="py-16 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                @if($posts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($posts as $post)
                            <article class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow overflow-hidden">
                                @if($post->featured_image)
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img 
                                            src="{{ $post->featured_image }}" 
                                            alt="{{ $post->title }}"
                                            class="w-full h-48 object-cover"
                                        >
                                    </div>
                                @else
                                    <div class="h-48 bg-gradient-to-br from-plume-100 to-plume-200 dark:from-plume-900/20 dark:to-plume-800/20 flex items-center justify-center">
                                        <i class="ti ti-file-text text-4xl text-plume-600 dark:text-plume-400"></i>
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    @if($post->category)
                                        <div class="inline-block bg-plume-100 dark:bg-plume-900/20 text-plume-800 dark:text-plume-200 px-3 py-1 rounded-full text-sm font-medium mb-3">
                                            {{ $post->category->name }}
                                        </div>
                                    @endif
                                    
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 line-clamp-2">
                                        <a href="{{ route('institutional.blog.show', $post->slug) }}" class="hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    
                                    @if($post->excerpt)
                                        <p class="text-gray-700 dark:text-gray-300 mb-4 line-clamp-3">
                                            {{ $post->excerpt }}
                                        </p>
                                    @endif
                                    
                                    <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center space-x-2">
                                            @if($post->author)
                                                <div class="w-6 h-6 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center">
                                                    <i class="ti ti-user text-xs text-plume-600 dark:text-plume-400"></i>
                                                </div>
                                                <span>{{ $post->author->name }}</span>
                                            @endif
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            @if($post->published_at)
                                                <span>{{ $post->published_at->format('d/m/Y') }}</span>
                                            @endif
                                            @if($post->view_count > 0)
                                                <div class="flex items-center space-x-1">
                                                    <i class="ti ti-eye"></i>
                                                    <span>{{ $post->view_count }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($posts->hasPages())
                        <div class="mt-12">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="ti ti-file-text text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                            Nenhum post encontrado
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-8 max-w-md mx-auto">
                            Ainda não temos posts publicados no blog. Fique atento para novidades em breve!
                        </p>
                        <a href="{{ route('institutional.index') }}" class="inline-flex items-center px-6 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors">
                            Voltar ao início
                        </a>
                    </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-8">
                    <!-- Categories -->
                    @if($categories->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Categorias
                            </h3>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                    <a href="#" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <span class="text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $posts->where('category_id', $category->id)->count() }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Newsletter -->
                    <div class="bg-gradient-to-br from-plume-50 to-plume-100 dark:from-plume-900/20 dark:to-plume-800/20 rounded-xl p-6">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ti ti-mail text-white text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Newsletter
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">
                                Receba dicas de finanças pessoais diretamente no seu email
                            </p>
                            <form class="space-y-3">
                                <input 
                                    type="email" 
                                    placeholder="Seu email" 
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors"
                                >
                                <button 
                                    type="submit" 
                                    class="w-full px-4 py-2 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors"
                                >
                                    Inscrever-se
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Popular Posts -->
                    @if($posts->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Posts Populares
                            </h3>
                            <div class="space-y-4">
                                @foreach($posts->take(3) as $popularPost)
                                    <div class="flex items-start space-x-3">
                                        @if($popularPost->featured_image)
                                            <img 
                                                src="{{ $popularPost->featured_image }}" 
                                                alt="{{ $popularPost->title }}"
                                                class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                            >
                                        @else
                                            <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <i class="ti ti-file-text text-plume-600 dark:text-plume-400"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2 mb-1">
                                                <a href="{{ route('institutional.blog.show', $popularPost->slug) }}" class="hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                                                    {{ $popularPost->title }}
                                                </a>
                                            </h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $popularPost->published_at ? $popularPost->published_at->format('d/m/Y') : '' }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- CTA -->
                    <div class="bg-plume-600 dark:bg-plume-800 rounded-xl p-6 text-white text-center">
                        <h3 class="text-lg font-semibold mb-2">
                            Pronto para começar?
                        </h3>
                        <p class="text-plume-100 text-sm mb-4">
                            Junte-se a milhares de pessoas que já controlam suas finanças
                        </p>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-white text-plume-600 font-medium rounded-lg hover:bg-gray-100 transition-colors">
                            Criar conta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
