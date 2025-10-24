<?php

return [
    'title' => 'Tentativas de Login',
    'subtitle' => 'Monitore e analise as tentativas de login',

    'metrics' => [
        'recent_attempts' => 'Tentativas Recentes (24h)',
        'suspicious_attempts' => 'Tentativas Suspeitas',
        'blocked_attempts' => 'Tentativas Bloqueadas',
        'security_score' => 'Pontuação de Segurança',
    ],

    'table' => [
        'email' => 'Email',
        'ip_address' => 'Endereço IP',
        'status' => 'Status',
        'country' => 'País',
        'city' => 'Cidade',
        'suspicious' => 'Suspeito',
        'attempted_at' => 'Tentado em',
    ],

    'filters' => [
        'status' => 'Status',
        'country' => 'País',
        'suspicious' => 'Suspeito',
    ],

    'form' => [
        'email' => 'Email',
        'ip_address' => 'Endereço IP',
        'status' => 'Status',
        'failure_reason' => 'Motivo da Falha',
        'attempted_at' => 'Tentado em',
        'country' => 'País',
        'city' => 'Cidade',
        'is_suspicious' => 'É Suspeito',
        'blocked_until' => 'Bloqueado até',
        'user_agent' => 'User Agent',
    ],

    'details' => [
        'title' => 'Detalhes da Tentativa',
        'description' => 'Visualize informações detalhadas sobre esta tentativa de login',
    ],

    'actions' => [
        'block_ip' => 'Bloquear IP',
        'unblock_ip' => 'Desbloquear IP',
    ],

    'messages' => [
        'deleted_successfully' => 'Tentativa eliminada com sucesso',
        'ip_blocked' => 'IP bloqueado com sucesso',
        'ip_unblocked' => 'IP desbloqueado com sucesso',
    ],
];
