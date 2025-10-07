@extends('institutional.layouts.app')

@section('title', $post->title)
@section('description', $post->excerpt ?: $post->title)
@section('og_image', $post->featured_image)

@section('content')
<!-- Breadcrumb -->
<section class="py-6 px-6 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('institutional.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                Início
            </a>
            <i class="ti ti-chevron-right text-gray-400"></i>
            <a href="{{ route('institutional.blog') }}" class="text-gray-600 dark:text-gray-400 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                Blog
            </a>
            <i class="ti ti-chevron-right text-gray-400"></i>
            <span class="text-gray-900 dark:text-white font-medium">{{ $post->title }}</span>
        </nav>
    </div>
</section>

<!-- Article Header -->
<section class="py-16 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            @if($post->category)
                <div class="inline-block bg-plume-100 dark:bg-plume-900/20 text-plume-800 dark:text-plume-200 px-4 py-2 rounded-full text-sm font-medium mb-4">
                    {{ $post->category->name }}
                </div>
            @endif
            
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                {{ $post->title }}
            </h1>
            
            @if($post->excerpt)
                <p class="text-xl text-gray-700 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                    {{ $post->excerpt }}
                </p>
            @endif
            
            <div class="flex items-center justify-center space-x-6 text-gray-600 dark:text-gray-400">
                @if($post->author)
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center">
                            <i class="ti ti-user text-plume-600 dark:text-plume-400"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $post->author->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Autor</p>
                        </div>
                    </div>
                @endif
                
                @if($post->published_at)
                    <div class="flex items-center space-x-2">
                        <i class="ti ti-calendar"></i>
                        <span class="text-sm">{{ $post->published_at->format('d \d\e F \d\e Y') }}</span>
                    </div>
                @endif
                
                @if($post->view_count > 0)
                    <div class="flex items-center space-x-2">
                        <i class="ti ti-eye"></i>
                        <span class="text-sm">{{ $post->view_count }} visualizações</span>
                    </div>
                @endif
                
                @if($post->tags && count($post->tags) > 0)
                    <div class="flex items-center space-x-2">
                        <i class="ti ti-tag"></i>
                        <span class="text-sm">{{ count($post->tags) }} tags</span>
                    </div>
                @endif
            </div>
        </div>
        
        @if($post->featured_image)
            <div class="mb-8">
                <img 
                    src="{{ $post->featured_image }}" 
                    alt="{{ $post->title }}"
                    class="w-full h-64 md:h-96 object-cover rounded-2xl shadow-lg"
                >
            </div>
        @endif
    </div>
</section>

<!-- Article Content -->
<section class="py-16 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <article class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-12 shadow-sm">
                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        {!! $post->content !!}
                    </div>
                    
                    <!-- Tags -->
                    @if($post->tags && count($post->tags) > 0)
                        <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Tags:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($post->tags as $tag)
                                    <span class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-full text-sm">
                                        #{{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Share Buttons -->
                    <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Compartilhar:</h4>
                        <div class="flex items-center space-x-4">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="flex items-center space-x-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                <i class="ti ti-brand-twitter"></i>
                                <span class="text-sm">Twitter</span>
                            </a>
                            
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="ti ti-brand-facebook"></i>
                                <span class="text-sm">Facebook</span>
                            </a>
                            
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                               target="_blank" 
                               class="flex items-center space-x-2 px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
                                <i class="ti ti-brand-linkedin"></i>
                                <span class="text-sm">LinkedIn</span>
                            </a>
                            
                            <button onclick="copyToClipboard('{{ request()->url() }}')" 
                                    class="flex items-center space-x-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                <i class="ti ti-link"></i>
                                <span class="text-sm">Copiar link</span>
                            </button>
                        </div>
                    </div>
                </article>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-8">
                    <!-- Table of Contents (if needed) -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            Índice
                        </h3>
                        <div id="table-of-contents" class="space-y-2">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    
                    <!-- Author Info -->
                    @if($post->author)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="ti ti-user text-2xl text-plume-600 dark:text-plume-400"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    {{ $post->author->name }}
                                </h3>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">
                                    Autor do artigo
                                </p>
                                <div class="flex justify-center space-x-3">
                                    <a href="#" class="text-gray-400 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                                        <i class="ti ti-brand-twitter text-lg"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                                        <i class="ti ti-brand-linkedin text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Related Posts -->
                    @if($relatedPosts->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Posts Relacionados
                            </h3>
                            <div class="space-y-4">
                                @foreach($relatedPosts as $relatedPost)
                                    <div class="flex items-start space-x-3">
                                        @if($relatedPost->featured_image)
                                            <img 
                                                src="{{ $relatedPost->featured_image }}" 
                                                alt="{{ $relatedPost->title }}"
                                                class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                            >
                                        @else
                                            <div class="w-16 h-16 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <i class="ti ti-file-text text-plume-600 dark:text-plume-400"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2 mb-1">
                                                <a href="{{ route('institutional.blog.show', $relatedPost->slug) }}" class="hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                                                    {{ $relatedPost->title }}
                                                </a>
                                            </h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $relatedPost->published_at ? $relatedPost->published_at->format('d/m/Y') : '' }}
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
                            Gostou do artigo?
                        </h3>
                        <p class="text-plume-100 text-sm mb-4">
                            Comece a aplicar essas dicas no Plume Wallet
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

<!-- Navigation -->
<section class="py-16 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between">
            <a href="{{ route('institutional.blog') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="ti ti-arrow-left mr-2"></i>
                Voltar ao blog
            </a>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('institutional.contact') }}" class="inline-flex items-center px-6 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors">
                    Contato
                    <i class="ti ti-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .prose {
        color: #374151;
    }
    
    .dark .prose {
        color: #d1d5db;
    }
    
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        color: #111827;
        font-weight: 600;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .dark .prose h1, .dark .prose h2, .dark .prose h3, .dark .prose h4, .dark .prose h5, .dark .prose h6 {
        color: #f9fafb;
    }
    
    .prose p {
        margin-bottom: 1.5rem;
        line-height: 1.7;
    }
    
    .prose ul, .prose ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .prose li {
        margin-bottom: 0.5rem;
    }
    
    .prose blockquote {
        border-left: 4px solid #14b8a6;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        background-color: #f0fdfa;
        padding: 1rem;
        border-radius: 0.5rem;
    }
    
    .dark .prose blockquote {
        background-color: #134e4a;
        border-left-color: #2dd4bf;
    }
    
    .prose code {
        background-color: #f3f4f6;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875em;
    }
    
    .dark .prose code {
        background-color: #374151;
    }
    
    .prose pre {
        background-color: #1f2937;
        color: #f9fafb;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1.5rem 0;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    // Copy to clipboard functionality
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="ti ti-check"></i><span class="text-sm ml-2">Copiado!</span>';
            button.classList.remove('bg-gray-500', 'hover:bg-gray-600');
            button.classList.add('bg-green-500', 'hover:bg-green-600');
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove('bg-green-500', 'hover:bg-green-600');
                button.classList.add('bg-gray-500', 'hover:bg-gray-600');
            }, 2000);
        });
    }
    
    // Generate table of contents
    document.addEventListener('DOMContentLoaded', function() {
        const headings = document.querySelectorAll('.prose h2, .prose h3, .prose h4');
        const tocContainer = document.getElementById('table-of-contents');
        
        if (headings.length > 0 && tocContainer) {
            headings.forEach((heading, index) => {
                // Add ID to heading if it doesn't have one
                if (!heading.id) {
                    heading.id = `heading-${index}`;
                }
                
                // Create TOC item
                const tocItem = document.createElement('a');
                tocItem.href = `#${heading.id}`;
                tocItem.className = 'block text-sm text-gray-600 dark:text-gray-400 hover:text-plume-600 dark:hover:text-plume-400 transition-colors py-1';
                tocItem.style.paddingLeft = `${(parseInt(heading.tagName.charAt(1)) - 2) * 0.5}rem`;
                tocItem.textContent = heading.textContent;
                
                tocContainer.appendChild(tocItem);
            });
        } else if (tocContainer) {
            tocContainer.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400">Nenhum índice disponível</p>';
        }
    });
</script>
@endpush
