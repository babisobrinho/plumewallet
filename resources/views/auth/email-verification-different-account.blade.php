<x-base-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo href="{{ Auth::user() ? (Auth::user()->isStaff() ? route('backoffice.dashboard.show') : route('app.dashboard.show')) : route('welcome') }}" />
        </x-slot>

        <div class="mb-6">           
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-2">
                {{ __('auth.email_verification_issue') }}
            </h2>
        </div>

        <div class="mb-6 text-sm text-gray-600 dark:text-gray-400">
            <p class="mb-4">
                {{ __('auth.different_account_logged_in') }}
            </p>
            
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                            {{ __('auth.account_mismatch') }}
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                            <p>
                                <strong>{{ __('auth.currently_logged_in_as') }}</strong> {{ session('authenticated_user_email') }}
                            </p>
                            <p>
                                <strong>{{ __('auth.trying_to_verify_email_for') }}</strong> {{ session('verification_user_email') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="mb-4">
                {{ __('auth.to_verify_this_email') }}
            </p>
            
            <ol class="list-decimal list-inside space-y-2 text-sm">
                <li>{{ __('auth.log_out_current_account') }}</li>
                <li>{{ __('auth.log_in_matching_account') }}</li>
                <li>{{ __('auth.click_verification_link_again') }}</li>
            </ol>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <x-button type="submit" class="w-full justify-center">
                    {{ __('Log Out') }}
                </x-button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('welcome') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                {{ __('← Back to Home') }}
            </a>
        </div>
    </x-authentication-card>
</x-base-layout>
