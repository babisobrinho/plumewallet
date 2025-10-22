<x-action-section>
    <x-slot name="title">
        {{ __('profile.two_factor_auth') }}
    </x-slot>

    <x-slot name="description">
        {{ __('profile.two_factor_auth_description') }}
    </x-slot>

    <x-slot name="aside">
        <x-icon-chip
            icon='<i class="ti ti-shield-check h-4 w-4 text-gray-600 dark:text-gray-300"></i>'/>
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('profile.finish_enabling') }}
                @else
                    {{ __('profile.two_factor_enabled') }}
                @endif
            @else
                {{ __('profile.two_factor_not_enabled') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p>
                {{ __('profile.two_factor_description') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('profile.scan_qr_code') }}
                        @else
                            {{ __('profile.two_factor_now_enabled') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-4 inline-block bg-white rounded-lg border">
                    <div class="text-center text-sm text-gray-600 mb-2">
                        {{ __('profile.qr_code_placeholder') }}
                    </div>
                    <div class="bg-gray-100 p-4 rounded text-center">
                        <p class="text-xs text-gray-500">{{ __('profile.qr_code_implementation') }}</p>
                    </div>
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('profile.setup_key') }}: {{ $this->enabled && $this->user->two_factor_secret ? decrypt($this->user->two_factor_secret) : 'N/A' }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('profile.code') }}" />

                        <x-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                                 wire:model="code"
                                 wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('profile.store_recovery_codes') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-900 dark:text-gray-100 rounded-lg">
                    @if ($this->enabled && $this->user->two_factor_recovery_codes)
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    @else
                        <div class="text-center text-gray-500">{{ __('profile.no_recovery_codes') }}</div>
                    @endif
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled">
                        {{ __('profile.enable') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="me-3">
                            {{ __('profile.regenerate_recovery_codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="me-3" wire:loading.attr="disabled">
                            {{ __('profile.confirm') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="me-3">
                            {{ __('profile.show_recovery_codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled">
                            {{ __('profile.cancel') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            {{ __('profile.disable') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif
            @endif
        </div>
    </x-slot>
</x-action-section>
