<?php

return [
    'title' => 'Journaux Système',
    'subtitle' => 'Surveillez et analysez les journaux système',

    'metrics' => [
        'total_logs' => 'Total des Journaux',
        'system_logs' => 'Journaux Système',
        'audit_logs' => 'Journaux d\'Audit',
        'api_logs' => 'Journaux API',
        'error_logs' => 'Journaux d\'Erreur',
        'warning_logs' => 'Journaux d\'Avertissement',
        'info_logs' => 'Journaux d\'Information',
        'recent_logs' => 'Journaux Récents (24h)',
    ],

    'table' => [
        'type' => 'Type',
        'level' => 'Niveau',
        'message' => 'Message',
        'user' => 'Utilisateur',
        'ip_address' => 'Adresse IP',
        'created_at' => 'Créé le',
    ],

    'filters' => [
        'type' => 'Type de Journal',
        'level' => 'Niveau',
        'user' => 'Utilisateur',
    ],

    'form' => [
        'type' => 'Type',
        'level' => 'Niveau',
        'message' => 'Message',
        'context' => 'Contexte',
        'ip_address' => 'Adresse IP',
        'method' => 'Méthode',
        'url' => 'URL',
        'user_agent' => 'User Agent',
    ],

    'details' => [
        'title' => 'Détails du Journal',
        'description' => 'Visualisez les informations détaillées sur ce journal',
    ],

    'messages' => [
        'deleted_successfully' => 'Journal supprimé avec succès',
    ],
];
