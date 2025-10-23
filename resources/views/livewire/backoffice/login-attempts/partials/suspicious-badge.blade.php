@php
    $isSuspicious = $item->is_suspicious;
@endphp

@if($isSuspicious)
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
        <i class="ti ti-alert-triangle w-3 h-3 mr-1"></i>
        {{ __('common.terms.yes') }}
    </span>
@else
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
        <i class="ti ti-shield-check w-3 h-3 mr-1"></i>
        {{ __('common.terms.no') }}
    </span>
@endif
