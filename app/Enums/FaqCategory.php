<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum FaqCategory: string
{
    use HasEnumBasicMethods;

    case GENERAL = 'general';
    case ACCOUNT = 'account';
    case TRANSACTIONS = 'transactions';
    case SECURITY = 'security';
    case BILLING = 'billing';
    case TECHNICAL = 'technical';
    case FEATURES = 'features';
    case SUPPORT = 'support';
}
