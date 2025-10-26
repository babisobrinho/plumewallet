<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum ContactFormLanguage: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case EN = 'en';
    case PT = 'pt';
    case FR = 'fr';

    /**
     * Define styling properties for each language
     */
    public static function styles(): array
    {
        return [
            'en' => [
                'color' => 'blue',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-800',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-200',
            ],
            'pt' => [
                'color' => 'green',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'fr' => [
                'color' => 'purple',
                'light_bg_color' => 'bg-purple-100',
                'light_text_color' => 'text-purple-800',
                'dark_bg_color' => 'dark:bg-purple-900',
                'dark_text_color' => 'dark:text-purple-200',
            ],
        ];
    }
}
