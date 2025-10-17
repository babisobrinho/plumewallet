<?php

return [
    'roles' => [
        'names' => [
            'owner' => 'Owner',
            'admin' => 'Administrator',
            'manager' => 'Manager',
            'contributor' => 'Contributor',
            'viewer' => 'Viewer',
        ],
        'descriptions' => [
            'owner' => 'Full administrative access including space deletion and member management.',
            'admin' => 'Full access to all features except space deletion. Can manage members and all financial data.',
            'manager' => 'Can manage all financial data (accounts, categories, payees, transactions), but cannot manage members and space settings.',
            'contributor' => 'Can view all financial data and create/update payees and transactions, but cannot delete anything or manage accounts/categories.',
            'viewer' => 'Read-only access to view all space data without making any changes.',
        ],
    ],
];
