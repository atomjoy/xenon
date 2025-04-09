<?php

namespace App\Enums;

class AdminRoles
{
    static $guard = 'admin';

    /**
     * All Admin roles
     *
     * @return array
     */
    static function allRoles()
    {
        return [
            'super_admin',
            'admin',
            'writer',
            'worker',
            'allow_login',
        ];
    }

    /**
     * Writer roles
     *
     * @return array
     */
    static function writerRoles()
    {
        return [
            'writer',
            'allow_login',
        ];
    }

    /**
     * Worker roles
     *
     * @return array
     */
    static function workerRoles()
    {
        return [
            'worker',
            'allow_login',
        ];
    }

    /**
     * Admin roles
     *
     * @return array
     */
    static function adminRoles()
    {
        return [
            'admin',
            'allow_login',
        ];
    }

    /**
     * Super Admin roles
     *
     * @return array
     */
    static function superAdminRoles()
    {
        return [
            'super_admin',
            'allow_login',
        ];
    }
}
