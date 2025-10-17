<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum PermissionGroup: string
{
    use HasEnumBasicMethods;

    case CONFIG = 'config';
    case USERS = 'users';
    case PERMISSIONS = 'permissions';
    case REPORTS = 'reports';
    case STATISTICS = 'statistics';
    case QA = 'qa';
}
