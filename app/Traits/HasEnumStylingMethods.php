<?php

namespace App\Traits;

trait HasEnumStylingMethods
{
    /**
     * Define styling properties for each enum case (must be implemented by the enum)
     *
     * Expected format:
     * [
     *      'case_value' => [
     *         'color' => 'red',
     *         'icon' => 'user',
     *         'light_bg_color' => 'bg-red-100',
     *         'light_text_color' => 'text-red-900'
     *         'dark_bg_color' => 'bg-red-200',
     *         'dark_text_color' => 'text-red-800'
     *     ],
     * ]
     *
     * @return array<string, array<string, string>>
     */
    abstract public static function styles(): array;

    /**
     * Get all style properties for the enum case
     */
    public function getStyles(): array
    {
        return self::styles()[$this->value] ?? [];
    }

    /**
     * Get the color associated with the current enum case
     */
    public function getColor(): string
    {
        return self::styles()[$this->value]['color'] ?? 'gray';
    }

    /**
     * Get the icon associated with the current enum case
     */
    public function getIcon(): string
    {
        return self::styles()[$this->value]['icon'] ?? 'fa-circle';
    }

    /**
     * Get the CSS classes for displaying the enum case as a badge with dark mode support
     */
    public function getBadgeClasses(): string
    {
        $style = self::styles()[$this->value] ?? [];
        return ($style['light_bg_color'] ?? 'bg-gray-200') . ' ' .
            ($style['light_text_color'] ?? 'text-gray-700') . ' ' .
            ($style['dark_bg_color'] ?? 'dark:bg-gray-700') . ' ' .
            ($style['dark_text_color'] ?? 'dark:text-gray-200');
    }
}
