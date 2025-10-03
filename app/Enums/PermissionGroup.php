<?php

namespace App\Enums;

enum PermissionGroup: string
{
    case CONFIG = 'config';
    case USERS = 'users';
    case PERMISSIONS = 'permissions';
    case REPORTS = 'reports';
    case STATISTICS = 'statistics';
    case QA = 'qa';

    public static function all(): array
    {
        return [
            self::CONFIG->value,
            self::USERS->value,
            self::PERMISSIONS->value,
            self::REPORTS->value,
            self::STATISTICS->value,
            self::QA->value,
        ];
    }

    public static function labels(): array
    {
        return [
            self::CONFIG->value => __('permissions.config'),
            self::USERS->value => __('permissions.users'),
            self::PERMISSIONS->value => __('permissions.permissions'),
            self::REPORTS->value => __('permissions.reports'),
            self::STATISTICS->value => __('permissions.statistics'),
            self::QA->value => __('permissions.qa'),
        ];
    }

    public static function getLabel(string $type): string
    {
        return self::labels()[$type] ?? $type;
    }
}
