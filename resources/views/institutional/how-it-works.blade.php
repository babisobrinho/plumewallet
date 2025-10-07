@extends('institutional.layouts.app')

@section('title', 'Como Funciona')
@section('description', 'Descubra como a Plume Wallet simplifica o controle financeiro pessoal. Aprenda a usar nossa plataforma em poucos passos simples.')

@section('content')
<!-- Hero Section -->
<section class="py-20 px-6 bg-gradient-to-br from-plume-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
            Como Funciona
        </h1>
        <p class="text-xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
            Descubra como a Plume Wallet torna o controle financeiro simples, rápido e eficiente
        </p>
    </div>
</section>

<!-- Processo em 3 Passos -->
<section class="py-20 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Simples em 3 passos
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                Comece a controlar suas finanças em minutos
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Passo 1 -->
            <div class="text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-user-plus text-3xl text-plume-600 dark:text-plume-400"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">1</span>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Crie sua conta</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    Registre-se gratuitamente e configure seu perfil em poucos minutos. 
                    Não precisa de cartão de crédito para começar.
                </p>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Cadastro rápido e seguro
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Verificação por email
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Configuração personalizada
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Passo 2 -->
            <div class="text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-phone text-3xl text-plume-600 dark:text-plume-400"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">2</span>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Conecte seu WhatsApp</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    Conecte seu número de WhatsApp para registrar gastos e receitas 
                    de forma super simples, direto pelo chat.
                </p>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Conexão segura e criptografada
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Registro por mensagem
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Reconhecimento automático
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Passo 3 -->
            <div class="text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 bg-plume-100 dark:bg-plume-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-chart-line text-3xl text-plume-600 dark:text-plume-400"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">3</span>
                    </div>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Acompanhe e analise</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    Visualize seus gastos em tempo real, receba relatórios detalhados 
                    e tome decisões financeiras mais inteligentes.
                </p>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Dashboard em tempo real
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Relatórios automáticos
                        </li>
                        <li class="flex items-center">
                            <i class="ti ti-check text-plume-600 dark:text-plume-400 mr-2"></i>
                            Insights personalizados
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- CTA -->
        <div class="text-center mt-16">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-plume-600 dark:bg-plume-700 text-white font-medium rounded-lg hover:bg-plume-700 dark:hover:bg-plume-600 transition-colors shadow-lg transform hover:scale-[1.02]">
                Começar agora
                <i class="ti ti-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Funcionalidades Principais -->
<section class="py-20 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Funcionalidades que fazem a diferença
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                Tudo que você precisa para controlar suas finanças
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Funcionalidade 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-message-circle text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Registro por WhatsApp</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Registre gastos e receitas enviando mensagens simples no WhatsApp. 
                    Nossa IA reconhece automaticamente os valores e categorias.
                </p>
            </div>
            
            <!-- Funcionalidade 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-dashboard text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Dashboard Inteligente</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Visualize todos os seus dados financeiros em um painel elegante e fácil de usar. 
                    Gráficos, estatísticas e insights em tempo real.
                </p>
            </div>
            
            <!-- Funcionalidade 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-category text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Categorização Automática</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Nossa inteligência artificial categoriza automaticamente seus gastos, 
                    facilitando a organização e análise dos seus hábitos financeiros.
                </p>
            </div>
            
            <!-- Funcionalidade 4 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-chart-pie text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Relatórios Detalhados</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Receba relatórios mensais, trimestrais e anuais com análises profundas 
                    dos seus padrões de gastos e oportunidades de economia.
                </p>
            </div>
            
            <!-- Funcionalidade 5 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-bell text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Alertas Inteligentes</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Receba notificações personalizadas sobre limites de gastos, 
                    metas financeiras e oportunidades de economia.
                </p>
            </div>
            
            <!-- Funcionalidade 6 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-plume-100 dark:bg-plume-900/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="ti ti-shield-check text-xl text-plume-600 dark:text-plume-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Segurança Total</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Seus dados são protegidos com criptografia de ponta a ponta. 
                    Conformidade com LGPD e padrões internacionais de segurança.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Demonstração Visual -->
<section class="py-20 px-6 bg-white dark:bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                    Veja como é simples
                </h2>
                <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">
                    Uma demonstração rápida de como registrar um gasto pelo WhatsApp
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Envie uma mensagem</h3>
                            <p class="text-gray-700 dark:text-gray-300">Digite algo como: "Gastei 25€ no supermercado"</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">IA processa automaticamente</h3>
                            <p class="text-gray-700 dark:text-gray-300">Nossa inteligência artificial extrai o valor e identifica a categoria</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-plume-600 dark:bg-plume-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-white font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Aparece no dashboard</h3>
                            <p class="text-gray-700 dark:text-gray-300">O gasto é registrado automaticamente no seu painel</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <!-- Mockup do WhatsApp -->
                <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl p-6 max-w-sm mx-auto">
                    <div class="bg-green-500 text-white p-3 rounded-t-lg text-center text-sm font-medium">
                        Plume Wallet Bot
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-b-lg">
                        <div class="space-y-3">
                            <div class="bg-gray-200 dark:bg-gray-600 p-3 rounded-lg text-sm">
                                Gastei 25€ no supermercado
                            </div>
                            <div class="bg-plume-100 dark:bg-plume-900/20 p-3 rounded-lg text-sm">
                                ✅ Registrado: 25,00€ - Alimentação<br>
                                📊 Categoria: Supermercado<br>
                                📅 Data: Hoje
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Arrow pointing to dashboard -->
                <div class="absolute -right-8 top-1/2 transform -translate-y-1/2 hidden lg:block">
                    <i class="ti ti-arrow-right text-4xl text-plume-600 dark:text-plume-400"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Rápido -->
<section class="py-20 px-6 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Perguntas Frequentes
            </h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                Respostas rápidas para as dúvidas mais comuns
            </p>
        </div>
        
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    É realmente gratuito?
                </h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Sim! O Plume Wallet é completamente gratuito para uso pessoal. 
                    Oferecemos funcionalidades premium opcionais para usuários que desejam recursos avançados.
                </p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    Meus dados estão seguros?
                </h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Absolutamente! Utilizamos criptografia de ponta a ponta e seguimos rigorosamente 
                    a LGPD. Seus dados nunca são compartilhados com terceiros.
                </p>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    Preciso instalar algum app?
                </h3>
                <p class="text-gray-700 dark:text-gray-300">
                    Não! Você pode usar o Plume Wallet diretamente no seu navegador. 
                    O WhatsApp é usado apenas para registrar transações, não precisa instalar nada adicional.
                </p>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('institutional.faq') }}" class="inline-flex items-center px-6 py-3 border-2 border-plume-600 dark:border-plume-400 text-plume-600 dark:text-plume-400 font-medium rounded-lg hover:bg-plume-600 dark:hover:bg-plume-400 hover:text-white transition-colors">
                Ver todas as perguntas
                <i class="ti ti-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 px-6 bg-plume-600 dark:bg-plume-800 text-white">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            Pronto para começar?
        </h2>
        <p class="text-xl text-plume-100 mb-8">
            Junte-se a milhares de pessoas que já transformaram sua relação com o dinheiro
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-plume-600 font-medium rounded-lg hover:bg-gray-100 transition-colors shadow-lg transform hover:scale-[1.02]">
                Criar conta gratuita
                <i class="ti ti-arrow-right ml-2"></i>
            </a>
            <a href="{{ route('institutional.contact') }}" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-plume-600 transition-colors">
                Falar com suporte
            </a>
        </div>
    </div>
</section>
@endsection
