@php
    $category = $item->category;
    $categoryValue = $category instanceof \App\Enums\FaqCategory ? $category->value : $category;
    
    $badgeClasses = match($categoryValue) {
        'general' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        'account' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'transactions' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'security' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        'billing' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'technical' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
        'features' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
        'support' => 'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
    };
    
    $categoryLabel = match($categoryValue) {
        'general' => __('enums.faq_category.general'),
        'account' => __('enums.faq_category.account'),
        'transactions' => __('enums.faq_category.transactions'),
        'security' => __('enums.faq_category.security'),
        'billing' => __('enums.faq_category.billing'),
        'technical' => __('enums.faq_category.technical'),
        'features' => __('enums.faq_category.features'),
        'support' => __('enums.faq_category.support'),
        default => ucfirst($categoryValue)
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
    {{ $categoryLabel }}
</span>
