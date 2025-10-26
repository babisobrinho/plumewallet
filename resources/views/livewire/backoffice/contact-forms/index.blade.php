<x-slot name="header">
    <x-backoffice-header
        :title="__('contact.management.title')"
        :subtitle="__('contact.management.subtitle')"
    />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Contact Forms Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <x-metric-card 
                :title="__('contact.metrics.total_forms')"
                :value="number_format($totalContactForms)"
                icon="ti ti-message-circle"
                color="blue"
            />

            <x-metric-card 
                :title="__('contact.metrics.new_forms')"
                :value="number_format($newContactForms)"
                icon="ti ti-plus"
                color="green"
            />

            <x-metric-card 
                :title="__('contact.metrics.in_progress')"
                :value="number_format($inProgressContactForms)"
                icon="ti ti-clock"
                color="yellow"
            />

            <x-metric-card 
                :title="__('contact.metrics.resolved')"
                :value="number_format($resolvedContactForms)"
                icon="ti ti-check"
                color="purple"
            />
        </div>

        <!-- Contact Forms Table -->
        <div class="bg-white dark:bg-gray-900 shadow overflow-hidden rounded-lg">
            <!-- Search and Filters Bar -->
            <div class="px-6 py-4 border border-gray-200 dark:border-gray-700 rounded-t-lg">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Search -->
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ti ti-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="search"
                                wire:key="search-{{ $search }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="{{ __('contact.filters.search_placeholder') }}"
                            >
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Status Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.status"
                                wire:key="status-{{ $filters['status'] }}"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            >
                                <option value="">{{ __('contact.filters.all_status') }}</option>
                                @foreach($filterOptions[0]['options'] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subject Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.subject"
                                wire:key="subject-{{ $filters['subject'] }}"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            >
                                <option value="">{{ __('contact.filters.all_subjects') }}</option>
                                @foreach($filterOptions[1]['options'] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Language Filter -->
                        <div class="min-w-0 flex-1 sm:min-w-32">
                            <select 
                                wire:model.live="filters.language"
                                wire:key="language-{{ $filters['language'] }}"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            >
                                <option value="">{{ __('contact.filters.all_languages') }}</option>
                                @foreach($filterOptions[2]['options'] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Clear Filters -->
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
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            @foreach($tableColumns as $column)
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ $column['label'] }}
                                </th>
                            @endforeach
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('common.labels.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($data as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                @foreach($tableColumns as $column)
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        @if(isset($column['component']))
                                            @livewire($column['component'], ['item' => $item], key($item->id . '-' . $column['key']))
                                        @elseif($column['key'] === 'subject')
                                            @if($item->subject === \App\Enums\ContactFormSubject::OTHER)
                                                <x-badge 
                                                    :item="(object) ['subject' => \App\Enums\ContactFormSubject::OTHER]"
                                                    :enumClass="\App\Enums\ContactFormSubject::class"
                                                    field="subject"
                                                />
                                            @else
                                                <x-badge 
                                                    :item="$item"
                                                    :enumClass="\App\Enums\ContactFormSubject::class"
                                                    field="subject"
                                                />
                                            @endif
                                        @elseif($column['key'] === 'preferred_language')
                                            <x-badge 
                                                :item="$item"
                                                :enumClass="\App\Enums\ContactFormLanguage::class"
                                                field="preferred_language"
                                            />
                                        @elseif($column['key'] === 'status')
                                            <x-badge 
                                                :item="$item"
                                                :enumClass="\App\Enums\ContactFormStatus::class"
                                                field="status"
                                            />
                                        @elseif($column['key'] === 'created_at')
                                            {{ $item->created_at->format('d/m/Y') }}
                                        @else
                                            {{ $item->{$column['key']} }}
                                        @endif
                                    </td>
                                @endforeach
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <x-action-link 
                                        :url="route('backoffice.contact-forms.show', $item)"
                                        icon="eye"
                                        color="blue"
                                        size="sm"
                                        :title="__('common.buttons.view')"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($tableColumns) + 1 }}" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('contact.messages.no_forms') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($data->hasPages())
                <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700">
                    {{ $data->links() }}
                </div>
            @endif
        </div>
    </div>
</div>