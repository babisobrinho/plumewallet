<x-slot name="header">
    <x-backoffice-header
        :title="__('profile.title')"
        :subtitle="__('profile.subtitle')"
    />
</x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-1 space-y-6">
            <div id="personal-data" class="section bg-white dark:bg-gray-900 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-800">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('profile.personal_data') }}
                    </h2>
                    @role('tester')
                    <span class="inline-flex items-center justify-center gap-1 rounded-full px-2.5 py-1 bg-amber-100 text-amber-600 dark:bg-amber-600 dark:text-amber-100">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 9v-1a3 3 0 0 1 6 0v1" /><path d="M8 9h8a6 6 0 0 1 1 3v3a5 5 0 0 1 -10 0v-3a6 6 0 0 1 1 -3" /><path d="M3 13l4 0" />
                                <path d="M17 13l4 0" /><path d="M12 20l0 -6" /><path d="M4 19l3.35 -2" /><path d="M20 19l-3.35 -2" /><path d="M4 7l3.75 2.4" /><path d="M20 7l-3.75 2.4" />
                            </svg>
                            <span class="text-xs font-semibold">
                                {{ __('profile.qa') }}
                            </span>
                        </span>
                    @endrole
                </div>
                <div class="p-6">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('shared.profile.update-profile-information-form')
                    @endif
                </div>
            </div>

            <div id="preferences" class="section bg-white dark:bg-gray-900 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-800">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('profile.preferences') }}
                    </h2>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-800">
                    <div class="p-6">
                        @livewire('shared.profile.update-language-form')
                    </div>
                    <div class="p-6">
                        @livewire('shared.profile.update-appearence-form')
                    </div>
                </div>
            </div>

            <div id="security" class="section bg-white dark:bg-gray-900 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-800">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('profile.security') }}
                    </h2>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-800">
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="p-6">
                            @livewire('shared.profile.update-password-form')
                        </div>
                    @endif

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="p-6">
                            @livewire('shared.profile.two-factor-authentication-form')
                        </div>
                    @endif

                    <div class="p-6">
                        @livewire('shared.profile.logout-other-browser-sessions-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
