@php
    $level = $item->level;
    $levelValue = $level instanceof \App\Enums\LogLevel ? $level->value : $level;
    
    $badgeClasses = match($levelValue) {
        'debug' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'error' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        'critical' => 'bg-red-200 text-red-900 dark:bg-red-800 dark:text-red-100',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
    };
    
    $levelLabel = match($levelValue) {
        'debug' => __('enums.log_level.debug'),
        'info' => __('enums.log_level.info'),
        'warning' => __('enums.log_level.warning'),
        'error' => __('enums.log_level.error'),
        'critical' => __('enums.log_level.critical'),
        default => ucfirst($levelValue)
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
    {{ $levelLabel }}
</span>
