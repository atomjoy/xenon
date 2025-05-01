<?php

namespace App\Enums\Spatie\Permissions;

enum ManageEnum: string
{
    case MANAGE_ROLES = 'manage_roles';
    case MANAGE_USERS = 'manage_users';
    case MANAGE_SETTINGS = 'manage_settings';
}
