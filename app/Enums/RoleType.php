<?php

namespace App\Enums;

enum RoleType: string
{
    case STAFF = 'staff';
    case CLIENT = 'client';

    public static function all(): array
    {
        return [
            self::STAFF->value,
            self::CLIENT->value,
        ];
    }

    public static function labels(): array
    {
        return [
            self::STAFF->value => __('roles.staff'),
            self::CLIENT->value => __('roles.client'),
        ];
    }

    public static function getLabel(string $type): string
    {
        return self::labels()[$type] ?? $type;
    }
}
