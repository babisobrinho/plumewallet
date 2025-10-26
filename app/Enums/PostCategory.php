<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum PostCategory: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case TECHNOLOGY = 'technology';
    case BUSINESS = 'business';
    case LIFESTYLE = 'lifestyle';
    case TRAVEL = 'travel';
    case FOOD = 'food';
    case HEALTH = 'health';
    case EDUCATION = 'education';
    case ENTERTAINMENT = 'entertainment';
    case SPORTS = 'sports';
    case NEWS = 'news';
    case TUTORIAL = 'tutorial';
    case REVIEW = 'review';
    case PERSONAL = 'personal';
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
            'lifestyle' => [
                'color' => 'pink',
                'icon' => 'heart',
                'light_bg_color' => 'bg-pink-100',
                'light_text_color' => 'text-pink-800',
                'dark_bg_color' => 'dark:bg-pink-900',
                'dark_text_color' => 'dark:text-pink-200',
            ],
            'travel' => [
                'color' => 'purple',
                'icon' => 'plane',
                'light_bg_color' => 'bg-purple-100',
                'light_text_color' => 'text-purple-800',
                'dark_bg_color' => 'dark:bg-purple-900',
                'dark_text_color' => 'dark:text-purple-200',
            ],
            'food' => [
                'color' => 'orange',
                'icon' => 'tools-kitchen',
                'light_bg_color' => 'bg-orange-100',
                'light_text_color' => 'text-orange-800',
                'dark_bg_color' => 'dark:bg-orange-900',
                'dark_text_color' => 'dark:text-orange-200',
            ],
            'health' => [
                'color' => 'red',
                'icon' => 'heart-pulse',
                'light_bg_color' => 'bg-red-100',
                'light_text_color' => 'text-red-800',
                'dark_bg_color' => 'dark:bg-red-900',
                'dark_text_color' => 'dark:text-red-200',
            ],
            'education' => [
                'color' => 'indigo',
                'icon' => 'school',
                'light_bg_color' => 'bg-indigo-100',
                'light_text_color' => 'text-indigo-800',
                'dark_bg_color' => 'dark:bg-indigo-900',
                'dark_text_color' => 'dark:text-indigo-200',
            ],
            'entertainment' => [
                'color' => 'yellow',
                'icon' => 'movie',
                'light_bg_color' => 'bg-yellow-100',
                'light_text_color' => 'text-yellow-800',
                'dark_bg_color' => 'dark:bg-yellow-900',
                'dark_text_color' => 'dark:text-yellow-200',
            ],
            'sports' => [
                'color' => 'emerald',
                'icon' => 'trophy',
                'light_bg_color' => 'bg-emerald-100',
                'light_text_color' => 'text-emerald-800',
                'dark_bg_color' => 'dark:bg-emerald-900',
                'dark_text_color' => 'dark:text-emerald-200',
            ],
            'news' => [
                'color' => 'gray',
                'icon' => 'news',
                'light_bg_color' => 'bg-gray-100',
                'light_text_color' => 'text-gray-800',
                'dark_bg_color' => 'dark:bg-gray-900',
                'dark_text_color' => 'dark:text-gray-200',
            ],
            'tutorial' => [
                'color' => 'cyan',
                'icon' => 'book',
                'light_bg_color' => 'bg-cyan-100',
                'light_text_color' => 'text-cyan-800',
                'dark_bg_color' => 'dark:bg-cyan-900',
                'dark_text_color' => 'dark:text-cyan-200',
            ],
            'review' => [
                'color' => 'amber',
                'icon' => 'star',
                'light_bg_color' => 'bg-amber-100',
                'light_text_color' => 'text-amber-800',
                'dark_bg_color' => 'dark:bg-amber-900',
                'dark_text_color' => 'dark:text-amber-200',
            ],
            'personal' => [
                'color' => 'rose',
                'icon' => 'user',
                'light_bg_color' => 'bg-rose-100',
                'light_text_color' => 'text-rose-800',
                'dark_bg_color' => 'dark:bg-rose-900',
                'dark_text_color' => 'dark:text-rose-200',
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
