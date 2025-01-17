<?php

namespace App\Enums;

use App\Support\HasEnumUtilsTrait;


enum MediaTypeEnum: string
{
    use HasEnumUtilsTrait;

    case IMAGE = 'image';
    case VIDEO = 'video';
}
