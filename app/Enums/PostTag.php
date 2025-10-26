<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;
use App\Traits\HasEnumStylingMethods;

enum PostTag: string
{
    use HasEnumBasicMethods, HasEnumStylingMethods;

    case BEGINNER = 'beginner';
    case ADVANCED = 'advanced';
    case TUTORIAL = 'tutorial';
    case GUIDE = 'guide';
    case TIPS = 'tips';
    case TRICKS = 'tricks';
    case REVIEW = 'review';
    case COMPARISON = 'comparison';
    case NEWS = 'news';
    case UPDATE = 'update';
    case ANNOUNCEMENT = 'announcement';
    case FEATURED = 'featured';
    case POPULAR = 'popular';
    case TRENDING = 'trending';
    case HOT = 'hot';
    case NEW = 'new';
    case UPDATED = 'updated';
    case BREAKING = 'breaking';
    case EXCLUSIVE = 'exclusive';
    case SPONSORED = 'sponsored';
    case PROMOTIONAL = 'promotional';

    /**
     * Define styling properties for each tag
     */
    public static function styles(): array
    {
        return [
            'beginner' => [
                'color' => 'green',
                'icon' => 'ti-seedling',
                'light_bg_color' => 'bg-green-100',
                'light_text_color' => 'text-green-800',
                'dark_bg_color' => 'dark:bg-green-900',
                'dark_text_color' => 'dark:text-green-200',
            ],
            'advanced' => [
                'color' => 'red',
                'icon' => 'ti-flame',
                'light_bg_color' => 'bg-red-100',
                'light_text_color' => 'text-red-800',
                'dark_bg_color' => 'dark:bg-red-900',
                'dark_text_color' => 'dark:text-red-200',
            ],
            'tutorial' => [
                'color' => 'blue',
                'icon' => 'ti-book',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-800',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-200',
            ],
            'guide' => [
                'color' => 'indigo',
                'icon' => 'ti-compass',
                'light_bg_color' => 'bg-indigo-100',
                'light_text_color' => 'text-indigo-800',
                'dark_bg_color' => 'dark:bg-indigo-900',
                'dark_text_color' => 'dark:text-indigo-200',
            ],
            'tips' => [
                'color' => 'yellow',
                'icon' => 'ti-bulb',
                'light_bg_color' => 'bg-yellow-100',
                'light_text_color' => 'text-yellow-800',
                'dark_bg_color' => 'dark:bg-yellow-900',
                'dark_text_color' => 'dark:text-yellow-200',
            ],
            'tricks' => [
                'color' => 'purple',
                'icon' => 'ti-magic-wand',
                'light_bg_color' => 'bg-purple-100',
                'light_text_color' => 'text-purple-800',
                'dark_bg_color' => 'dark:bg-purple-900',
                'dark_text_color' => 'dark:text-purple-200',
            ],
            'review' => [
                'color' => 'amber',
                'icon' => 'ti-star',
                'light_bg_color' => 'bg-amber-100',
                'light_text_color' => 'text-amber-800',
                'dark_bg_color' => 'dark:bg-amber-900',
                'dark_text_color' => 'dark:text-amber-200',
            ],
            'comparison' => [
                'color' => 'teal',
                'icon' => 'ti-scale',
                'light_bg_color' => 'bg-teal-100',
                'light_text_color' => 'text-teal-800',
                'dark_bg_color' => 'dark:bg-teal-900',
                'dark_text_color' => 'dark:text-teal-200',
            ],
            'news' => [
                'color' => 'gray',
                'icon' => 'ti-news',
                'light_bg_color' => 'bg-gray-100',
                'light_text_color' => 'text-gray-800',
                'dark_bg_color' => 'dark:bg-gray-900',
                'dark_text_color' => 'dark:text-gray-200',
            ],
            'update' => [
                'color' => 'cyan',
                'icon' => 'ti-refresh',
                'light_bg_color' => 'bg-cyan-100',
                'light_text_color' => 'text-cyan-800',
                'dark_bg_color' => 'dark:bg-cyan-900',
                'dark_text_color' => 'dark:text-cyan-200',
            ],
            'announcement' => [
                'color' => 'rose',
                'icon' => 'ti-speakerphone',
                'light_bg_color' => 'bg-rose-100',
                'light_text_color' => 'text-rose-800',
                'dark_bg_color' => 'dark:bg-rose-900',
                'dark_text_color' => 'dark:text-rose-200',
            ],
            'featured' => [
                'color' => 'gold',
                'icon' => 'ti-star-filled',
                'light_bg_color' => 'bg-yellow-200',
                'light_text_color' => 'text-yellow-900',
                'dark_bg_color' => 'dark:bg-yellow-800',
                'dark_text_color' => 'dark:text-yellow-100',
            ],
            'popular' => [
                'color' => 'orange',
                'icon' => 'ti-trending-up',
                'light_bg_color' => 'bg-orange-100',
                'light_text_color' => 'text-orange-800',
                'dark_bg_color' => 'dark:bg-orange-900',
                'dark_text_color' => 'dark:text-orange-200',
            ],
            'trending' => [
                'color' => 'pink',
                'icon' => 'ti-trending-up',
                'light_bg_color' => 'bg-pink-100',
                'light_text_color' => 'text-pink-800',
                'dark_bg_color' => 'dark:bg-pink-900',
                'dark_text_color' => 'dark:text-pink-200',
            ],
            'hot' => [
                'color' => 'red',
                'icon' => 'ti-flame',
                'light_bg_color' => 'bg-red-200',
                'light_text_color' => 'text-red-900',
                'dark_bg_color' => 'dark:bg-red-800',
                'dark_text_color' => 'dark:text-red-100',
            ],
            'new' => [
                'color' => 'emerald',
                'icon' => 'ti-sparkles',
                'light_bg_color' => 'bg-emerald-100',
                'light_text_color' => 'text-emerald-800',
                'dark_bg_color' => 'dark:bg-emerald-900',
                'dark_text_color' => 'dark:text-emerald-200',
            ],
            'updated' => [
                'color' => 'blue',
                'icon' => 'ti-edit',
                'light_bg_color' => 'bg-blue-100',
                'light_text_color' => 'text-blue-800',
                'dark_bg_color' => 'dark:bg-blue-900',
                'dark_text_color' => 'dark:text-blue-200',
            ],
            'breaking' => [
                'color' => 'red',
                'icon' => 'ti-alert-triangle',
                'light_bg_color' => 'bg-red-200',
                'light_text_color' => 'text-red-900',
                'dark_bg_color' => 'dark:bg-red-800',
                'dark_text_color' => 'dark:text-red-100',
            ],
            'exclusive' => [
                'color' => 'violet',
                'icon' => 'ti-crown',
                'light_bg_color' => 'bg-violet-100',
                'light_text_color' => 'text-violet-800',
                'dark_bg_color' => 'dark:bg-violet-900',
                'dark_text_color' => 'dark:text-violet-200',
            ],
            'sponsored' => [
                'color' => 'amber',
                'icon' => 'ti-currency-dollar',
                'light_bg_color' => 'bg-amber-200',
                'light_text_color' => 'text-amber-900',
                'dark_bg_color' => 'dark:bg-amber-800',
                'dark_text_color' => 'dark:text-amber-100',
            ],
            'promotional' => [
                'color' => 'teal',
                'icon' => 'ti-megaphone',
                'light_bg_color' => 'bg-teal-100',
                'light_text_color' => 'text-teal-800',
                'dark_bg_color' => 'dark:bg-teal-900',
                'dark_text_color' => 'dark:text-teal-200',
            ],
        ];
    }
}

