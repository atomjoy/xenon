<?php

namespace App\Enums\Spatie;

use App\Enums\Spatie\Permissions\ArticleEnum;

enum WriterPermissionsEnum: string
{
    case ARTICLE_VIEW = ArticleEnum::ARTICLE_VIEW->value;
    case ARTICLE_CREATE = ArticleEnum::ARTICLE_CREATE->value;
    case ARTICLE_UPDATE = ArticleEnum::ARTICLE_UPDATE->value;
    case ARTICLE_DELETE = ArticleEnum::ARTICLE_DELETE->value;
}
