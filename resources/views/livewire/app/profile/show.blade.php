<x-slot name="header">
    <x-app-header
        :title="__('profile.title')"
        :subtitle="__('profile.subtitle')"
    />
</x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="lg:w-64 flex-shrink-0">
            <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-xs border border-gray-100 dark:border-gray-700 mb-3">
                <div class="flex flex-col items-center">
                    <div class="relative mb-3">
                        @if(auth()->user()->profile_photo_url)
                            <div class="relative inline-block">
                                <img
                                    class="h-20 w-20 rounded-full object-cover"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    alt="{{ auth()->user()->name ?? __('common.terms.avatar') }}"
                                >

                                @role('tester')
                                    <span class="absolute bottom-1 -right-1 h-6 w-6 flex items-center justify-center rounded-full p-0.5 bg-amber-100 text-amber-600 dark:bg-amber-600 dark:text-amber-100 shadow-md">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 9v-1a3 3 0 0 1 6 0v1" />
                                            <path d="M8 9h8a6 6 0 0 1 1 3v3a5 5 0 0 1 -10 0v-3a6 6 0 0 1 1 -3" />
                                            <path d="M3 13l4 0" />
                                            <path d="M17 13l4 0" />
                                            <path d="M12 20l0 -6" />
                                            <path d="M4 19l3.35 -2" />
                                            <path d="M20 19l-3.35 -2" />
                                            <path d="M4 7l3.75 2.4" />
                                            <path d="M20 7l-3.75 2.4" />
                                        </svg>
                                    </span>
                                @endrole
                            </div>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ auth()->user()->name ?? '' }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('profile.saving_since') }} {{ auth()->user()->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="sticky top-8 space-y-1 p-1 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <a href="#personal-data" data-section="personal-data" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link">
                    <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    {{ __('profile.personal_data') }}
                </a>
                <a href="#preferences" data-section="preferences" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link">
                    <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ __('profile.preferences') }}
                </a>
                <a href="#security" data-section="security" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link">
                    <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    {{ __('profile.security') }}
                </a>
                <a href="#close-account" data-section="close-account" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link">
                    <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    {{ __('profile.close_account') }}
                </a>
            </div>
        </div>

        <div class="flex-1 space-y-6">
            <div id="personal-data" class="section bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
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

            <div id="preferences" class="section bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('profile.preferences') }}
                    </h2>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    <div class="p-6">
                        @livewire('app.profile.update-whatsapp-form')
                    </div>
                    <div class="p-6">
                        @livewire('shared.profile.update-language-form')
                    </div>
                    <div class="p-6">
                        @livewire('shared.profile.update-appearence-form')
                    </div>
                </div>
            </div>

            <div id="security" class="section bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Segurança
                    </h2>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
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

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div id="close-account" class="section bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden border border-red-500 dark:border-red-700">
                    <div class="px-6 py-5 rounded-t-xl border-b border-red-500 dark:border-red-700 bg-red-500 dark:bg-red-700 dark:bg-opacity-20">
                        <h2 class="text-lg font-semibold text-white">
                            {{ __('profile.close_account') }}
                        </h2>
                    </div>
                    <div class="p-6">
                        @livewire('app.profile.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.section');
        const navLinks = document.querySelectorAll('.nav-link');

        function activateLink() {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (pageYOffset >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('bg-white', 'dark:bg-gray-700', 'text-purple-600', 'dark:text-purple-300');
                link.classList.add('text-gray-600', 'dark:text-gray-400');

                if (link.getAttribute('data-section') === current) {
                    link.classList.remove('text-gray-600', 'dark:text-gray-400');
                    link.classList.add('bg-white', 'dark:bg-gray-700', 'text-purple-600', 'dark:text-purple-300');
                }
            });
        }

        window.addEventListener('scroll', activateLink);
        activateLink(); // Ativar o link inicial
    });
</script>
