<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum RoleType: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;
    
    case STAFF = 'staff';
    case CLIENT = 'client';

    /**
     * Define styling properties for each role type
     */
    public static function styles(): array
    {
        return [
            'staff' => [
                'color' => 'blue',
                'icon' => 'user-cog',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-800',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-200'
            ],
            'client' => [
                'color' => 'green',
                'icon' => 'user',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200'
            ]
        ];
    }
}
