@props(['item', 'enumClass', 'noValueKey', 'field' => 'category'])

@php
    // Get the enum value from the item
    $enumValue = null;
    if ($field === 'category') {
        // Check if the model has getCategoryEnum method (like Post) or direct category property (like Faq)
        if (method_exists($item, 'getCategoryEnum')) {
            $enumValue = $item->getCategoryEnum();
        } else {
            $enumValue = $item->category;
        }
    } elseif ($field === 'status') {
        $enumValue = $item->status;
    } elseif ($field === 'type') {
        $enumValue = $item->type;
    } elseif ($field === 'level') {
        $enumValue = $item->level;
    }
    
    // Get the label using the enum's label method
    $label = $enumValue ? $enumClass::label($enumValue) : __($noValueKey);
    
    // Get the badge classes from the enum or use default
    $badgeClasses = $enumValue ? $enumValue->getBadgeClasses() : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
    @if($enumValue)
        <i class="ti ti-{{ $enumValue->getIcon() }} w-3 h-3 mr-1"></i>
    @endif
    {{ $label }}
</span>
