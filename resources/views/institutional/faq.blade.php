@extends('institutional.layouts.app')

@section('title', 'Perguntas Frequentes')
@section('description', 'Encontre respostas para as perguntas mais frequentes sobre o Plume Wallet. Tire suas dúvidas sobre funcionalidades, segurança e uso da plataforma.')

@section('content')
<!-- Breadcrumb -->
<section class="py-6 px-6 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('institutional.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-plume-600 dark:hover:text-plume-400 transition-colors">
                Início
            </a>
            <i class="ti ti-chevron-right text-gray-400"></i>
            <span class="text-gray-900 dark:text-white font-medium">FAQ</span>
        </nav>
    </div>
</section>

<!-- Hero Section -->
<section class="py-16 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
            Perguntas Frequentes
        </h1>
        <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
            Encontre respostas para as dúvidas mais comuns sobre o Plume Wallet
        </p>
        
        <!-- Search Bar -->
        <div class="relative max-w-2xl mx-auto">
            <input 
                type="text" 
                id="faq-search" 
                placeholder="Talvez já tenhamos a resposta que procura..." 
                class="w-full px-6 py-4 pl-12 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-plume-500 focus:border-transparent transition-colors"
            >
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                <i class="ti ti-search text-gray-400"></i>
            </div>
        </div>
    </div>
</section>

<!-- FAQ List -->
<section class="py-16 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto">
        <div class="space-y-4" id="faq-list">
            @forelse($faqs as $index => $faq)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <button 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors rounded-lg"
                        onclick="toggleFaq({{ $index }})"
                        id="faq-button-{{ $index }}"
                    >
                        <span class="text-lg font-medium text-gray-900 dark:text-white pr-4">
                            {{ $faq->question }}
                        </span>
                        <div class="flex-shrink-0">
                            <i class="ti ti-plus text-plume-600 dark:text-plume-400 text-xl transition-transform duration-200" id="faq-icon-{{ $index }}"></i>
                        </div>
                    </button>
                    <div 
                        class="hidden px-6 pb-4" 
                        id="faq-content-{{ $index }}"
                    >
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {!! nl2br(e($faq->answer)) !!}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-help text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Nenhuma pergunta encontrada
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">
                        Ainda não temos perguntas frequentes cadastradas. Entre em contato conosco se tiver alguma dúvida.
                    </p>
                    <a href="{{ route('institutional.contact') }}" class="inline-flex items-center px-6 py-3 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors">
                        Entrar em contato
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 px-6 bg-plume-600 dark:bg-plume-800 text-white">
    <div class="max-w-4xl mx-auto text-center">
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                Ainda não conseguimos esclarecer a sua dúvida?
            </h2>
            <p class="text-plume-100 mb-6">
                Nossa equipe de suporte está pronta para ajudar você com qualquer questão
            </p>
            <a href="{{ route('institutional.contact') }}" class="inline-flex items-center px-8 py-3 bg-white text-plume-600 font-medium rounded-lg hover:bg-gray-100 transition-colors shadow-lg transform hover:scale-[1.02]">
                Entre em contato conosco
                <i class="ti ti-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Categorias de FAQ (se houver) -->
@if($faqs->where('category')->count() > 0)
<section class="py-16 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center">
            Categorias
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $categories = $faqs->pluck('category')->unique()->filter();
            @endphp
            @foreach($categories as $category)
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center hover:shadow-lg transition-shadow cursor-pointer" onclick="filterByCategory('{{ $category }}')">
                    <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-tag text-xl text-plume-600 dark:text-plume-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        {{ $category }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        {{ $faqs->where('category', $category)->count() }} perguntas
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
    // FAQ Toggle Functionality
    function toggleFaq(index) {
        const content = document.getElementById(`faq-content-${index}`);
        const icon = document.getElementById(`faq-icon-${index}`);
        
        if (content.classList.contains('hidden')) {
            // Close all other FAQs
            document.querySelectorAll('[id^="faq-content-"]').forEach(item => {
                if (!item.id.includes(index)) {
                    item.classList.add('hidden');
                }
            });
            
            // Reset all other icons
            document.querySelectorAll('[id^="faq-icon-"]').forEach(item => {
                if (!item.id.includes(index)) {
                    item.classList.remove('ti-minus');
                    item.classList.add('ti-plus');
                }
            });
            
            // Open current FAQ
            content.classList.remove('hidden');
            icon.classList.remove('ti-plus');
            icon.classList.add('ti-minus');
        } else {
            // Close current FAQ
            content.classList.add('hidden');
            icon.classList.remove('ti-minus');
            icon.classList.add('ti-plus');
        }
    }

    // Search Functionality
    document.getElementById('faq-search').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const faqItems = document.querySelectorAll('[id^="faq-button-"]');
        
        faqItems.forEach((item, index) => {
            const question = item.querySelector('span').textContent.toLowerCase();
            const faqContainer = item.closest('.bg-white, .dark\\:bg-gray-800');
            
            if (question.includes(searchTerm)) {
                faqContainer.style.display = 'block';
            } else {
                faqContainer.style.display = 'none';
            }
        });
    });

    // Filter by Category
    function filterByCategory(category) {
        const faqItems = document.querySelectorAll('[id^="faq-button-"]');
        
        faqItems.forEach((item, index) => {
            const faqContainer = item.closest('.bg-white, .dark\\:bg-gray-800');
            // This would need to be implemented with data attributes on the FAQ items
            // For now, we'll show all items
            faqContainer.style.display = 'block';
        });
    }

    // Open FAQ from URL hash
    document.addEventListener('DOMContentLoaded', function() {
        const hash = window.location.hash;
        if (hash) {
            const faqIndex = hash.replace('#faq-', '');
            if (faqIndex && !isNaN(faqIndex)) {
                setTimeout(() => {
                    toggleFaq(parseInt(faqIndex));
                }, 100);
            }
        }
    });
</script>
@endpush
