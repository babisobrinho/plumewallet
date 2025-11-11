<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum PermissionGroup: string
{
    use HasEnumBasicMethods;

    case CONFIG = 'config';
    case USERS = 'users';
    case QA = 'qa';
    case BLOG = 'blog';
    case FAQ = 'faq';
    case LOGS = 'logs';
    case CONTACT_FORMS = 'contact_forms';
    case LOGIN_ATTEMPTS = 'login_attempts';
}
