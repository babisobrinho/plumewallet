<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum LogLevel: string
{
    use HasEnumBasicMethods;

    case DEBUG = 'debug';
    case INFO = 'info';
    case WARNING = 'warning';
    case ERROR = 'error';
    case CRITICAL = 'critical';
}
