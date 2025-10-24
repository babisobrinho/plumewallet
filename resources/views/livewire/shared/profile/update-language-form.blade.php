<x-form-section submit="updateLanguage">
    <x-slot name="title">
        {{ __('profile.language') }}
    </x-slot>

    <x-slot name="description">
        {{ __('profile.language_description') }}
    </x-slot>

    <x-slot name="aside">
        <x-icon-chip
            icon='<i class="ti ti-language h-4 w-4 text-gray-600 dark:text-gray-300"></i>'/>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-12">
            <x-label for="language" value="{{ __('profile.language') }}" />
            <x-select id="language" class="mt-1 block w-full" wire:model="state.language">
                @foreach($languageOptions as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
            <x-input-error for="language" class="mt-2" />
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



