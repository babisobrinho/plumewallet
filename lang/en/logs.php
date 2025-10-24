<?php

return [
    'title' => 'System Logs',
    'subtitle' => 'Monitor and analyze system logs',

    'metrics' => [
        'total_logs' => 'Total Logs',
        'system_logs' => 'System Logs',
        'audit_logs' => 'Audit Logs',
        'api_logs' => 'API Logs',
        'error_logs' => 'Error Logs',
        'warning_logs' => 'Warning Logs',
        'info_logs' => 'Info Logs',
        'recent_logs' => 'Recent Logs (24h)',
    ],

    'table' => [
        'type' => 'Type',
        'level' => 'Level',
        'message' => 'Message',
        'user' => 'User',
        'ip_address' => 'IP Address',
        'created_at' => 'Created At',
    ],

    'filters' => [
        'type' => 'Log Type',
        'level' => 'Level',
        'user' => 'User',
    ],

    'form' => [
        'type' => 'Type',
        'level' => 'Level',
        'message' => 'Message',
        'context' => 'Context',
        'ip_address' => 'IP Address',
        'method' => 'Method',
        'url' => 'URL',
        'user_agent' => 'User Agent',
    ],

    'details' => [
        'title' => 'Log Details',
        'description' => 'View detailed information about this log',
    ],

    'messages' => [
        'deleted_successfully' => 'Log deleted successfully',
    ],
];
