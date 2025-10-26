<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum PostStatus: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    /**
     * Define styling properties for each post status
     */
    public static function styles(): array
    {
        return [
            'draft' => [
                'color' => 'gray',
                'icon' => 'edit',
                'light_bg_color' => 'bg-gray-100',
                'light_text_color' => 'text-gray-800',
                'dark_bg_color' => 'dark:bg-gray-700',
                'dark_text_color' => 'dark:text-gray-300',
            ],
            'published' => [
                'color' => 'green',
                'icon' => 'check',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'archived' => [
                'color' => 'red',
                'icon' => 'archive',
                'light_bg_color' => 'bg-red-100',
                'light_text_color' => 'text-red-800',
                'dark_bg_color' => 'dark:bg-red-900',
                'dark_text_color' => 'dark:text-red-200',
            ],
        ];
    }
}
