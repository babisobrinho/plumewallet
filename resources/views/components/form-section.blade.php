@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
        <x-slot name="aside">{{ $aside ?? '' }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="grid grid-cols-6 gap-6">
                {{ $form }}

                @if (isset($actions))
                    <div class="col-span-12">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
