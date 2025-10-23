@php
    $status = $item->status;
    $statusValue = $status instanceof \App\Enums\LoginAttemptStatus ? $status->value : $status;
    
    $badgeClasses = match($statusValue) {
        'success' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'failed' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        'blocked' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
        'suspicious' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
    };
    
    $statusLabel = match($statusValue) {
        'success' => __('enums.login_attempt_status.success'),
        'failed' => __('enums.login_attempt_status.failed'),
        'blocked' => __('enums.login_attempt_status.blocked'),
        'suspicious' => __('enums.login_attempt_status.suspicious'),
        default => ucfirst($statusValue)
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
    {{ $statusLabel }}
</span>
