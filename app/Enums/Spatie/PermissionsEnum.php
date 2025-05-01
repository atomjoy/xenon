<?php

namespace App\Enums\Spatie;

use App\Enums\Spatie\Permissions\ArticleEnum;
use App\Enums\Spatie\Permissions\DisableEnum;
use App\Enums\Spatie\Permissions\ManageEnum;

enum PermissionsEnum: string
{
    case DISABLE_LOGIN = DisableEnum::DISABLE_LOGIN->value;
    case DISABLE_2FA = DisableEnum::DISABLE_2FA->value;
    case DISABLE_EMAIL = DisableEnum::DISABLE_EMAIL->value;
    case DISABLE_AVATAR = DisableEnum::DISABLE_AVATAR->value;
    case DISABLE_USERNAME = DisableEnum::DISABLE_USERNAME->value;

    case MANAGE_ROLES = ManageEnum::MANAGE_ROLES->value;
    case MANAGE_USERS = ManageEnum::MANAGE_USERS->value;
    case MANAGE_SETTINGS = ManageEnum::MANAGE_SETTINGS->value;

    case ARTICLE_VIEW = ArticleEnum::ARTICLE_VIEW->value;
    case ARTICLE_CREATE = ArticleEnum::ARTICLE_CREATE->value;
    case ARTICLE_UPDATE = ArticleEnum::ARTICLE_UPDATE->value;
    case ARTICLE_DELETE = ArticleEnum::ARTICLE_DELETE->value;
}
