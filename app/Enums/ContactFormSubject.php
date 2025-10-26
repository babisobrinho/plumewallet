<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum ContactFormSubject: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case GENERAL_INQUIRY = 'general_inquiry';
    case TECHNICAL_SUPPORT = 'technical_support';
    case BILLING_QUESTION = 'billing_question';
    case FEATURE_REQUEST = 'feature_request';
    case BUG_REPORT = 'bug_report';
    case ACCOUNT_ISSUE = 'account_issue';
    case PARTNERSHIP = 'partnership';
    case OTHER = 'other';

    /**
     * Define styling properties for each subject
     */
    public static function styles(): array
    {
        return [
            'general_inquiry' => [
                'color' => 'blue',
                'icon' => 'message-circle',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-800',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-200',
            ],
            'technical_support' => [
                'color' => 'green',
                'icon' => 'tool',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'billing_question' => [
                'color' => 'yellow',
                'icon' => 'credit-card',
                'light_bg_color' => 'bg-yellow-100',
                'light_text_color' => 'text-yellow-800',
                'dark_bg_color' => 'dark:bg-yellow-900',
                'dark_text_color' => 'dark:text-yellow-200',
            ],
            'feature_request' => [
                'color' => 'purple',
                'icon' => 'bulb',
                'light_bg_color' => 'bg-purple-100',
                'light_text_color' => 'text-purple-800',
                'dark_bg_color' => 'dark:bg-purple-900',
                'dark_text_color' => 'dark:text-purple-200',
            ],
            'bug_report' => [
                'color' => 'red',
                'icon' => 'bug',
                'light_bg_color' => 'bg-red-100',
                'light_text_color' => 'text-red-800',
                'dark_bg_color' => 'dark:bg-red-900',
                'dark_text_color' => 'dark:text-red-200',
            ],
            'account_issue' => [
                'color' => 'orange',
                'icon' => 'user-exclamation',
                'light_bg_color' => 'bg-orange-100',
                'light_text_color' => 'text-orange-800',
                'dark_bg_color' => 'dark:bg-orange-900',
                'dark_text_color' => 'dark:text-orange-200',
            ],
            'partnership' => [
                'color' => 'indigo',
                'icon' => 'hierarchy',
                'light_bg_color' => 'bg-indigo-100',
                'light_text_color' => 'text-indigo-800',
                'dark_bg_color' => 'dark:bg-indigo-900',
                'dark_text_color' => 'dark:text-indigo-200',
            ],
            'other' => [
                'color' => 'gray',
                'icon' => 'dots',
                'light_bg_color' => 'bg-gray-200',
                'light_text_color' => 'text-gray-800',
                'dark_bg_color' => 'dark:bg-gray-700',
                'dark_text_color' => 'dark:text-gray-200',
            ],
        ];
    }
}
