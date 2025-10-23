@php
    $status = $item->status;
    $statusValue = $status instanceof \App\Enums\PostStatus ? $status->value : $status;
    
    $badgeClasses = match($statusValue) {
        'draft' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        'published' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'archived' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
    };
    
    $statusLabel = match($statusValue) {
        'draft' => __('enums.post_status.draft'),
        'published' => __('enums.post_status.published'),
        'archived' => __('enums.post_status.archived'),
        default => ucfirst($statusValue)
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
    {{ $statusLabel }}
</span>
