<?php

return [
    'title' => 'Entre em Contato',
    'subtitle' => 'Fale com nossa equipe',
    
    'labels' => [
        'name' => 'Nome',
        'company' => 'Empresa',
        'email' => 'Email',
        'phone' => 'Telefone',
        'subject' => 'Assunto',
        'custom_subject' => 'Assunto Personalizado',
        'message' => 'Mensagem',
        'preferred_language' => 'Idioma Preferido',
        'process_number' => 'Número do Processo',
        'status' => 'Status',
        'observation' => 'Observação',
    ],
    
    'form' => [
        'name' => 'Nome',
        'company' => 'Empresa',
        'email' => 'Email',
        'phone' => 'Telefone',
        'subject' => 'Assunto',
        'custom_subject' => 'Assunto Personalizado',
        'message' => 'Mensagem',
        'preferred_language' => 'Idioma Preferido',
    ],
    
    'placeholders' => [
        'select_subject' => 'Selecione um assunto',
        'custom_subject' => 'Por favor, especifique seu assunto',
        'message' => 'Conte-nos como podemos ajudá-lo...',
        'observation' => 'Adicione sua observação...',
    ],
    
    'buttons' => [
        'submit' => 'Enviar',
        'submitting' => 'Enviando...',
        'cancel' => 'Cancelar',
        'add_observation' => 'Adicionar Observação',
        'save_observation' => 'Salvar Observação',
        'update_status' => 'Atualizar Status',
        'clear_filters' => 'Limpar Filtros',
    ],
    
    'messages' => [
        'submitted' => 'Obrigado! Sua mensagem foi enviada com sucesso. Seu número de processo é :process_number.',
        'error' => 'Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.',
        'observation_added' => 'Observação adicionada com sucesso.',
        'status_updated' => 'Status atualizado com sucesso.',
    ],
    
    'filters' => [
        'all_statuses' => 'Todos os Status',
        'all_subjects' => 'Todos os Assuntos',
        'search_placeholder' => 'Pesquisar por nome, email ou número do processo...',
    ],
    
    'table' => [
        'columns' => [
            'process_number' => 'Número do Processo',
            'name' => 'Nome',
            'email' => 'Email',
            'subject' => 'Assunto',
            'status' => 'Status',
            'created_at' => 'Data de Criação',
            'actions' => 'Ações',
        ],
        'actions' => [
            'view' => 'Visualizar',
        ],
    ],
    
    'details' => [
        'title' => 'Detalhes do Formulário de Contato',
        'subtitle' => 'Visualizar e gerenciar formulário de contato',
        'sections' => [
            'contact_info' => 'Informações de Contato',
            'message_details' => 'Detalhes da Mensagem',
            'process_info' => 'Informações do Processo',
            'observations' => 'Observações',
        ],
        'fields' => [
            'process_number' => 'Número do Processo',
            'name' => 'Nome',
            'company' => 'Empresa',
            'email' => 'Email',
            'phone' => 'Telefone',
            'subject' => 'Assunto',
            'custom_subject' => 'Assunto Personalizado',
            'message' => 'Mensagem',
            'preferred_language' => 'Idioma Preferido',
            'status' => 'Status',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Última Atualização',
        ],
    ],
    
    'modals' => [
        'add_observation' => 'Adicionar Observação',
    ],
    
    'confirmation' => [
        'title' => 'Envio do Formulário de Contato',
        'subject' => 'Obrigado! Seu envio foi confirmado - :process_number',
        'intro' => 'Olá :name, obrigado por entrar em contato conosco! Recebemos sua mensagem com sucesso e nossa equipe a analisará em breve.',
        'details_title' => 'Detalhes da Sua Mensagem',
        'process_info' => 'Informações do Processo',
        'process_details' => 'Seu número de processo é :process_number. Por favor, mantenha este número para seus registros e referencie-o em futuras comunicações.',
        'button' => 'Ir para PlumeWallet',
        'footer' => '© 2025 Plume Wallet. Todos os direitos reservados.',
    ],
    
    'notification' => [
        'title' => 'Novo Envio de Formulário de Contato',
        'intro' => 'Um novo formulário de contato foi enviado através do site.',
        'details' => 'Detalhes de Contato',
        'footer' => 'Por favor, revise e responda a este formulário de contato o mais rápido possível.',
    ],
    
    'metrics' => [
        'total_forms' => 'Total de Formulários',
        'new_forms' => 'Novos Formulários',
        'in_progress' => 'Em Andamento',
        'resolved' => 'Resolvidos',
    ],
];
