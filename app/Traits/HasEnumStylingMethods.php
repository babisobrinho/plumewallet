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
     *          'color' => 'red',
     *         'icon' => 'fa-user',
     *         'bg_color' => 'bg-red-100',
     *         'text_color' => 'text-red-800'
     *     ],
     * ]
     *
     * @return array<string, array<string, string>>
     */
    abstract public static function styles(): array;

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
        return self::styles()[$this->value]['icon'] ?? 'default';
    }

    /**
     * Get the CSS classes for displaying the enum case as a badge
     */
    public function getBadgeClasses(): string
    {
        $style = self::styles()[$this->value] ?? [];
        return ($style['bg_color'] ?? 'bg-gray-100') . ' ' .
            ($style['text_color'] ?? 'text-gray-800');
    }
}
