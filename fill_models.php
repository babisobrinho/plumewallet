<?php

// Script para preencher os models do backoffice

$models = [
    'SecuritySetting' => [
        'fillable' => [
            'max_login_attempts',
            'password_expiry_days', 
            'session_timeout_minutes',
            'two_factor_required',
            'ip_whitelist',
            'brute_force_protection',
            'failed_login_lockout_minutes',
            'created_by',
            'updated_by'
        ],
        'casts' => [
            'two_factor_required' => 'boolean',
            'ip_whitelist' => 'array',
            'brute_force_protection' => 'boolean'
        ],
        'relations' => [
            'creator' => 'belongsTo(User::class, \'created_by\')',
            'updater' => 'belongsTo(User::class, \'updated_by\')'
        ]
    ],
    
    'Integration' => [
        'fillable' => [
            'name',
            'type',
            'api_key',
            'api_secret', 
            'webhook_url',
            'is_active',
            'config',
            'last_sync',
            'status',
            'error_message',
            'created_by',
            'updated_by'
        ],
        'casts' => [
            'is_active' => 'boolean',
            'config' => 'array',
            'last_sync' => 'datetime'
        ],
        'relations' => [
            'creator' => 'belongsTo(User::class, \'created_by\')',
            'updater' => 'belongsTo(User::class, \'updated_by\')'
        ]
    ],
    
    'LoginAttempt' => [
        'fillable' => [
            'user_id',
            'email',
            'ip_address',
            'user_agent',
            'success',
            'attempted_at',
            'country',
            'city'
        ],
        'casts' => [
            'success' => 'boolean',
            'attempted_at' => 'datetime'
        ],
        'relations' => [
            'user' => 'belongsTo(User::class)'
        ]
    ],
    
    'BlogCategory' => [
        'fillable' => [
            'name',
            'slug',
            'description',
            'parent_id',
            'is_active',
            'meta_title',
            'meta_description',
            'created_by',
            'updated_by'
        ],
        'casts' => [
            'is_active' => 'boolean'
        ],
        'relations' => [
            'parent' => 'belongsTo(BlogCategory::class, \'parent_id\')',
            'children' => 'hasMany(BlogCategory::class, \'parent_id\')',
            'posts' => 'hasMany(BlogPost::class)',
            'creator' => 'belongsTo(User::class, \'created_by\')',
            'updater' => 'belongsTo(User::class, \'updated_by\')'
        ]
    ],
    
    'BlogPost' => [
        'fillable' => [
            'title',
            'slug',
            'excerpt',
            'content',
            'featured_image',
            'category_id',
            'author_id',
            'status',
            'published_at',
            'meta_title',
            'meta_description',
            'tags',
            'view_count',
            'is_featured',
            'created_by',
            'updated_by'
        ],
        'casts' => [
            'tags' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime'
        ],
        'relations' => [
            'category' => 'belongsTo(BlogCategory::class)',
            'author' => 'belongsTo(User::class, \'author_id\')',
            'creator' => 'belongsTo(User::class, \'created_by\')',
            'updater' => 'belongsTo(User::class, \'updated_by\')'
        ]
    ],
    
    'Faq' => [
        'fillable' => [
            'question',
            'answer',
            'category',
            'order',
            'is_active',
            'views',
            'helpful_yes',
            'helpful_no',
            'created_by',
            'updated_by'
        ],
        'casts' => [
            'is_active' => 'boolean'
        ],
        'relations' => [
            'creator' => 'belongsTo(User::class, \'created_by\')',
            'updater' => 'belongsTo(User::class, \'updated_by\')'
        ]
    ]
];

echo "Models definidos para preenchimento manual.\n";
echo "Total de models: " . count($models) . "\n";
