@props([
    'title',
    'items' => []
])

<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $title }}
        </h3>
    </div>
    <div class="p-6">
        <div class="space-y-4">
            @foreach($items as $item)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 {{ $item['color']['bg'] }} rounded-lg flex items-center justify-center mr-3">
                            <i class="{{ $item['icon'] }} w-4 h-4 {{ $item['color']['text'] }}"></i>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $item['label'] }}</span>
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $item['value'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
