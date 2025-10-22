<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('profile.update_password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('profile.update_password_description') }}
    </x-slot>

    <x-slot name="aside">
        <x-icon-chip
            icon='<i class="ti ti-lock h-4 w-4 text-gray-600 dark:text-gray-300"></i>'/>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-12">
            <x-label for="current_password" value="{{ __('profile.current_password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-12">
            <x-label for="password" value="{{ __('profile.new_password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-12">
            <x-label for="password_confirmation" value="{{ __('profile.confirm_password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
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
