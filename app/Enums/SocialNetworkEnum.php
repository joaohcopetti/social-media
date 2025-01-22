<?php

namespace App\Enums;

use App\Support\HasEnumUtilsTrait;

enum SocialNetworkEnum: string
{
    use HasEnumUtilsTrait;

    case FACEBOOK = 'facebook';
    case X_TWITTER = 'x_twitter';
    case INSTAGRAM = 'instagram';
    case TIKTOK = 'tiktok';
    case YOUTUBE = 'youtube';
}
