<x-slot name="header">
    <x-backoffice-header
        :title="__('faq.title')"
        :subtitle="__('faq.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- FAQ Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('faq.metrics.total_faqs')"
                :value="number_format($totalFaqs)"
                icon="ti ti-help-circle"
                color="blue"
            />

            <x-metric-card 
                :title="__('faq.metrics.active_faqs')"
                :value="number_format($activeFaqs)"
                icon="ti ti-circle-check"
                color="green"
            />

            <x-metric-card 
                :title="__('faq.metrics.inactive_faqs')"
                :value="number_format($inactiveFaqs)"
                icon="ti ti-circle-x"
                color="red"
            />

            <x-metric-card 
                :title="__('faq.metrics.total_views')"
                :value="number_format($totalViews)"
                icon="ti ti-eye"
                color="purple"
            />
        </div>

        <!-- Header com botão de criar -->
        <div class="mb-6 flex justify-end items-center">
            <button 
                wire:click="createFaq"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                <i class="ti ti-plus w-4 h-4 mr-2"></i>
                {{ __('faq.new_faq') }}
            </button>
        </div>

        <!-- FAQ Table -->
        <div class="bg-white dark:bg-gray-900 shadow overflow-hidden rounded-lg">
            <!-- Search and Filters Bar -->
            <div class="px-6 py-4 border border-gray-200 dark:border-gray-700 rounded-t-lg">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Search -->
                    <div class="flex-1 max-w-lg">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ti ti-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="search"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="{{ __('common.terms.search') }}"
                            >
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Category Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.category"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('faq.filters.all_categories') }}</option>
                                @foreach($filterOptions[0]['options'] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.status"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">{{ __('faq.filters.all_status') }}</option>
                                @foreach($filterOptions[1]['options'] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Clear Filters Button -->
                        <button 
                            wire:click="clearFilters"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('common.buttons.clear') }}
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="overflow-x-auto border border-gray-200 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700 uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('faq.table.question') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('faq.table.category') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('faq.table.order') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('faq.table.status') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('faq.table.views') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('faq.table.created_at') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($data as $faq)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900">
                                <!-- Question -->
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $faq->question }}
                                </td>
                                
                                <!-- Category -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $categoryLabels[$faq->category->value] ?? $faq->category->value }}
                                    </span>
                                </td>
                                
                                <!-- Order -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $faq->order }}
                                </td>
                                
                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($faq->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <i class="ti ti-circle-check w-3 h-3 mr-1"></i>
                                            {{ __('common.terms.yes') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            <i class="ti ti-circle-x w-3 h-3 mr-1"></i>
                                            {{ __('common.terms.no') }}
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- Views -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $faq->view_count ?? 0 }}
                                </td>
                                
                                <!-- Created At -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $faq->created_at ? \Carbon\Carbon::parse($faq->created_at)->format('d/m/Y') : '-' }}
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <x-action-button 
                                            method="editFaq"
                                            :id="$faq->id"
                                            icon="pencil"
                                            color="green"
                                            size="sm"
                                            :title="__('common.buttons.edit')"
                                        />
                                        <x-action-button 
                                            method="toggleStatus"
                                            :id="$faq->id"
                                            icon="toggle-right"
                                            color="blue"
                                            size="sm"
                                            :title="__('faq.actions.toggle_status')"
                                        />
                                        <x-action-button 
                                            method="deleteFaq"
                                            :id="$faq->id"
                                            icon="trash"
                                            color="red"
                                            size="sm"
                                            :title="__('common.buttons.delete')"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('common.messages.no_data') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-4 py-3 border-r border-l border-b border-gray-200 dark:border-gray-700 rounded-b-lg">
                {{ $data->links() }}
            </div>
        </div>

        <!-- FAQ Form Modal -->
        @if($showModal)
        <div x-data="{ show: true }" 
             x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto">
            
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 @click="$wire.closeModal()"></div>

            <!-- Modal Panel -->
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl">
                    
                    <!-- Modal Header -->
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 sm:mx-0 sm:h-10 sm:w-10">
                                @if($isEditing)
                                    <i class="ti ti-pencil w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                                @else
                                    <i class="ti ti-plus w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                                @endif
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                    @if($isEditing)
                                        {{ __('common.buttons.edit') }} {{ __('faq.faq') }}
                                    @else
                                        {{ __('faq.new_faq') }}
                                    @endif
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        @if($isEditing)
                                            {{ __('faq.form.edit_description') }}
                                        @else
                                            {{ __('faq.form.create_description') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit="saveFaq" class="px-4 pb-4 sm:px-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Category -->
                            <div>
                                <x-label for="modal_category" :value="__('faq.form.category')" />
                                <select 
                                    id="modal_category" 
                                    wire:model="modalCategory" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required
                                >
                                    @foreach($filterOptions[0]['options'] as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="modalCategory" class="mt-2" />
                            </div>

                            <!-- Order -->
                            <div>
                                <x-label for="modal_order" :value="__('faq.form.order')" />
                                <input 
                                    id="modal_order" 
                                    type="number" 
                                    min="0"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    wire:model="modalOrder" 
                                    required 
                                />
                                <x-input-error for="modalOrder" class="mt-2" />
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('faq.form.order_help') }}
                                </p>
                            </div>
                        </div>

                        <!-- Question -->
                        <div>
                            <x-label for="modal_question" :value="__('faq.form.question')" />
                            <input 
                                id="modal_question" 
                                type="text" 
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalQuestion" 
                                required 
                                autofocus 
                                placeholder="{{ __('faq.form.question_placeholder') }}"
                            />
                            <x-input-error for="modalQuestion" class="mt-2" />
                        </div>

                        <!-- Answer -->
                        <div>
                            <x-label for="modal_answer" :value="__('faq.form.answer')" />
                            <textarea 
                                id="modal_answer" 
                                rows="8"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                wire:model="modalAnswer" 
                                required 
                                placeholder="{{ __('faq.form.answer_placeholder') }}"
                            ></textarea>
                            <x-input-error for="modalAnswer" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="flex items-center">
                            <input 
                                id="modal_is_active" 
                                type="checkbox" 
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                wire:model="modalIsActive" 
                            />
                            <label for="modal_is_active" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                {{ __('faq.form.is_active') }}
                            </label>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 -mx-4 -mb-4 mt-6">
                            <button 
                                type="submit"
                                class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                @if($isEditing)
                                    <i class="ti ti-pencil w-4 h-4 mr-2"></i>
                                    {{ __('common.buttons.update') }}
                                @else
                                    <i class="ti ti-plus w-4 h-4 mr-2"></i>
                                    {{ __('faq.new_faq') }}
                                @endif
                            </button>
                            <button 
                                type="button"
                                wire:click="closeModal"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                {{ __('common.buttons.cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
        
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('filters-cleared', () => {
        // Reset all select dropdowns to their first option (default)
        const selects = document.querySelectorAll('select[wire\\:model\\.live^="filters"]');
        selects.forEach(select => {
            select.selectedIndex = 0;
        });
        
        // Clear search input field
        const searchInput = document.querySelector('input[wire\\:model\\.live\\.debounce\\.300ms="search"]');
        if (searchInput) {
            searchInput.value = '';
        }
    });
});
</script>