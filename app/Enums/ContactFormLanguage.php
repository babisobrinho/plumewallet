<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum ContactFormLanguage: string
{
    use HasEnumBasicMethods;

    case EN = 'en';
    case PT = 'pt';
    case FR = 'fr';
}
