<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum RoleType: string
{
    use HasEnumBasicMethods;
    case STAFF = 'staff';
    case CLIENT = 'client';
}
