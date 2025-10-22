<x-form-section submit="updateWhatsapp">
    <x-slot name="title">
        {{ __('profile.whatsapp') }}
    </x-slot>

    <x-slot name="description">
        {{ __('profile.whatsapp_description') }}
    </x-slot>

    <x-slot name="aside">
        <x-icon-chip
            icon='<i class="ti ti-brand-whatsapp h-4 w-4 text-gray-600 dark:text-gray-300"></i>'/>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-12">
            <x-label for="phone_number" value="{{ __('profile.phone_number') }}" />
            <x-input id="phone_number" type="text" class="mt-1 block w-full" wire:model="state.phone_number" autocomplete="phone-number" />
            <x-input-error for="phone_number" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-inline items-center gap-2">
            <x-button>
                {{ __('common.buttons.update') }}
            </x-button>
            <x-action-message class="me-3" on="saved">
                {{ __('profile.saved') }}
            </x-action-message>
        </div>
    </x-slot>
</x-form-section>
