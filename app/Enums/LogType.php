<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum LogType: string
{
    use HasEnumBasicMethods;

    case SYSTEM = 'system';
    case AUDIT = 'audit';
    case API = 'api';
    case LOGIN = 'login';
}
