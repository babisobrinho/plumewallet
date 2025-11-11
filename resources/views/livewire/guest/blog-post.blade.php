<div class="scroll-smooth">
    <!-- Breadcrumb -->
    <div class="py-4" style="background-color: #2B323C;">
        <div class="max-w-6xl mx-auto px-6">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('homepage.show') }}" class="text-gray-300 hover:text-white transition-colors">
                    {{ __('Home') }}
                </a>
                <i class="ti ti-chevron-right text-gray-400"></i>
                <a href="{{ route('blog.index') }}" class="text-gray-300 hover:text-white transition-colors">
                    {{ __('guest.blog.title') }}
                </a>
                <i class="ti ti-chevron-right text-gray-400"></i>
                <span class="text-white">{{ $post->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Main Content Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-2/3">
                    <article class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                        <!-- Featured Image -->
                        <div class="aspect-w-16 aspect-h-9">
                            @if($post->featured_image)
                                @if(str_contains($post->featured_image, 'placeholder'))
                                <img 
                                    src="{{ asset($post->featured_image) }}" 
                                    alt="{{ $post->title }}"
                                    class="w-full h-64 md:h-80 object-cover"
                                >
                                @else
                                <img 
                                    src="{{ Storage::url($post->featured_image) }}" 
                                    alt="{{ $post->title }}"
                                    class="w-full h-64 md:h-80 object-cover"
                                >
                                @endif
                            @else
                            <img 
                                src="{{ asset('images/placeholders/plume-wallet-placeholder.svg') }}" 
                                alt="Plume Wallet"
                                class="w-full h-64 md:h-80 object-cover"
                            >
                            @endif
                        </div>

                        <div class="p-8">
                            <!-- Category and Meta -->
                            <div class="flex items-center gap-4 mb-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $post->category->getLightBgColor() }} {{ $post->category->getLightTextColor() }}">
                                    {{ $post->category->getLabel() }}
                                </span>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <i class="ti ti-calendar"></i>
                                        <span>{{ $post->published_at->format('Y-m-d H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Title -->
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                                {{ $post->title }}
                            </h1>

                            <!-- Excerpt -->
                            @if($post->excerpt)
                            <div class="text-xl text-gray-600 mb-8 leading-relaxed">
                                {!! $post->excerpt !!}
                            </div>
                            @endif

                            <!-- Author Info -->
                            <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-200">
                                <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                    <i class="ti ti-user text-lg"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">
                                        {{ $post->author->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ __('guest.blog.published_on') }} {{ $post->published_at->format('F d, Y') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="prose prose-lg max-w-none">
                                {!! $post->content !!}
                            </div>

                            {{-- tags removed from public post view --}}

                            <!-- Share Buttons -->
                            <!-- Share Buttons -->
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    {{ __('guest.blog.share_article') }}
                                </h3>
                                <div class="flex gap-3">
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" 
                                       target="_blank" 
                                       class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                        <i class="ti ti-brand-twitter"></i>
                                        <span>{{ __('guest.blog.twitter') }}</span>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                       target="_blank" 
                                       class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                        <i class="ti ti-brand-facebook"></i>
                                        <span>{{ __('guest.blog.facebook') }}</span>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                                       target="_blank" 
                                       class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                        <i class="ti ti-brand-linkedin"></i>
                                        <span>{{ __('guest.blog.linkedin') }}</span>
                                    </a>
                                    <button onclick="navigator.clipboard.writeText('{{ request()->url() }}')" 
                                            class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                        <i class="ti ti-copy"></i>
                                        <span>{{ __('guest.blog.copy_link') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>

                    {{-- Comments feature removed from public posts --}}
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">
                    <!-- Table of Contents -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            {{ __('guest.blog.table_of_contents') }}
                        </h3>
                        <div id="toc" class="space-y-2">
                            <!-- This would be populated by JavaScript based on content headings -->
                        </div>
                    </div>

                    <!-- Related Posts -->
                    @if($relatedPosts->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            {{ __('guest.blog.related_articles') }}
                        </h3>
                        <div class="space-y-4">
                            @foreach($relatedPosts as $relatedPost)
                            <div class="flex gap-3">
                                @if($relatedPost->featured_image)
                                    @if(str_contains($relatedPost->featured_image, 'placeholder'))
                                    <img 
                                        src="{{ asset($relatedPost->featured_image) }}" 
                                        alt="{{ $relatedPost->title }}"
                                        class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                    >
                                    @else
                                    <img 
                                        src="{{ Storage::url($relatedPost->featured_image) }}" 
                                        alt="{{ $relatedPost->title }}"
                                        class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                    >
                                    @endif
                                @else
                                <img 
                                    src="{{ asset('images/placeholders/plume-wallet-placeholder.svg') }}" 
                                    alt="Plume Wallet"
                                    class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                >
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">
                                        <a href="{{ route('blog.post', $relatedPost->slug) }}" class="hover:text-blue-600 transition-colors">
                                            {{ $relatedPost->title }}
                                        </a>
                                    </h4>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span>{{ $relatedPost->published_at->format('M d') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Call to Action -->
                    <div class="rounded-xl shadow-lg p-6" style="background-color: #2B323C;">
                        <h3 class="text-lg font-semibold text-white mb-2">
                            {{ __('guest.blog.ready_to_start') }}
                        </h3>
                        <p class="text-gray-300 mb-4">
                            {{ __('guest.blog.cta_description') }}
                        </p>
                        <a href="{{ route('register') }}" class="block w-full bg-white text-gray-800 text-center py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                            {{ __('guest.blog.create_account') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Generate table of contents based on headings in the content
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.querySelector('.prose');
            if (content) {
                const headings = content.querySelectorAll('h1, h2, h3, h4, h5, h6');
                const toc = document.getElementById('toc');
                
                if (headings.length > 0) {
                    headings.forEach((heading, index) => {
                        const id = `heading-${index}`;
                        heading.id = id;
                        
                        const link = document.createElement('a');
                        link.href = `#${id}`;
                        link.textContent = heading.textContent;
                        link.className = 'block text-sm text-gray-600 hover:text-blue-600 transition-colors py-1';
                        
                        const item = document.createElement('div');
                        item.className = `ml-${(parseInt(heading.tagName.charAt(1)) - 1) * 4}`;
                        item.appendChild(link);
                        
                        toc.appendChild(item);
                    });
                } else {
                    toc.innerHTML = '<p class="text-sm text-gray-500">{{ __("guest.blog.no_headings") }}</p>';
                }
            }
        });
    </script>
    @endpush
</div>