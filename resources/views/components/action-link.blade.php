@props([
    'method' => '',
    'url' => '',
    'id' => null,
    'icon' => 'eye',
    'color' => 'blue',
    'size' => 'sm',
    'title' => '',
    'disabled' => false
])

@php
    $colorClasses = [
        'blue' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
        'green' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500',
        'red' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500',
        'yellow' => 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500',
        'purple' => 'bg-purple-600 hover:bg-purple-700 focus:ring-purple-500',
        'gray' => 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500',
    ];
    
    $sizeClasses = [
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-12 h-12',
    ];
    
    $iconSizes = [
        'xs' => 'w-3 h-3',
        'sm' => 'w-4 h-4',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
    ];
    
    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['sm'];
    $iconSize = $iconSizes[$size] ?? $iconSizes['sm'];
@endphp

@if($url)
    <a
        href="{{ $url }}"
        class="inline-flex items-center justify-center {{ $sizeClass }} border border-transparent text-sm font-medium rounded-full {{ $colorClass }} text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200 {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
        @if($title)
            title="{{ $title }}"
        @endif
        @if($disabled)
            onclick="return false;"
        @endif
    >
        <i class="ti ti-{{ $icon }} {{ $iconSize }}"></i>
    </a>
@else
    <button
        @if($method && $id)
            wire:click="{{ $method }}({{ $id }})"
        @endif
        class="inline-flex items-center justify-center {{ $sizeClass }} border border-transparent text-sm font-medium rounded-full {{ $colorClass }} text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200 {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
        @if($title)
            title="{{ $title }}"
        @endif
        @if($disabled)
            disabled
        @endif
    >
        <i class="ti ti-{{ $icon }} {{ $iconSize }}"></i>
    </button>
@endif
