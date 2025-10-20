@props([
    'columns' => [],
    'data' => [],
    'actions' => [],
    'emptyMessage' => 'Nenhum registro encontrado',
    'showPagination' => true,
    'perPage' => 15
])

<div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    @foreach($columns as $column)
                        <th 
                            scope="col" 
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider {{ $column['class'] ?? '' }}"
                        >
                            @if(isset($column['sortable']) && $column['sortable'])
                                <button 
                                    wire:click="sortBy('{{ $column['key'] }}')"
                                    class="group inline-flex items-center hover:text-gray-700 dark:hover:text-gray-200"
                                >
                                    {{ $column['label'] }}
                                    <x-icon 
                                        name="arrow-up-down" 
                                        class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100" 
                                    />
                                </button>
                            @else
                                {{ $column['label'] }}
                            @endif
                        </th>
                    @endforeach
                    
                    @if(count($actions) > 0)
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Ações
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($data as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        @foreach($columns as $column)
                            <td class="px-6 py-4 whitespace-nowrap text-sm {{ $column['cellClass'] ?? 'text-gray-900 dark:text-gray-100' }}">
                                @if(isset($column['component']))
                                    @include($column['component'], ['item' => $item])
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
                                                    <x-icon name="check-circle" class="w-3 h-3 mr-1" />
                                                    Sim
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                    <x-icon name="x-circle" class="w-3 h-3 mr-1" />
                                                    Não
                                                </span>
                                            @endif
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
                        
                        @if(count($actions) > 0)
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    @foreach($actions as $action)
                                        @if(isset($action['condition']) && !$action['condition']($item))
                                            @continue
                                        @endif
                                        
                                        @if($action['type'] === 'button')
                                            <button 
                                                wire:click="{{ $action['method'] }}({{ $item['id'] }})"
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md {{ $action['class'] }} focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $action['focusClass'] ?? 'focus:ring-blue-500' }}"
                                            >
                                                @if(isset($action['icon']))
                                                    <x-icon name="{{ $action['icon'] }}" class="w-4 h-4 mr-1" />
                                                @endif
                                                {{ $action['label'] }}
                                            </button>
                                        @elseif($action['type'] === 'dropdown')
                                            <div class="relative" x-data="{ open: false }">
                                                <button 
                                                    @click="open = !open"
                                                    class="inline-flex items-center p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                >
                                                    <x-icon name="cog-6-tooth" class="w-4 h-4" />
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
                                                        @foreach($action['items'] as $itemAction)
                                                            <button 
                                                                wire:click="{{ $itemAction['method'] }}({{ $item['id'] }})"
                                                                @click="open = false"
                                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600"
                                                            >
                                                                @if(isset($itemAction['icon']))
                                                                    <x-icon name="{{ $itemAction['icon'] }}" class="w-4 h-4 mr-2 inline" />
                                                                @endif
                                                                {{ $itemAction['label'] }}
                                                            </button>
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
                        <td colspan="{{ count($columns) + (count($actions) > 0 ? 1 : 0) }}" class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center">
                                <x-icon name="document-text" class="w-12 h-12 text-gray-400 mb-4" />
                                <p class="text-lg font-medium">{{ $emptyMessage }}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($showPagination && $data->hasPages())
        <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
            {{ $data->links() }}
        </div>
    @endif
</div>
