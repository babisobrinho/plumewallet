@props([
    'title',
    'value',
    'icon',
    'color' => 'blue'
])

@php
    $colorClasses = [
        'blue' => [
            'bg' => 'bg-blue-100 dark:bg-blue-900',
            'text' => 'text-blue-600 dark:text-blue-400'
        ],
        'green' => [
            'bg' => 'bg-green-100 dark:bg-green-900',
            'text' => 'text-green-600 dark:text-green-400'
        ],
        'indigo' => [
            'bg' => 'bg-indigo-100 dark:bg-indigo-900',
            'text' => 'text-indigo-600 dark:text-indigo-400'
        ],
        'red' => [
            'bg' => 'bg-red-100 dark:bg-red-900',
            'text' => 'text-red-600 dark:text-red-400'
        ],
        'orange' => [
            'bg' => 'bg-orange-100 dark:bg-orange-900',
            'text' => 'text-orange-600 dark:text-orange-400'
        ],
        'purple' => [
            'bg' => 'bg-purple-100 dark:bg-purple-900',
            'text' => 'text-purple-600 dark:text-purple-400'
        ],
        'yellow' => [
            'bg' => 'bg-yellow-100 dark:bg-yellow-900',
            'text' => 'text-yellow-600 dark:text-yellow-400'
        ],
    ];
    
    $selectedColor = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
    <div class="p-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 {{ $selectedColor['bg'] }} rounded-lg flex items-center justify-center">
                    <i class="{{ $icon }} w-6 h-6 {{ $selectedColor['text'] }} flex items-center justify-center"></i>
                </div>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 truncate">
                    {{ $title }}
                </p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $value }}
                </p>
            </div>
        </div>
    </div>
</div>
