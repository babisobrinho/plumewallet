<x-form-section submit="updateAppearance">
    <x-slot name="title">
        {{ __('profile.appearance') }}
    </x-slot>

    <x-slot name="description">
        {{ __('profile.appearance_description') }}
    </x-slot>

    <x-slot name="aside">
        <x-icon-chip
            icon='
                <svg class="h-4 w-4 text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336m-9 1.732a8 8 0 0 0 4.001 14.928l-.001 -16a8 8 0 0 0 -4 1.072" />
                </svg>
        '/>
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
