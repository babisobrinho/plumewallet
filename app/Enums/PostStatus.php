<?php

namespace App\Enums;

use App\Traits\HasEnumBasicMethods;

enum PostStatus: string
{
    use HasEnumBasicMethods;

    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
