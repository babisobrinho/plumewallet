<div class="scroll-smooth">
    <!-- Hero Section -->
    <section class="py-20 px-6" style="background-color: #2B323C;">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                {{ __('guest.blog.title') }}
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                {{ __('guest.blog.subtitle') }}
            </p>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input 
                        type="text" 
                        name="search"
                        wire:model.live="search"
                        placeholder="{{ __('guest.blog.search_placeholder') }}"
                        class="w-full px-6 py-4 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-white focus:border-transparent text-lg"
                    >
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <i class="ti ti-search text-gray-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-2/3">

                    <!-- Filters -->
                    <div class="mb-8">
                        <div class="flex flex-wrap gap-4 items-center justify-between">
                            <div class="flex flex-wrap gap-4">
                                <!-- Category Filter -->
                                <select wire:model.live="selectedCategory" class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500">
                                    <option value="">{{ __('guest.blog.all_categories') }}</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->value }}">{{ $category->getLabel() }} ({{ $categoryPostsCount[$category->value] ?? 0 }})</option>
                                    @endforeach
                                </select>

                                {{-- tag filter removed --}}

                                <!-- Sort -->
                                <select wire:model.live="sortBy" class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500">
                                    <option value="published_at">{{ __('guest.blog.latest') }}</option>
                                    {{-- most popular removed (no view_count) --}}
                                    <option value="title">{{ __('guest.blog.title_az') }}</option>
                                </select>
                            </div>

                            @if($search || $selectedCategory)
                            <button wire:click="clearFilters" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 transition-colors">
                                {{ __('guest.blog.clear_filters') }}
                            </button>
                            @endif
                        </div>
                    </div>

                    <!-- Posts Grid -->
                    <div class="mb-8">
                        @if($posts->count() > 0)
                            <div class="grid md:grid-cols-2 gap-6">
                                @foreach($posts as $post)
                                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                                    <div class="aspect-w-16 aspect-h-9">
                                        @if($post->featured_image)
                                            @if(str_contains($post->featured_image, 'placeholder'))
                                            <img 
                                                src="{{ asset($post->featured_image) }}" 
                                                alt="{{ $post->title }}"
                                                class="w-full h-48 object-cover"
                                            >
                                            @else
                                            <img 
                                                src="{{ Storage::url($post->featured_image) }}" 
                                                alt="{{ $post->title }}"
                                                class="w-full h-48 object-cover"
                                            >
                                            @endif
                                        @else
                                        <img 
                                            src="{{ asset('images/placeholders/plume-wallet-placeholder.svg') }}" 
                                            alt="Plume Wallet"
                                            class="w-full h-48 object-cover"
                                        >
                                        @endif
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $post->category->getLightBgColor() }} {{ $post->category->getLightTextColor() }}">
                                                {{ $post->category->getLabel() }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                {{ $post->published_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                            <a href="{{ route('blog.post', $post->slug) }}" class="hover:text-blue-600 transition-colors">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                            {!! $post->excerpt !!}
                                        </p>
                                        
                                        {{-- tags removed from public posts list --}}

                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                                    <i class="ti ti-user text-sm"></i>
                                                </div>
                                                <span class="text-sm text-gray-600">
                                                    {{ $post->author->name }}
                                                </span>
                                            </div>
                                            {{-- view count removed --}}
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="mt-8">
                                {{ $posts->links() }}
                            </div>
                        @else
                            <div class="text-center py-12">
                                <i class="ti ti-article text-6xl text-gray-400 mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    {{ __('guest.blog.no_articles_found') }}
                                </h3>
                                <p class="text-gray-600 mb-6">
                                    {{ __('guest.blog.no_articles_description') }}
                                </p>
                                @if($search || $selectedCategory || $selectedTag)
                                <button wire:click="clearFilters" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    {{ __('guest.blog.clear_filters') }}
                                </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">

                    <!-- Popular Posts -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            {{ __('guest.blog.popular_articles') }}
                        </h3>
                        <div class="space-y-4">
                            @foreach($popularPosts as $popularPost)
                            <div class="flex gap-3">
                                @if($popularPost->featured_image)
                                    @if(str_contains($popularPost->featured_image, 'placeholder'))
                                    <img 
                                        src="{{ asset($popularPost->featured_image) }}" 
                                        alt="{{ $popularPost->title }}"
                                        class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                    >
                                    @else
                                    <img 
                                        src="{{ Storage::url($popularPost->featured_image) }}" 
                                        alt="{{ $popularPost->title }}"
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
                                        <a href="{{ route('blog.post', $popularPost->slug) }}" class="hover:text-blue-600 transition-colors">
                                            {{ $popularPost->title }}
                                        </a>
                                    </h4>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span>{{ $popularPost->published_at->format('M d') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="rounded-xl shadow-lg p-6 mb-8" style="background-color: #2B323C;">
                        <h3 class="text-lg font-semibold text-white mb-2">
                            {{ __('guest.blog.stay_updated') }}
                        </h3>
                        <p class="text-gray-300 mb-4">
                            {{ __('guest.blog.newsletter_description') }}
                        </p>
                        <form class="space-y-3">
                            <input 
                                type="email" 
                                placeholder="{{ __('guest.blog.enter_email') }}"
                                class="w-full px-4 py-2 rounded-lg border-0 focus:ring-2 focus:ring-white focus:ring-opacity-50"
                            >
                            <button type="submit" class="w-full bg-white text-gray-800 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                                {{ __('guest.blog.subscribe') }}
                            </button>
                        </form>
                    </div>

                    <!-- Call to Action -->
                    <div class="rounded-xl shadow-lg p-6 border border-gray-100" style="background-color: #2B323C;">
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
</div>