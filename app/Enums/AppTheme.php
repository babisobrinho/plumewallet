<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum AppTheme: string
{
    use HasEnumBasicMethods;
    case LIGHT = 'light';
    case DARK = 'dark';
    case SYSTEM = 'system';
}
