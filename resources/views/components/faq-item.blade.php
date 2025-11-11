@props(['faq'])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4" x-data="{ open: false }">
    <button 
        @click="open = !open"
        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors"
    >
        <h3 class="text-lg font-semibold text-gray-900 pr-4">
            {{ $faq->question }}
        </h3>
        <div class="flex-shrink-0">
            <i class="ti ti-chevron-down transition-transform duration-200" 
               :class="{ 'rotate-180': open }"></i>
        </div>
    </button>
    
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="px-6 pb-4">
        <div class="text-gray-600 leading-relaxed">
            {!! $faq->answer !!}
        </div>
    </div>
</div>
