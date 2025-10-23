@php
    $author = $item->author;
    $authorName = $author ? $author->name : 'Sem autor';
@endphp

<span class="text-sm text-gray-900 dark:text-gray-100">
    {{ $authorName }}
</span>
