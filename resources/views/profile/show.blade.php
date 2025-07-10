<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    <span class="">Configurações da Conta</span>
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Faça a gestão das suas informações pessoais e segurança</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Layout em Dois Painéis -->
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Painel de Navegação -->
            <div class="lg:w-64 flex-shrink-0">
                <!-- Avatar e Status -->
                <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-xs border border-gray-100 dark:border-gray-700 mb-3">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-3">
                            <div class="absolute -inset-1 rounded-full shadow"></div>
                            <img class="relative h-20 w-20 rounded-full object-cover border-4 border-white dark:border-gray-800" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}">
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                        <div class="mt-2 px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 rounded-full text-xs font-medium">
                            Plano Premium
                        </div>
                    </div>
                </div>

                <div class="sticky top-8 space-y-1 p-1 bg-gray-50 dark:bg-gray-800 rounded-xl">
                    <a href="#dados-pessoais" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link" data-section="dados-pessoais">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Dados Pessoais
                    </a>
                    <a href="#preferencias" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link" data-section="preferencias">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Preferências
                    </a>
                    <a href="#seguranca" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link" data-section="seguranca">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Segurança
                    </a>
                    <a href="#atividade" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link" data-section="atividade">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Atividade
                    </a>
                    <a href="#encerrar-conta" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-700 rounded-lg font-medium nav-link" data-section="encerrar-conta">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Encerrar Conta
                    </a>
                </div>
            </div>

            <!-- Conteúdo Principal -->
            <div class="flex-1 space-y-6">
                <!-- Seção: Informações do Perfil -->
                <div id="dados-pessoais" class="section bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            <svg class="h-5 w-5 inline-block mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Dados Pessoais
                        </h2>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            Ativo
                        </span>
                    </div>
                    <div class="p-6">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')
                        @endif
                    </div>
                </div>

                <!-- Seção: Preferências -->
                <div id="preferencias" class="section bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            <svg class="h-5 w-5 inline-block mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Preferências
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- Configuração de WhatsApp -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <h3 class="text-base font-medium text-gray-900 dark:text-white">Número de WhatsApp</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Adicione seu número para receber notificações importantes.
                                    </p>
                                </div>
                                <div class="w-1/2 sm:w-64">
                                    <input type="tel" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="(00) 00000-0000" value="(+351) 912 345 678">
                                </div>
                            </div>
                            
                            <!-- Configuração de Tema -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <h3 class="text-base font-medium text-gray-900 dark:text-white">Aparência</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Escolha entre tema claro ou escuro.
                                    </p>
                                </div>
                                <div class="w-1/2 sm:w-64">
                                    <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="light">Tema Claro</option>
                                        <option value="dark" selected>Tema Escuro</option>
                                        <option value="system">Seguir sistema</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Botão de Salvar -->
                            <div class="flex justify-end pt-4">
                                <button type="button" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition">
                                    Salvar Preferências
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seção: Segurança -->
                <div id="seguranca" class="section bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            <svg class="h-5 w-5 inline-block mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Segurança da Conta
                        </h2>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        <!-- Atualização de Senha -->
                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-base font-medium text-gray-900 dark:text-white">Alterar Senha</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Certifique-se de que sua conta esteja usando uma senha longa e aleatória para se manter seguro.
                                        </p>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <span class="h-8 w-8 bg-amber-100 dark:bg-amber-900 rounded-full flex items-center justify-center">
                                            <svg class="h-4 w-4 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    @livewire('profile.update-password-form')
                                </div>
                            </div>
                        @endif

                        <!-- Autenticação de Dois Fatores -->
                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-base font-medium text-gray-900 dark:text-white">Autenticação de Dois Fatores</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Adicione segurança adicional à sua conta usando autenticação de dois fatores.
                                        </p>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <span class="h-8 w-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                            <svg class="h-4 w-4 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    @livewire('profile.two-factor-authentication-form')
                                </div>
                            </div>
                        @endif

                        <!-- Sessões de Navegador -->
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-base font-medium text-gray-900 dark:text-white">Sessões Ativas</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Gerencie e encerre suas sessões ativas em outros navegadores e dispositivos.
                                    </p>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <span class="h-8 w-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                        <svg class="h-4 w-4 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-5">
                                @livewire('profile.logout-other-browser-sessions-form')
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seção: Atividade da Conta -->
                <div id="atividade" class="section bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            <svg class="h-5 w-5 inline-block mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Atividade Recente
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Item de Atividade -->
                            <div class="flex">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-8 w-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                        <svg class="h-4 w-4 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        Login realizado com sucesso
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Hoje às 14:32 • São Paulo, SP (IP: 189.45.210.63)
                                    </p>
                                </div>
                            </div>

                            <!-- Item de Atividade -->
                            <div class="flex">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-8 w-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <svg class="h-4 w-4 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        Senha alterada
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        2 dias atrás • Dispositivo desconhecido
                                    </p>
                                </div>
                            </div>

                            <!-- Item de Atividade -->
                            <div class="flex">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-8 w-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                        <svg class="h-4 w-4 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        Email de verificação enviado
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        1 semana atrás • email@exemplo.com
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:text-purple-500 dark:hover:text-purple-300">
                                Ver histórico completo de atividades →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Seção: Encerrar Conta -->
                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div id="encerrar-conta" class="section bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-red-100 dark:border-red-900">
                        <div class="px-6 py-5 border-b border-red-100 dark:border-red-900 bg-red-50 dark:bg-red-900 dark:bg-opacity-20">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                <svg class="h-5 w-5 inline-block mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Encerrar Conta
                            </h2>
                        </div>
                        <div class="p-6">
                            @livewire('profile.delete-user-form')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Script para ativar links conforme rolagem -->
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
</x-app-layout>