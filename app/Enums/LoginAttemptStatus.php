<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum LoginAttemptStatus: string
{
    use HasEnumBasicMethods;

    case SUCCESS = 'success';
    case FAILED = 'failed';
    case BLOCKED = 'blocked';
    case SUSPICIOUS = 'suspicious';
}
