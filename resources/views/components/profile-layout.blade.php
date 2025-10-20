@props(['sidebar' => true, 'type' => 'app']) {{-- type: 'app' or 'backoffice' --}}

<x-slot name="header">
    @if($type === 'app')
        <x-app-header :title="__('profile.title')" :subtitle="__('profile.subtitle')" />
    @else
        <x-backoffice-header :title="__('profile.title')" :subtitle="__('profile.subtitle')" />
    @endif
</x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        @if($sidebar)
            {{-- Sidebar --}}
            <div class="lg:w-64 flex-shrink-0">
                <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-xs border border-gray-100 dark:border-gray-700 mb-3">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-3">
                            @if(auth()->user()->profile_photo_url)
                                <div class="relative inline-block">
                                    <img class="h-20 w-20 rounded-full object-cover"
                                         src="{{ auth()->user()->profile_photo_url }}"
                                         alt="{{ auth()->user()->name ?? __('common.terms.avatar') }}">
                                    @role('tester')
                                    {{-- Tester badge --}}
                                    @endrole
                                </div>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ auth()->user()->name ?? '' }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('profile.saving_since') }} {{ auth()->user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
                {{-- Navigation menu --}}
                <div class="sticky top-8 space-y-1 p-1 bg-gray-50 dark:bg-gray-800 rounded-xl">
                    {{-- Navigation links --}}
                    {{ $navigation ?? '' }}
                </div>
            </div>
        @endif

        {{-- Main content --}}
        <div class="flex-1 space-y-6">
            {{ $slot }}
        </div>
    </div>
</div>

@if($sidebar)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Shared scroll activation script
        });
    </script>
@endif
