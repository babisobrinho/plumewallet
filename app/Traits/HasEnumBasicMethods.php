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
            $carry[$case->value] = self::getTranslationKey($case);
            return $carry;
        }, []);
    }

    /**
     * Get the translated label for a specific enum case
     */
    public static function label(self $type): string
    {
        return self::getTranslationKey($type);
    }

    /**
     * Get an associative array of enum values with their labels for use in dropdown options
     */
    public static function options(): array
    {
        return array_reduce(self::cases(), function ($carry, $case) {
            $carry[$case->value] = self::getTranslationKey($case);
            return $carry;
        }, []);
    }

    /**
     * Get the translation key for an enum case
     */
    private static function getTranslationKey(self $case): string
    {
        // Get the enum class name (e.g., LogType, LogLevel)
        $className = class_basename(static::class);
        
        // Convert to snake_case and get the translation key
        $enumKey = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $className));
        
        return __("enums.{$enumKey}.{$case->value}");
    }

    /**
     * Get an enum instance from its string value, returns null if not found
     */
    public static function fromValue(string $value): ?self
    {
        return self::tryFrom($value);
    }
}
