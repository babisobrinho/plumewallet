<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex justify-center mb-6">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Antes de continuar, por favor verifique seu e-mail com o link que enviamos.') }}
                @unless (auth()->user()->hasVerifiedEmail())
                    {{ __('Se você não recebeu o e-mail, clique no botão abaixo para reenviar.') }}
                @endunless
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('Um novo link de verificação foi enviado para o e-mail cadastrado.') }}
                </div>
            @endif

            <div class="mt-6 flex flex-col space-y-4">
                @unless (auth()->user()->hasVerifiedEmail())
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-primary-button class="w-full justify-center">
                            {{ __('Reenviar E-mail de Verificação') }}
                        </x-primary-button>
                    </form>
                @endunless

                <div class="flex items-center justify-between">
                    <a href="{{ route('profile.show') }}"
                       class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                        {{ __('Editar Perfil') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                            {{ __('Sair') }}
                        </button>
                    </form>
                </div>
            </div>

            @if (auth()->user()->hasVerifiedEmail())
                <div class="mt-6">
                    <x-secondary-button onclick="window.location.href='{{ route('dashboard') }}'"
                                        class="w-full justify-center">
                        {{ __('Voltar ao Dashboard') }}
                    </x-secondary-button>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
