<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum PayeeStatus: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case LISTED = 'listed';
    case UNLISTED = 'unlisted';

    /**
     * Define styling properties for each payee status
     */
    public static function styles(): array
    {
        return [
            'listed' => [
                'color' => 'green',
                'icon' => 'check',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'unlisted' => [
                'color' => 'gray',
                'icon' => 'minus',
                'light_bg_color' => 'bg-gray-100',
                'light_text_color' => 'text-gray-800',
                'dark_bg_color' => 'dark:bg-gray-700',
                'dark_text_color' => 'dark:text-gray-300',
            ],
        ];
    }
}
