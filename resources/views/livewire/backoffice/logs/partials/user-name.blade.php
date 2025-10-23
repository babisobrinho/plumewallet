@php
    $user = $item->user;
    $userName = $user ? $user->name : 'Sistema';
@endphp

<span class="text-sm text-gray-900 dark:text-gray-100">
    {{ $userName }}
</span>
