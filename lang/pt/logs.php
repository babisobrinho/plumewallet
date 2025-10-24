<?php

return [
    'title' => 'Logs do Sistema',
    'subtitle' => 'Monitore e analise os logs do sistema',

    'metrics' => [
        'total_logs' => 'Total de Logs',
        'system_logs' => 'Logs do Sistema',
        'audit_logs' => 'Logs de Auditoria',
        'api_logs' => 'Logs da API',
        'error_logs' => 'Logs de Erro',
        'warning_logs' => 'Logs de Aviso',
        'info_logs' => 'Logs de Informação',
        'recent_logs' => 'Logs Recentes (24h)',
    ],

    'table' => [
        'type' => 'Tipo',
        'level' => 'Nível',
        'message' => 'Mensagem',
        'user' => 'Utilizador',
        'ip_address' => 'Endereço IP',
        'created_at' => 'Criado em',
    ],

    'filters' => [
        'type' => 'Tipo de Log',
        'level' => 'Nível',
        'user' => 'Utilizador',
    ],

    'form' => [
        'type' => 'Tipo',
        'level' => 'Nível',
        'message' => 'Mensagem',
        'context' => 'Contexto',
        'ip_address' => 'Endereço IP',
        'method' => 'Método',
        'url' => 'URL',
        'user_agent' => 'User Agent',
    ],

    'details' => [
        'title' => 'Detalhes do Log',
        'description' => 'Visualize informações detalhadas sobre este log',
    ],

    'messages' => [
        'deleted_successfully' => 'Log eliminado com sucesso',
    ],
];
