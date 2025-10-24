<?php

return [
    'title' => 'Tentatives de connexion',
    'subtitle' => 'Surveillez et analysez les tentatives de connexion',

    'metrics' => [
        'recent_attempts' => 'Tentatives récentes (24h)',
        'suspicious_attempts' => 'Tentatives suspectes',
        'blocked_attempts' => 'Tentatives bloquées',
        'security_score' => 'Score de sécurité',
    ],

    'table' => [
        'email' => 'Email',
        'ip_address' => 'Adresse IP',
        'status' => 'Statut',
        'country' => 'Pays',
        'city' => 'Ville',
        'suspicious' => 'Suspect',
        'attempted_at' => 'Tenté le',
    ],

    'filters' => [
        'status' => 'Statut',
        'country' => 'Pays',
        'suspicious' => 'Suspect',
    ],

    'form' => [
        'email' => 'Email',
        'ip_address' => 'Adresse IP',
        'status' => 'Statut',
        'failure_reason' => 'Raison de l\'échec',
        'attempted_at' => 'Tenté le',
        'country' => 'Pays',
        'city' => 'Ville',
        'is_suspicious' => 'Est suspect',
        'blocked_until' => 'Bloqué jusqu\'au',
        'user_agent' => 'User Agent',
    ],

    'details' => [
        'title' => 'Détails de la tentative',
        'description' => 'Visualisez des informations détaillées sur cette tentative de connexion',
    ],

    'actions' => [
        'block_ip' => 'Bloquer IP',
        'unblock_ip' => 'Débloquer IP',
    ],

    'messages' => [
        'deleted_successfully' => 'Tentative supprimée avec succès',
        'ip_blocked' => 'IP bloquée avec succès',
        'ip_unblocked' => 'IP débloquée avec succès',
    ],
];
