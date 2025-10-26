<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum LogLevel: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case DEBUG = 'debug';
    case INFO = 'info';
    case WARNING = 'warning';
    case ERROR = 'error';
    case CRITICAL = 'critical';

    public static function styles(): array
    {
        return [
            'debug' => [
                'color' => 'gray',
                'icon' => 'bug',
                'light_bg_color' => 'bg-gray-100',
                'light_text_color' => 'text-gray-900',
                'dark_bg_color' => 'dark:bg-gray-700',
                'dark_text_color' => 'dark:text-gray-200',
            ],
            'info' => [
                'color' => 'blue',
                'icon' => 'info-circle',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-900',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-100',
            ],
            'warning' => [
                'color' => 'yellow',
                'icon' => 'alert-triangle',
                'light_bg_color' => 'bg-yellow-100',
                'light_text_color' => 'text-yellow-900',
                'dark_bg_color' => 'dark:bg-yellow-900',
                'dark_text_color' => 'dark:text-yellow-100',
            ],
            'error' => [
                'color' => 'red',
                'icon' => 'circle-x',
                'light_bg_color' => 'bg-red-100',
                'light_text_color' => 'text-red-900',
                'dark_bg_color' => 'dark:bg-red-900',
                'dark_text_color' => 'dark:text-red-100',
            ],
            'critical' => [
                'color' => 'red',
                'icon' => 'alert-circle',
                'light_bg_color' => 'bg-red-200',
                'light_text_color' => 'text-red-900',
                'dark_bg_color' => 'dark:bg-red-800',
                'dark_text_color' => 'dark:text-red-100',
            ],
        ];
    }
}
