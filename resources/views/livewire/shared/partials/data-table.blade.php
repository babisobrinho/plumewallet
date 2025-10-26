<div>
    <!-- Filter Bar -->
    <div class="shadow-sm rounded-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <!-- Search -->
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ti ti-search w-5 h-5 text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="{{ __('common.search.placeholder') }}"
                        >
                    </div>
                </div>

                <!-- Filters and Actions -->
                <div class="flex items-center gap-3">
                    <!-- Filters Dropdown -->
                    @if(count($filterOptions) > 0)
                        <div class="relative" x-data="{ open: false }">
                            <button 
                                @click="open = !open"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <i class="ti ti-filter w-4 h-4 mr-2"></i>
                                {{ __('common.buttons.filters') }}
                                <i class="ti ti-chevron-down w-4 h-4 ml-2"></i>
                            </button>

                            <div 
                                x-show="open" 
                                @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-700 rounded-md shadow-lg z-10 border border-gray-200 dark:border-gray-600"
                            >
                                <div class="p-4 space-y-4">
                                    @foreach($filterOptions as $filter)
                                        <div wire:key="filter-{{ $filter['key'] }}">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                {{ $filter['label'] }}
                                            </label>
                                            @if($filter['type'] === 'select')
                                                <select 
                                                    wire:model.live.debounce.300ms="filter{{ ucfirst($filter['key']) }}"
                                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:text-white"
                                                >
                                                    <option value="">{{ $filter['placeholder'] ?? __('common.terms.all') }}</option>
                                                    @foreach($filter['options'] as $value => $label)
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            @elseif($filter['type'] === 'date')
                                                <input 
                                                    type="date" 
                                                    wire:model.live="filters.{{ $filter['key'] }}"
                                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:text-white"
                                                >
                                            @endif
                                        </div>
                                    @endforeach
                                    
                                    <div class="flex justify-end gap-2 pt-2 border-t border-gray-200 dark:border-gray-600">
                                        <button 
                                            wire:click="clearFilters"
                                            class="px-3 py-1 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200"
                                        >
                                            {{ __('common.buttons.clear') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="shadow-sm border border-gray-200 dark:border-gray-700 rounded-lg mt-4" style="overflow: visible;">
        <!-- Table -->
        <div class="table-responsive" x-data="{ 
            hasOverflow: false,
            checkOverflow() {
                const container = $el;
                const table = container.querySelector('table');
                if (table) {
                    const needsScroll = container.scrollWidth > container.clientWidth;
                    this.hasOverflow = needsScroll;
                    if (needsScroll) {
                        container.classList.add('has-overflow');
                    } else {
                        container.classList.remove('has-overflow');
                    }
                }
            }
        }" x-init="
            $nextTick(() => {
                checkOverflow();
                // Re-check on window resize
                window.addEventListener('resize', checkOverflow);
            })
        " @resize.window="checkOverflow()">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        @foreach($tableColumns as $column)
                            @if(isset($column['sortable']) && $column['sortable'])
                                <th 
                                    scope="col" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider {{ $column['class'] ?? '' }}"
                                >
                                    <button 
                                        wire:click="sortColumn('{{ $column['key'] }}')"
                                        type="button"
                                        class="w-full text-left group inline-flex items-center hover:text-gray-700 dark:hover:text-gray-200 cursor-pointer"
                                    >
                                        {{ $column['label'] }}
                                        @if($sortBy === $column['key'])
                                            <i class="ti ti-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} w-4 h-4 ml-1"></i>
                                        @else
                                            <i class="ti ti-arrows-up-down w-4 h-4 ml-1 opacity-0 group-hover:opacity-100"></i>
                                        @endif
                                    </button>
                                </th>
                            @else
                                <th 
                                    scope="col" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider {{ $column['class'] ?? '' }}"
                                >
                                    {{ $column['label'] }}
                                </th>
                            @endif
                        @endforeach
                        
                        @if(count($tableActions) > 0)
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 tracking-wider">
                                {{ __('common.table.actions') }}
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($data as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            @foreach($tableColumns as $column)
                                <td class="px-6 py-4 text-sm {{ $column['cellClass'] ?? 'text-gray-900 dark:text-gray-100' }} {{ isset($column['ellipsis']) && $column['ellipsis'] ? 'title-cell' : (isset($column['key']) && $column['key'] === 'title' ? 'title-cell' : 'whitespace-nowrap') }}">
                                    @if(isset($column['component']))
                                        @php
                                            $componentParams = array_merge(
                                                ['item' => $item, 'field' => $column['key'] ?? null],
                                                $column['componentParams'] ?? []
                                            );
                                        @endphp
                                        @include($column['component'], $componentParams)
                                    @elseif(isset($column['key']) && $column['key'] === 'title' && isset($item[$column['key']]))
                                        <div class="title-cell" title="{{ $item[$column['key']] }}">
                                            {{ $item[$column['key']] }}
                                        </div>
                                    @elseif(isset($column['format']))
                                        @switch($column['format'])
                                            @case('date')
                                                {{ $item[$column['key']] ? \Carbon\Carbon::parse($item[$column['key']])->format('d/m/Y') : '-' }}
                                                @break
                                            @case('datetime')
                                                {{ $item[$column['key']] ? \Carbon\Carbon::parse($item[$column['key']])->format('d/m/Y H:i') : '-' }}
                                                @break
                                            @case('currency')
                                                {{ $item[$column['key']] ? '€ ' . number_format($item[$column['key']], 2, ',', '.') : '€ 0,00' }}
                                                @break
                                            @case('boolean')
                                                @if($item[$column['key']])
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
                                                @break
                                            @case('truncate')
                                                @php
                                                    $maxLength = $column['maxLength'] ?? 50;
                                                    $text = $item[$column['key']] ?? '';
                                                    $truncated = strlen($text) > $maxLength ? substr($text, 0, $maxLength) . '...' : $text;
                                                @endphp
                                                <span title="{{ $text }}" class="cursor-help">
                                                    {{ $truncated }}
                                                </span>
                                                @break
                                            @case('status')
                                                @php
                                                    $status = $item[$column['key']];
                                                    $statusConfig = $column['statusConfig'][$status] ?? ['class' => 'bg-gray-100 text-gray-800', 'label' => $status];
                                                @endphp
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusConfig['class'] }}">
                                                    {{ $statusConfig['label'] }}
                                                </span>
                                                @break
                                            @default
                                                {{ $item[$column['key']] ?? '-' }}
                                        @endswitch
                                    @else
                                        {{ $item[$column['key']] ?? '-' }}
                                    @endif
                                </td>
                            @endforeach
                            
                            @if(count($tableActions) > 0)
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium actions-cell">
                                    <div class="flex items-center justify-end space-x-2">
                                        @foreach($tableActions as $action)
                                            @if($action['type'] === 'button')
                                                <button
                                                    wire:click="{{ $this->getGenericMethod($action['method']) }}({{ $item['id'] }})"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md {{ $action['class'] }} focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $action['focusClass'] ?? 'focus:ring-blue-500' }}"
                                                >
                                                    @if(isset($action['icon']))
                                                        <i class="ti ti-{{ $action['icon'] }} w-4 h-4 mr-1"></i>
                                                    @endif
                                                    {{ $action['label'] }}
                                                </button>
                                            @elseif($action['type'] === 'dropdown')
                                                <div class="relative" x-data="{ open: false }">
                                                    <button 
                                                        @click="open = !open"
                                                        class="inline-flex items-center p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    >
                                                        <i class="ti ti-settings w-4 h-4"></i>
                                                    </button>
                                                    
                                                    <div 
                                                        x-show="open" 
                                                        @click.away="open = false"
                                                        x-transition:enter="transition ease-out duration-100"
                                                        x-transition:enter-start="transform opacity-0 scale-95"
                                                        x-transition:enter-end="transform opacity-100 scale-100"
                                                        x-transition:leave="transition ease-in duration-75"
                                                        x-transition:leave-start="transform opacity-100 scale-100"
                                                        x-transition:leave-end="transform opacity-0 scale-95"
                                                        class="absolute right-0 mt-2 bg-white dark:bg-gray-700 rounded-md shadow-lg z-50 border border-gray-200 dark:border-gray-600"
                                                        style="min-width: 12rem; max-width: calc(100vw - 2rem); position: absolute !important; white-space: nowrap;"
                                                        x-init="
                                                            $nextTick(() => {
                                                                const rect = $el.getBoundingClientRect();
                                                                const viewportWidth = window.innerWidth;
                                                                const viewportHeight = window.innerHeight;
                                                                
                                                                // Adjust horizontal position if needed
                                                                if (rect.right > viewportWidth - 10) {
                                                                    $el.style.right = 'auto';
                                                                    $el.style.left = '0';
                                                                }
                                                                
                                                                // Adjust vertical position if needed
                                                                if (rect.bottom > viewportHeight - 10) {
                                                                    $el.style.top = 'auto';
                                                                    $el.style.bottom = '100%';
                                                                    $el.style.marginBottom = '0.5rem';
                                                                    $el.style.marginTop = '0';
                                                                }
                                                            })
                                                        "
                                                    >
                                                        <div class="py-1">
                                                            @foreach($action['items'] as $itemAction)
                                                                @if(isset($itemAction['dynamic']) && $itemAction['dynamic'])
                                                                    {{-- Dynamic action based on item properties --}}
                                                                    @if($itemAction['method'] === 'toggleFeatured')
                                                                        <button 
                                                                            wire:click="{{ $this->getGenericMethod($itemAction['method']) }}({{ $item['id'] }})"
                                                                            @click="open = false"
                                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 whitespace-nowrap"
                                                                        >
                                                                            @if($item['is_featured'])
                                                                                <i class="ti ti-star-filled w-4 h-4 mr-2 inline text-yellow-500"></i>
                                                                                {{ __('blog.actions.remove_from_highlights') }}
                                                                            @else
                                                                                <i class="ti ti-star w-4 h-4 mr-2 inline"></i>
                                                                                {{ __('blog.actions.highlight') }}
                                                                            @endif
                                                                        </button>
                                                                    @else
                                                                        {{-- Fallback for other dynamic actions --}}
                                                                        <button 
                                                                            wire:click="{{ $this->getGenericMethod($itemAction['method']) }}({{ $item['id'] }})"
                                                                            @click="open = false"
                                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 whitespace-nowrap"
                                                                        >
                                                                            @if(isset($itemAction['icon']))
                                                                                <i class="ti ti-{{ $itemAction['icon'] }} w-4 h-4 mr-2 inline"></i>
                                                                            @endif
                                                                            {{ $itemAction['label'] }}
                                                                        </button>
                                                                    @endif
                                                                @else
                                                                    {{-- Static action --}}
                                                                    <button 
                                                                        wire:click="{{ $this->getGenericMethod($itemAction['method']) }}({{ $item['id'] }})"
                                                                        @click="open = false"
                                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 whitespace-nowrap"
                                                                    >
                                                                        @if(isset($itemAction['icon']))
                                                                            <i class="ti ti-{{ $itemAction['icon'] }} w-4 h-4 mr-2 inline"></i>
                                                                        @endif
                                                                        {{ $itemAction['label'] }}
                                                                    </button>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($tableColumns) + (count($tableActions) > 0 ? 1 : 0) }}" class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center">
                                    <i class="ti ti-file-text w-12 h-12 text-gray-400 mb-4"></i>
                                    <p class="text-lg font-medium">{{ __('common.table.no_data') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($data->hasPages())
            <div class="bg-white dark:bg-gray-900 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                {{ $data->links('pagination.custom') }}
            </div>
        @endif
    </div>
</div>