<?php

namespace App\Traits;

trait HasEnumBasicMethods
{
    /**
     * Get all the values from the enum cases
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get an associative array of enum values with their translated labels
     */
    public static function labels(): array
    {
        return array_reduce(self::cases(), function ($carry, $case) {
            $carry[$case->value] = __('enum.' . $case->value);
            return $carry;
        }, []);
    }

    /**
     * Get the translated label for a specific enum case
     */
    public static function label(self $type): string
    {
        return __('enum.' . $type->value);
    }

    /**
     * Get an associative array of enum values with their labels for use in dropdown options
     */
    public static function options(): array
    {
        return array_reduce(self::cases(), function ($carry, $case) {
            $carry[$case->value] = self::label($case);
            return $carry;
        }, []);
    }

    /**
     * Get an enum instance from its string value, returns null if not found
     */
    public static function fromValue(string $value): ?self
    {
        return self::tryFrom($value);
    }
}
