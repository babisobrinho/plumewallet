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
    } elseif ($field === 'subject') {
        $enumValue = $item->subject;
    } elseif ($field === 'preferred_language') {
        $enumValue = $item->preferred_language;
    } elseif ($field === 'type') {
        $typeValue = $item->type;
        // Check if typeValue is already an enum instance or a string
        if ($typeValue instanceof $enumClass) {
            $enumValue = $typeValue;
        } else {
            $enumValue = $typeValue ? $enumClass::fromValue($typeValue) : null;
        }
    } elseif ($field === 'level') {
        $levelValue = $item->level;
        // Check if levelValue is already an enum instance or a string
        if ($levelValue instanceof $enumClass) {
            $enumValue = $levelValue;
        } else {
            $enumValue = $levelValue ? $enumClass::fromValue($levelValue) : null;
        }
    }
    
    // Get the label using the enum's label method
    $label = $enumValue ? $enumClass::label($enumValue) : __($noValueKey);
    
    // Get the badge classes from the enum or use default
    $badgeClasses = 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
    $icon = null;
    
    if ($enumValue) {
        // Check if the enum has styles method (new style) or getBadgeClasses method (old style)
        if (method_exists($enumClass, 'styles')) {
            $styles = $enumClass::styles()[$enumValue->value] ?? null;
            if ($styles) {
                $badgeClasses = $styles['light_bg_color'] . ' ' . $styles['light_text_color'] . ' ' . $styles['dark_bg_color'] . ' ' . $styles['dark_text_color'];
                $icon = $styles['icon'] ?? null;
            }
        } elseif (method_exists($enumValue, 'getBadgeClasses')) {
            $badgeClasses = $enumValue->getBadgeClasses();
            $icon = $enumValue->getIcon() ?? null;
        }
    }
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
    @if($icon)
        <i class="ti ti-{{ $icon }} w-3 h-3 mr-1"></i>
    @endif
    {{ $label }}
</span>
