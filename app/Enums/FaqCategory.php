<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum FaqCategory: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case GENERAL = 'general';
    case ACCOUNT = 'account';
    case TRANSACTIONS = 'transactions';
    case SECURITY = 'security';
    case TECHNICAL = 'technical';
    case FEATURES = 'features';
    case SUPPORT = 'support';

    /**
     * Define styling properties for each FAQ category
     */
    public static function styles(): array
    {
        return [
            'general' => [
                'color' => 'gray',
                'icon' => 'help-circle',
                'light_bg_color' => 'bg-gray-100',
                'light_text_color' => 'text-gray-800',
                'dark_bg_color' => 'dark:bg-gray-700',
                'dark_text_color' => 'dark:text-gray-300',
            ],
            'account' => [
                'color' => 'blue',
                'icon' => 'user',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-800',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-200',
            ],
            'transactions' => [
                'color' => 'green',
                'icon' => 'credit-card',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'security' => [
                'color' => 'red',
                'icon' => 'shield',
                'light_bg_color' => 'bg-red-100',
                'light_text_color' => 'text-red-800',
                'dark_bg_color' => 'dark:bg-red-900',
                'dark_text_color' => 'dark:text-red-200',
            ],
            'technical' => [
                'color' => 'purple',
                'icon' => 'settings',
                'light_bg_color' => 'bg-purple-100',
                'light_text_color' => 'text-purple-800',
                'dark_bg_color' => 'dark:bg-purple-900',
                'dark_text_color' => 'dark:text-purple-200',
            ],
            'features' => [
                'color' => 'indigo',
                'icon' => 'star',
                'light_bg_color' => 'bg-indigo-100',
                'light_text_color' => 'text-indigo-800',
                'dark_bg_color' => 'dark:bg-indigo-900',
                'dark_text_color' => 'dark:text-indigo-200',
            ],
            'support' => [
                'color' => 'pink',
                'icon' => 'headphones',
                'light_bg_color' => 'bg-pink-100',
                'light_text_color' => 'text-pink-800',
                'dark_bg_color' => 'dark:bg-pink-900',
                'dark_text_color' => 'dark:text-pink-200',
            ],
        ];
    }
}
