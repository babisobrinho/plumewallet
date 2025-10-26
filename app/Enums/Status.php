<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum Status: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    /**
     * Define styling properties for each status
     */
    public static function styles(): array
    {
        return [
            'active' => [
                'color' => 'green',
                'icon' => 'check',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'inactive' => [
                'color' => 'red',
                'icon' => 'x',
                'light_bg_color' => 'bg-red-100',
                'light_text_color' => 'text-red-800',
                'dark_bg_color' => 'dark:bg-red-900',
                'dark_text_color' => 'dark:text-red-200',
            ],
        ];
    }
}