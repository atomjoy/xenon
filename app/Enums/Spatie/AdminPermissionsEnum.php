<?php

namespace App\Enums\Spatie;

use App\Enums\Spatie\Permissions\ManageEnum;

enum AdminPermissionsEnum: string
{
    case MANAGE_ROLES = ManageEnum::MANAGE_ROLES->value;
    case MANAGE_USERS = ManageEnum::MANAGE_USERS->value;
    case MANAGE_SETTINGS = ManageEnum::MANAGE_SETTINGS->value;
}
