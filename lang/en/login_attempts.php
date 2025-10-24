<?php

return [
    'title' => 'Login Attempts',
    'subtitle' => 'Monitor and analyze login attempts',

    'metrics' => [
        'recent_attempts' => 'Recent Attempts (24h)',
        'suspicious_attempts' => 'Suspicious Attempts',
        'blocked_attempts' => 'Blocked Attempts',
        'security_score' => 'Security Score',
    ],

    'table' => [
        'email' => 'Email',
        'ip_address' => 'IP Address',
        'status' => 'Status',
        'country' => 'Country',
        'city' => 'City',
        'suspicious' => 'Suspicious',
        'attempted_at' => 'Attempted At',
    ],

    'filters' => [
        'status' => 'Status',
        'country' => 'Country',
        'suspicious' => 'Suspicious',
    ],

    'form' => [
        'email' => 'Email',
        'ip_address' => 'IP Address',
        'status' => 'Status',
        'failure_reason' => 'Failure Reason',
        'attempted_at' => 'Attempted At',
        'country' => 'Country',
        'city' => 'City',
        'is_suspicious' => 'Is Suspicious',
        'blocked_until' => 'Blocked Until',
        'user_agent' => 'User Agent',
    ],

    'details' => [
        'title' => 'Attempt Details',
        'description' => 'View detailed information about this login attempt',
    ],

    'actions' => [
        'block_ip' => 'Block IP',
        'unblock_ip' => 'Unblock IP',
    ],

    'messages' => [
        'deleted_successfully' => 'Attempt deleted successfully',
        'ip_blocked' => 'IP blocked successfully',
        'ip_unblocked' => 'IP unblocked successfully',
    ],
];
