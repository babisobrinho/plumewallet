<x-form-section submit="updateAppearance">
    <x-slot name="title">
        {{ __('profile.appearance') }}
    </x-slot>

    <x-slot name="description">
        {{ __('profile.appearance_description') }}
    </x-slot>

    <x-slot name="aside">
        <x-icon-chip
            icon='<i class="ti ti-palette h-4 w-4 text-gray-600 dark:text-gray-300"></i>'/>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-12">
            <x-label for="theme" value="{{ __('profile.theme') }}" />
            <x-select id="theme" class="mt-1 block w-full" wire:model="state.theme">
                @foreach($themeOptions as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
            <x-input-error for="theme" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-inline items-center gap-2">
            <x-button>
                {{ __('common.buttons.update') }}
            </x-button>
            <x-action-message class="me-3" on="saved">
                {{ __('common.terms.saved') }}
            </x-action-message>
        </div>
    </x-slot>
</x-form-section>
