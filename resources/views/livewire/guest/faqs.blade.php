<div class="scroll-smooth">
    <!-- Hero Section -->
    <section class="py-20 px-6 bg-gray-800">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                {{ __('guest.faqs.title') }}
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
                {{ __('guest.faqs.subtitle') }}
            </p>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="py-12 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <!-- Search Bar -->
            <div class="mb-8">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        placeholder="{{ __('guest.faqs.search_placeholder') }}"
                        class="w-full px-6 py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent text-lg"
                    >
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="ti ti-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Category Filter -->
            @if(!$search)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ __('guest.faqs.filter_by_category') }}
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($this->categories as $category)
                        <button 
                            wire:click="$set('selectedCategory', '{{ $category->value }}')"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors
                                {{ $selectedCategory === $category->value 
                                    ? 'bg-gray-800 text-white' 
                                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                        >
                            {{ __('guest.faqs.categories.' . $category->value) }}
                        </button>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- FAQs Section -->
    <section class="py-12 px-6 bg-gray-100">
        <div class="max-w-4xl mx-auto">
            @if($this->faqs->count() > 0)
                <div class="space-y-4">
                    @foreach($this->faqs as $faq)
                        <x-faq-item :faq="$faq" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6 border border-gray-200">
                        <i class="ti ti-help-circle text-gray-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ __('guest.faqs.no_results.title') }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        {{ __('guest.faqs.no_results.description') }}
                    </p>
                    <button 
                        wire:click="$set('search', '')"
                        class="bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors"
                    >
                        {{ __('guest.faqs.no_results.clear_search') }}
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 px-6 bg-gray-200">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
                {{ __('guest.faqs.contact.title') }}
            </h2>
            <p class="text-lg text-gray-600 mb-8">
                {{ __('guest.faqs.contact.description') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('how-it-works.show') }}" 
                   class="bg-gray-800 hover:bg-gray-700 text-white px-8 py-4 rounded-lg font-semibold transition-colors">
                    {{ __('guest.faqs.contact.how_it_works') }}
                </a>
                <a href="{{ route('contact.show') }}" 
                   class="bg-white hover:bg-gray-100 text-gray-800 px-8 py-4 rounded-lg font-semibold transition-colors border border-gray-300">
                    {{ __('guest.faqs.contact.contact_us') }}
                </a>
            </div>
        </div>
    </section>
</div>