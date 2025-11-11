<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum PostCategory: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case TECHNOLOGY = 'technology';
    case BUSINESS = 'business';
    case EDUCATION = 'education';
    case FINANCE = 'finance';
    case PRODUCTIVITY = 'productivity';

    /**
     * Define styling properties for each category
     */
    public static function styles(): array
    {
        return [
            'technology' => [
                'color' => 'blue',
                'icon' => 'device-laptop',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-800',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-200',
            ],
            'business' => [
                'color' => 'green',
                'icon' => 'building',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'education' => [
                'color' => 'indigo',
                'icon' => 'school',
                'light_bg_color' => 'bg-indigo-100',
                'light_text_color' => 'text-indigo-800',
                'dark_bg_color' => 'dark:bg-indigo-900',
                'dark_text_color' => 'dark:text-indigo-200',
            ],
            'finance' => [
                'color' => 'teal',
                'icon' => 'currency-dollar',
                'light_bg_color' => 'bg-teal-100',
                'light_text_color' => 'text-teal-800',
                'dark_bg_color' => 'dark:bg-teal-900',
                'dark_text_color' => 'dark:text-teal-200',
            ],
            'productivity' => [
                'color' => 'violet',
                'icon' => 'check',
                'light_bg_color' => 'bg-violet-100',
                'light_text_color' => 'text-violet-800',
                'dark_bg_color' => 'dark:bg-violet-900',
                'dark_text_color' => 'dark:text-violet-200',
            ],
        ];
    }
}
