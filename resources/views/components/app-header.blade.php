@props([
    'title',
    'subtitle' => null,
    'actions' => null,
])

<div class="flex items-center justify-between">
    <div>
        @if($title)
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                {{ $title }}
            </h1>
        @endif
        @if($subtitle)
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ $subtitle }}
            </p>
        @endif
    </div>

    @if($actions)
        <div class="flex items-center space-x-2">
            {{ $actions }}
        </div>
    @endif
</div>
