<x-base-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <!-- Language selector -->
        <form method="POST" action="{{ route('language.switch') }}" class="mb-4">
            @csrf
            <input type="hidden" name="referer" value="{{ request()->fullUrl() }}" />
            <label for="locale" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('common.languages.selector_label') }}</label>
            <select id="locale" name="locale" onchange="this.form.submit()" class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm">
                @php $current = session('locale') ?? app()->getLocale(); @endphp
                <option value="en" {{ $current === 'en' ? 'selected' : '' }}>{{ __('common.languages.english') }}</option>
                <option value="pt" {{ $current === 'pt' ? 'selected' : '' }}>{{ __('common.languages.portuguese') }}</option>
                <option value="fr" {{ $current === 'fr' ? 'selected' : '' }}>{{ __('common.languages.french') }}</option>
            </select>
        </form>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('auth.login.email_label') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('auth.login.password_label') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            {{-- Forgot password link below the password input --}}
            @if (Route::has('password.request'))
                <div class="mt-2 text-sm">
                    <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline" href="{{ route('password.request') }}">
                        {{ __('auth.login.forgot_password') }}
                    </a>
                </div>
            @endif

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <div class="me-auto text-sm">
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                        {{ __('auth.login.create_account_button') }}
                    </a>
                </div>

                <x-button class="ms-4">
                    {{ __('auth.login.button') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-base-layout>
