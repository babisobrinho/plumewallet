@extends('backoffice.layouts.app')

@section('title', 'Integrações')
@section('subtitle', 'Gerenciar integrações com serviços externos')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Integrações</h3>
                <a href="{{ route('backoffice.integrations.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nova Integração
                </a>
            </div>
        </div>
    </div>

    <!-- Lista de Integrações -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Integração de Pagamento -->
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Stripe</h3>
                            <p class="text-sm text-gray-500">Pagamentos</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Desconectado
                        </span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Processe pagamentos com cartão de crédito e débito de forma segura.</p>
                <div class="flex items-center justify-between">
                    <button class="text-sm text-blue-600 hover:text-blue-500">Configurar</button>
                    <div class="text-xs text-gray-500">Última sincronização: Nunca</div>
                </div>
            </div>
        </div>

        <!-- Integração de Email -->
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Mailchimp</h3>
                            <p class="text-sm text-gray-500">Email Marketing</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Desconectado
                        </span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Gerencie campanhas de email marketing e newsletters.</p>
                <div class="flex items-center justify-between">
                    <button class="text-sm text-blue-600 hover:text-blue-500">Configurar</button>
                    <div class="text-xs text-gray-500">Última sincronização: Nunca</div>
                </div>
            </div>
        </div>

        <!-- Integração de SMS -->
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Twilio</h3>
                            <p class="text-sm text-gray-500">SMS</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Desconectado
                        </span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Envie notificações por SMS para seus usuários.</p>
                <div class="flex items-center justify-between">
                    <button class="text-sm text-blue-600 hover:text-blue-500">Configurar</button>
                    <div class="text-xs text-gray-500">Última sincronização: Nunca</div>
                </div>
            </div>
        </div>

        <!-- Integração de Analytics -->
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Google Analytics</h3>
                            <p class="text-sm text-gray-500">Analytics</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Desconectado
                        </span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Monitore o tráfego e comportamento dos usuários no site.</p>
                <div class="flex items-center justify-between">
                    <button class="text-sm text-blue-600 hover:text-blue-500">Configurar</button>
                    <div class="text-xs text-gray-500">Última sincronização: Nunca</div>
                </div>
            </div>
        </div>

        <!-- Integração de Armazenamento -->
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">AWS S3</h3>
                            <p class="text-sm text-gray-500">Armazenamento</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Desconectado
                        </span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">Armazene arquivos de forma segura na nuvem.</p>
                <div class="flex items-center justify-between">
                    <button class="text-sm text-blue-600 hover:text-blue-500">Configurar</button>
                    <div class="text-xs text-gray-500">Última sincronização: Nunca</div>
                </div>
            </div>
        </div>

        <!-- Adicionar Nova Integração -->
        <div class="bg-white shadow rounded-lg border-2 border-dashed border-gray-300">
            <div class="p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nova Integração</h3>
                <p class="mt-1 text-sm text-gray-500">Adicione uma nova integração ao sistema</p>
                <div class="mt-6">
                    <a href="{{ route('backoffice.integrations.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Adicionar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
