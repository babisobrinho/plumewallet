<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum ContactFormStatus: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case WAITING_RESPONSE = 'waiting_response';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';

    /**
     * Define styling properties for each status
     */
    public static function styles(): array
    {
        return [
            'new' => [
                'color' => 'blue',
                'icon' => 'plus',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-800',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-200',
            ],
            'in_progress' => [
                'color' => 'yellow',
                'icon' => 'clock',
                'light_bg_color' => 'bg-yellow-100',
                'light_text_color' => 'text-yellow-800',
                'dark_bg_color' => 'dark:bg-yellow-900',
                'dark_text_color' => 'dark:text-yellow-200',
            ],
            'waiting_response' => [
                'color' => 'orange',
                'icon' => 'hourglass',
                'light_bg_color' => 'bg-orange-100',
                'light_text_color' => 'text-orange-800',
                'dark_bg_color' => 'dark:bg-orange-900',
                'dark_text_color' => 'dark:text-orange-200',
            ],
            'resolved' => [
                'color' => 'green',
                'icon' => 'check',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'closed' => [
                'color' => 'gray',
                'icon' => 'x',
                'light_bg_color' => 'bg-gray-100',
                'light_text_color' => 'text-gray-800',
                'dark_bg_color' => 'dark:bg-gray-900',
                'dark_text_color' => 'dark:text-gray-200',
            ],
        ];
    }
}
