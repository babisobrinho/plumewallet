<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum LogType: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case SYSTEM = 'system';
    case AUDIT = 'audit';
    case API = 'api';
    case LOGIN = 'login';

    public static function styles(): array
    {
        return [
            'system' => [
                'color' => 'blue',
                'icon' => 'server',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-900',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-100',
            ],
            'audit' => [
                'color' => 'green',
                'icon' => 'user-check',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-900',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-100',
            ],
            'api' => [
                'color' => 'purple',
                'icon' => 'api',
                'light_bg_color' => 'bg-purple-100',
                'light_text_color' => 'text-purple-900',
                'dark_bg_color' => 'dark:bg-purple-900',
                'dark_text_color' => 'dark:text-purple-100',
            ],
            'login' => [
                'color' => 'orange',
                'icon' => 'login',
                'light_bg_color' => 'bg-orange-100',
                'light_text_color' => 'text-orange-900',
                'dark_bg_color' => 'dark:bg-orange-900',
                'dark_text_color' => 'dark:text-orange-100',
            ],
        ];
    }
}
