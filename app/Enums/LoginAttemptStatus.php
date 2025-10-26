<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum LoginAttemptStatus: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case SUCCESS = 'success';
    case FAILED = 'failed';
    case BLOCKED = 'blocked';
    case SUSPICIOUS = 'suspicious';

    /**
     * Define styling properties for each enum case
     */
    public static function styles(): array
    {
        return [
            'success' => [
                'color' => 'green',
                'icon' => 'check',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'failed' => [
                'color' => 'red',
                'icon' => 'x',
                'light_bg_color' => 'bg-red-100',
                'light_text_color' => 'text-red-800',
                'dark_bg_color' => 'dark:bg-red-900',
                'dark_text_color' => 'dark:text-red-200',
            ],
            'blocked' => [
                'color' => 'gray',
                'icon' => 'shield-x',
                'light_bg_color' => 'bg-gray-100',
                'light_text_color' => 'text-gray-800',
                'dark_bg_color' => 'dark:bg-gray-900',
                'dark_text_color' => 'dark:text-gray-200',
            ],
            'suspicious' => [
                'color' => 'orange',
                'icon' => 'alert-triangle',
                'light_bg_color' => 'bg-orange-100',
                'light_text_color' => 'text-orange-800',
                'dark_bg_color' => 'dark:bg-orange-900',
                'dark_text_color' => 'dark:text-orange-200',
            ],
        ];
    }
}
