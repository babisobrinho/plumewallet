@php
    $role = $item->roles->first();
    $roleType = $role ? $role->type : null;
    $roleName = $role ? $role->name : 'Sem role';
    
    $badgeClasses = match($roleType) {
        'staff' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'client' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
    {{ ucfirst($roleName) }}
</span>
