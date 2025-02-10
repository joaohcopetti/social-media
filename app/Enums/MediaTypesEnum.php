<?php

namespace App\Enums;

use App\Support\HasEnumUtilsTrait;


enum MediaTypesEnum: string
{
    use HasEnumUtilsTrait;

    case IMAGE = 'image';
    case VIDEO = 'video';
}
