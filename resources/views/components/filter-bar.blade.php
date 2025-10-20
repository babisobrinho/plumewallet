@props([
    'filters' => [],
    'searchPlaceholder' => 'Pesquisar...',
    'showSearch' => true,
    'showFilters' => true,
    'showSort' => true,
    'sortOptions' => []
])

<div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <div class="px-6 py-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Search -->
            @if($showSearch)
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ti ti-search w-5 h-5 text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="{{ $searchPlaceholder }}"
                        >
                    </div>
                </div>
            @endif

            <!-- Filters and Actions -->
            <div class="flex items-center gap-3">
                <!-- Filters Dropdown -->
                @if($showFilters && count($filters) > 0)
                    <div class="relative" x-data="{ open: false }">
                        <button 
                            @click="open = !open"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <i class="ti ti-filter w-4 h-4 mr-2"></i>
                            Filtros
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
                                @foreach($filters as $filter)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            {{ $filter['label'] }}
                                        </label>
                                        @if($filter['type'] === 'select')
                                            <select 
                                                wire:model.live="{{ $filter['model'] }}"
                                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:text-white"
                                            >
                                                <option value="">{{ $filter['placeholder'] ?? 'Todos' }}</option>
                                                @foreach($filter['options'] as $value => $label)
                                                    <option value="{{ $value }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        @elseif($filter['type'] === 'date')
                                            <input 
                                                type="date" 
                                                wire:model.live="{{ $filter['model'] }}"
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
                                        Limpar
                                    </button>
                                    <button 
                                        @click="open = false"
                                        class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >
                                        Aplicar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Sort Dropdown -->
                @if($showSort && count($sortOptions) > 0)
                    <div class="relative" x-data="{ open: false }">
                        <button 
                            @click="open = !open"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <i class="ti ti-arrows-up-down w-4 h-4 mr-2"></i>
                            Ordenar
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
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg z-10 border border-gray-200 dark:border-gray-600"
                        >
                            <div class="py-1">
                                @foreach($sortOptions as $option)
                                    <button 
                                        wire:click="sortBy('{{ $option['field'] }}')"
                                        @click="open = false"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600"
                                    >
                                        {{ $option['label'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>