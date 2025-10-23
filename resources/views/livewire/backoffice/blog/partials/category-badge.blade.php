@php
    $category = $item->category;
    $categoryName = $category ? $category->name : 'Sem categoria';
    $categoryColor = $category ? $category->color : '#6B7280';
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white" style="background-color: {{ $categoryColor }}">
    {{ $categoryName }}
</span>
