@php
    $type = $item->type;
    $typeValue = $type instanceof \App\Enums\LogType ? $type->value : $type;
    
    $badgeClasses = match($typeValue) {
        'system' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'audit' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'api' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
        'login' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
    };
    
    $typeLabel = match($typeValue) {
        'system' => __('enums.log_type.system'),
        'audit' => __('enums.log_type.audit'),
        'api' => __('enums.log_type.api'),
        'login' => __('enums.log_type.login'),
        default => ucfirst($typeValue)
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
    {{ $typeLabel }}
</span>
