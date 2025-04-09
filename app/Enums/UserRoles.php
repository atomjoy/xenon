<?php

namespace App\Enums;

class UserRoles
{
    static $guard = 'web';

    /**
     * All User roles
     *
     * @return array
     */
    static function allRoles()
    {
        return [
            'user',
            'allow_login',
            ...self::profilRoles(),
        ];
    }

    /**
     * User profil roles
     *
     * @return array
     */
    static function profilRoles()
    {
        return [
            'edit_profil_info',
            'edit_profil_image',
            'edit_profil_event',
            'edit_profil_contact',
        ];
    }
}
